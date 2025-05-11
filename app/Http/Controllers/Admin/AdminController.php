<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowRequest;
use App\Models\BorrowItem;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // --- Data untuk Chart Frekuensi Peminjaman (Contoh: 7 Hari Terakhir) ---
        $loanFrequencyData = BorrowRequest::select(
                DB::raw('DATE(request_date) as date'), // Ambil tanggal saja
                DB::raw('count(*) as total_requests')
            )
            ->where('request_date', '>=', Carbon::now()->subDays(6)->startOfDay()) // Mulai dari 6 hari lalu
            ->where('request_date', '<=', Carbon::now()->endOfDay()) // Sampai akhir hari ini
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Format data untuk ApexCharts
        $loanDates = $loanFrequencyData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->isoFormat('D MMM'); // Format tanggal (misal: 11 Mei)
        });
        $loanCounts = $loanFrequencyData->pluck('total_requests');


        // --- Data untuk Chart Barang Paling Sering Dipinjam (Contoh: Top 5) ---
        $topItemsData = BorrowItem::select(
                'items.name as item_name',
                DB::raw('SUM(borrow_items.quantity) as total_borrowed')
            )
            ->join('items', 'borrow_items.item_id', '=', 'items.id')
            // Anda bisa filter berdasarkan status request jika perlu, misal hanya yang 'approved' atau 'returned'
            // ->join('borrow_requests', 'borrow_items.borrow_request_id', '=', 'borrow_requests.id')
            // ->whereIn('borrow_requests.status', ['approved', 'borrowed', 'returned'])
            ->groupBy('items.id', 'items.name') // Group berdasarkan ID dan nama item
            ->orderBy('total_borrowed', 'DESC')
            ->limit(5) // Ambil 5 teratas
            ->get();

        // Format data untuk ApexCharts
        $topItemNames = $topItemsData->pluck('item_name');
        $topItemCounts = $topItemsData->pluck('total_borrowed');

        // --- Data untuk Kartu Statistik Sederhana (Opsional) ---
        $totalPendingRequests = BorrowRequest::where('status', 'pending')->count();
        $totalBorrowedCurrently = BorrowRequest::where('status', 'borrowed')->count();
        $totalItems = Item::count();


        return view('admin.dashboard', compact(
            'loanDates',
            'loanCounts',
            'topItemNames',
            'topItemCounts',
            'totalPendingRequests',
            'totalBorrowedCurrently',
            'totalItems'
        ));
    }
}
