<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ItemFormRequest;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->latest()->paginate(5);
        $categories = Category::orderBy('name')->get();
        return view('admin.items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.items.create', compact('categories'));
    }

    public function store(ItemFormRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
            $validatedData['image'] = $imagePath;
        }

        Item::create($validatedData);

        return redirect()->route('admin.items.index')
                         ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Item $item)
    {
        return abort(404);
    }

    public function edit(Item $item)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(ItemFormRequest $request, Item $item)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $imagePath = $request->file('image')->store('items', 'public');
            $validatedData['image'] = $imagePath;
        }

        $item->update($validatedData);

        return redirect()->route('admin.items.index')
                         ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        if ($item->borrowItems()->exists()) {
            return redirect()->route('admin.items.index')
                            ->with('error', 'Tidak dapat menghapus barang, karena terdapat riwayat peminjaman.');
        }

        try {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }

            $item->delete();

            return redirect()->route('admin.items.index')
                            ->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.items.index')
                            ->with('error', 'Gagal menghapus barang. Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
