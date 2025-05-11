<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $itemsQuery = Item::with('category');

        $itemsQuery->where('status', 'tersedia');

        if ($request->filled('category')) {
            $itemsQuery->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $itemsQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        $items = $itemsQuery->latest()->paginate(4);

        $categories = Category::orderBy('name')->get();

        return view('user.items.index', compact('items', 'categories'));
    }

    public function show(Item $item)
    {
       if ($item->status !== 'tersedia') {
            abort(404);
       }
       return view('user.items.show', compact('item'));
    }
}
