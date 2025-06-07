@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Pengelolaan Kategori
        </h1>
        <button class="btn bg-pastelOrange text-white btn-sm" onclick="create_category_modal.showModal()">
             <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
             </svg>
            Tambah Kategori
        </button>
    </div>

    @if (session('success'))
    <div id="alert-success" role="alert" class="alert alert-success mb-4">
        <span class="iconify w-5 h-5" data-icon="ep:success-filled"></span>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    
    @if (session('error'))
    <div id="alert-error" role="alert" class="alert alert-error mb-4">
        <span class="iconify w-5 h-5" data-icon="material-symbols:error-rounded"></span>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    @if ($errors->any())
    <div id="alert-validation" role="alert" class="alert alert-warning mb-4">
        <span class="iconify w-5 h-5" data-icon="typcn:warning"></span>
        <span> Gagal menambahkan category. Silakan klik 'Tambah Category' lagi dan periksa error pada form.</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="table w-full table-zebra">
            <thead class="text-xs text-white uppercase bg-compound">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Jumlah Barang</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse ($categories as $category)
                    <tr class="hover">
                        <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                        <td>
                            <div class="font-bold">{{ $category->name }}</div>
                        </td>
                        <td class="whitespace-nowrap">
                            {{ Str::limit($category->description, 75, '...') ?? '-' }}
                        </td>
                        <td class="text-center">
                            <span class="badge badge-neutral">{{ $category->items_count ?? 0 }}</span>
                        </td>
                        <td class="text-center whitespace-nowrap">
                            <button class="btn btn-xs btn-outline btn-info mr-1"
                                    onclick="edit_category_modal_{{ $category->id }}.showModal()">
                                Edit
                            </button>

                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-outline btn-error delete-button">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                     @include('admin.categories.edit', ['category' => $category])
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            Tidak ada data kategori ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
         @if ($categories->hasPages())
             {{ $categories->links() }}
         @endif
    </div>

    @include('admin.categories.create')

@endsection
