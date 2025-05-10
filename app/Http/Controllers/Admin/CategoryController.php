<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\Admin\CategoryStoreFormRequest;
use App\Http\Requests\Admin\CategoryUpdateFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('items')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryStoreFormRequest $request)
    {
        $validatedData = $request->validated();

        Category::create($validatedData);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function show(Category $category)
    {
        return abort(404);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateFormRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        $category->update($validatedData);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil dihapus.');
        } catch (QueryException $e) {
             if ($e->getCode() === '23000') {
                  return redirect()->route('admin.categories.index')
                                  ->with('error', 'Gagal menghapus kategori karena masih ada barang yang terkait.');
             }
             return redirect()->route('admin.categories.index')
                          ->with('error', 'Gagal menghapus kategori. Terjadi kesalahan database.');
        } catch (\Exception $e) {
             return redirect()->route('admin.categories.index')
                          ->with('error', 'Gagal menghapus kategori. Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
