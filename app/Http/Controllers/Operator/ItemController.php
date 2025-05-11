<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->latest()->paginate(5);
        return view('operator.items.index', compact('items'));
    }

    public function updateStatus(Request $request, Item $item)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['tersedia', 'tidak tersedia'])],
        ], [
            'status.required' => 'Status baru wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ]);

        $item->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('operator.items.index')
                         ->with('success', "Status item '{$item->name}' berhasil diperbarui.");
    }
}
