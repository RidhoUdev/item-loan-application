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
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if (session('error'))
    <div id="alert-error" role="alert" class="alert alert-error mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    @if ($errors->any())
    <div id="alert-validation" role="alert" class="alert alert-warning mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        <span>Gagal memproses data. Silakan buka kembali form dan periksa error.</span>
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
                        <td>
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
