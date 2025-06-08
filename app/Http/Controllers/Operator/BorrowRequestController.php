<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BorrowRequestApproved;
use App\Notifications\ReturnReminderNotification;

class BorrowRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = BorrowRequest::with(['borrower', 'items', 'operator']);

        if ($request->filled('status_filter') && $request->status_filter !== 'all_active') {
            $query->where('status', $request->status_filter);
        } else {
            $query->whereIn('status', ['pending', 'approved', 'borrowed']);
        }

        if ($request->filled('borrower_search')) {
            $searchTerm = $request->borrower_search;
            $query->whereHas('borrower', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        $borrowRequests = $query->latest('request_date')->paginate(7);
        return view('operator.requests.index', compact('borrowRequests'));
    }

    public function borrowerHistory(Request $request)
    {
        $query = BorrowRequest::with(['borrower', 'items', 'operator']);
        if ($request->filled('search_borrower')) {
            $searchTerm = $request->search_borrower;
            $query->whereHas('borrower', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }
        if ($request->filled('status_history') && $request->status_history !== 'all') {
            $query->where('status', $request->status_history);
        }
        $borrowRequests = $query->latest('request_date')->paginate(7);
        return view('operator.borrower.index', compact('borrowRequests'));
    }

    public function approve(Request $requestValidation, BorrowRequest $borrowRequest)
    {
        if ($borrowRequest->status !== 'pending') {
            return redirect()->route('operator.requests.index')
                             ->with('error', 'Permintaan ini tidak bisa disetujui (status bukan pending).');
        }
        DB::beginTransaction();
        try {
            $borrowRequest->status = 'approved';
            $borrowRequest->operator_id = Auth::id();
            $borrowRequest->save();
            $borrower = $borrowRequest->borrower;
            if ($borrower) {
                $borrower->notify(new BorrowRequestApproved($borrowRequest));
            }
            DB::commit();
            return redirect()->route('operator.requests.index')
                             ->with('success', "Permintaan #{$borrowRequest->id} berhasil disetujui. User dapat mengambil barang.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('operator.requests.index')
                             ->with('error', "Gagal menyetujui permintaan #{$borrowRequest->id}. Error: " . $e->getMessage());
        }
    }

    public function reject(Request $requestValidation, BorrowRequest $borrowRequest)
    {
        if ($borrowRequest->status !== 'pending') {
            return redirect()->route('operator.requests.index')
                             ->with('error', 'Permintaan ini tidak bisa ditolak (status bukan pending).');
        }
        $borrowRequest->status = 'rejected';
        $borrowRequest->operator_id = Auth::id();
        $borrowRequest->save();
        return redirect()->route('operator.requests.index')
                         ->with('success', "Permintaan #{$borrowRequest->id} berhasil ditolak.");
    }

    public function markAsBorrowedOut(Request $requestValidation, BorrowRequest $borrowRequest)
    {
        if ($borrowRequest->status !== 'approved') {
            return redirect()->route('operator.requests.index')
                             ->with('error', 'Permintaan ini belum disetujui atau sudah diproses.');
        }

        DB::beginTransaction();
        try {
            $borrowRequest->status = 'borrowed';
            $borrowRequest->save();

            DB::commit();
            return redirect()->route('operator.requests.index')
                             ->with('success', "Permintaan #{$borrowRequest->id} berhasil ditandai sebagai dipinjam.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('operator.requests.index')
                             ->with('error', "Gagal menandai permintaan #{$borrowRequest->id} sebagai dipinjam. Error: " . $e->getMessage());
        }
    }

    public function markAsReturned(Request $requestValidation, BorrowRequest $borrowRequest)
    {
        if ($borrowRequest->status !== 'borrowed') {
            return redirect()->route('operator.requests.index')
                             ->with('error', 'Permintaan ini belum ditandai sebagai dipinjam atau sudah selesai.');
        }

        DB::beginTransaction();
        try {
            $borrowRequest->status = 'returned';
            $borrowRequest->return_date = now();
            $borrowRequest->save();

            DB::commit();
            return redirect()->route('operator.requests.index')
                             ->with('success', "Permintaan #{$borrowRequest->id} berhasil ditandai sebagai dikembalikan.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('operator.requests.index')
                             ->with('error', "Gagal menandai permintaan #{$borrowRequest->id} sebagai dikembalikan. Error: " . $e->getMessage());
        }
    }

    public function sendReturnReminder(BorrowRequest $borrowRequest)
    {
        if ($borrowRequest->status !== 'borrowed') {
            return back()->with('error', 'Hanya peminjaman yang sedang berjalan yang bisa dikirimi pengingat.');
        }

        try {
            $borrower = $borrowRequest->borrower;

            if (!$borrower) {
                return back()->with('error', 'Data peminjam tidak ditemukan.');
            }

            $borrower->notify(new ReturnReminderNotification($borrowRequest));

            return back()->with('success', "Notifikasi pengingat berhasil dikirim ke {$borrower->name}.");

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim notifikasi pengingat. Terjadi kesalahan sistem.');
        }
    }
}
