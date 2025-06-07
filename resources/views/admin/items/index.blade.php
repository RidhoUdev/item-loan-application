@extends('layouts.admin')

@section('title', 'Pengelolaan Barang')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Pengelolaan Barang
        </h1>
        <button class="btn bg-pastelOrange text-white btn-sm w-full sm:w-auto" onclick="create_item_modal.showModal()">
            <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Barang
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
        <span> Gagal menambahkan barang. Silakan klik 'Tambah Barang' lagi dan periksa error pada form.</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="table table-zebra w-full min-w-[1000px] lg:min-w-full">
            <thead class="text-xs text-white uppercase bg-compound">
                <tr>
                    <th class="px-4 py-3 whitespace-nowrap w-[5%]">No</th>
                    <th class="px-4 py-3 whitespace-nowrap w-[10%]">Gambar</th>
                    <th class="px-4 py-3 whitespace-nowrap w-[20%] min-w-[150px]">Nama Barang</th>
                    <th class="px-4 py-3 whitespace-nowrap w-[15%] min-w-[120px]">Kategori</th>
                    <th class="px-4 py-3 whitespace-nowrap w-[25%] min-w-[250px]">Deskripsi</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap w-[10%]">Stok Total</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap w-[10%]">Status</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap w-[15%] min-w-[130px]">Action</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse ($items as $item)
                    <tr class="hover">
                        <td class="px-4 py-3 whitespace-nowrap">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                        <td class="px-4 py-3">
                            @if($item->image)
                                <div class="avatar">
                                    <div class="w-12 h-12 rounded">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" />
                                    </div>
                                </div>
                            @else
                                <div class="avatar placeholder">
                                     <div class="bg-neutral-focus text-neutral-content rounded w-12 h-12 flex items-center justify-center">
                                        <span class="text-xs">No Img</span>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="font-bold text-sm">{{ $item->name }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">{{ $item->category->name ?? 'N/A' }}</td>
                        <td class="px-4 py-3">
                            {{ Str::limit($item->description, 70, '...') ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <span class="badge badge-neutral">{{ $item->quantity }}</span>
                        </td>
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <span class="badge badge-sm {{ $item->status === 'tersedia' ? 'badge-success' : 'badge-error' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <button class="btn btn-xs btn-outline btn-info mr-1"
                                    onclick="edit_item_modal_{{ $item->id }}.showModal()">
                                Edit
                            </button>
                            <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-outline btn-error delete-button">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.items.edit', ['item' => $item, 'categories' => $categories ?? []])
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            Data barang tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center sm:justify-end">
        @if ($items->hasPages())
            {{ $items->links() }}
        @endif
    </div>

    @include('admin.items.create', ['categories' => $categories ?? []])

@endsection
