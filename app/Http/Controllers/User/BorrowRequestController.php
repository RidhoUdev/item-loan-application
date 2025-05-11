<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\BorrowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BorrowRequestController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(['item_id' => 'required|exists:items,id']);
        $itemId = $request->input('item_id');
        $item = Item::with('category')->findOrFail($itemId);
        $availableQuantity = $item->available_quantity;

        if ($item->status !== 'tersedia' || $availableQuantity <= 0) {
            return redirect()->route('user.items.index')
                             ->with('error', "Item '{$item->name}' sedang tidak tersedia untuk dipinjam.");
        }
        return view('user.borrow.create', compact('item', 'availableQuantity'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'expected_return_date' => 'required|date|after:today',
        ], [
            'item_id.required' => 'Item harus dipilih.',
            'item_id.exists' => 'Item yang dipilih tidak valid.',
            'quantity.required' => 'Jumlah pinjam wajib diisi.',
            'quantity.integer' => 'Jumlah pinjam harus berupa angka.',
            'quantity.min' => 'Jumlah pinjam minimal 1.',
            'expected_return_date.required' => 'Tanggal pengembalian wajib diisi.',
            'expected_return_date.date' => 'Format tanggal pengembalian tidak valid.',
            'expected_return_date.after' => 'Tanggal pengembalian harus setelah hari ini.',
        ]);

        $item = Item::findOrFail($validatedData['item_id']);
        $requestedQuantity = (int) $validatedData['quantity'];
        $availableQuantity = $item->available_quantity;

        if ($requestedQuantity > $availableQuantity) {
            return back()
                ->withErrors(['quantity' => "Jumlah pinjam ($requestedQuantity) melebihi stok tersedia ($availableQuantity)."])
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $expectedReturnDate = $validatedData['expected_return_date'];

            $borrowRequest = BorrowRequest::create([
                'borrower_id' => Auth::id(),
                'operator_id' => null,
                'status' => 'pending',
                'request_date' => now(),
                'expected_return_date' => $expectedReturnDate,
                'actual_return_date' => null,
            ]);

            $borrowRequest->items()->attach($item->id, ['quantity' => $requestedQuantity]);

            DB::commit();

            return redirect()->route('user.pending')
                             ->with('success', "Permintaan peminjaman untuk '{$item->name}' berhasil diajukan.");

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->with('error', 'Gagal mengajukan permintaan peminjaman. Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
