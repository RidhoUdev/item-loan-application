@extends('layouts.user')

@section('title', 'Daftar Barang Tersedia')

@push('styles')
@endpush

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-4">
            Barang Tersedia untuk Dipinjam
        </h1>

        <form method="GET" action="{{ route('user.items.index') }}">
            <div class="flex flex-wrap gap-4 items-end">
                <label class="form-control w-full sm:w-auto sm:flex-1">
                    <div class="label">
                        <span class="label-text">Cari Barang</span>
                    </div>
                    <input type="text" name="search" placeholder="Nama atau deskripsi..." value="{{ request('search') }}" class="input input-bordered w-full" />
                </label>
                <label class="form-control w-full sm:w-auto">
                    <div class="label">
                        <span class="label-text">Filter Kategori</span>
                    </div>
                    <select name="category" class="select select-bordered w-full">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <button type="submit" class="btn bg-pastelOrange text-white">Cari/Filter</button>
                 @if(request()->has('search') || request()->has('category'))
                   <a href="{{ route('user.items.index') }}" class="btn btn-ghost">Reset</a>
                 @endif
            </div>
        </form>
    </div>

    @if($items->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($items as $item)
                <div class="card card-compact w-full bg-base-100 shadow-xl border border-base-300">
                    <figure class="h-48 bg-gray-100">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover" />
                        @else
                             <div class="w-full h-full flex items-center justify-center text-gray-400">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                            </div>
                        @endif
                    </figure>
                    <div class="card-body">
                        <div class="text-xs text-gray-500">{{ $item->category->name ?? 'N/A' }}</div>
                        <h2 class="card-title text-base">{{ $item->name }}</h2>
                        <p class="text-sm text-gray-600">{{ Str::limit($item->description, 50, '...') }}</p>
                        <div class="mt-2">
                            {{-- Gunakan accessor available_quantity --}}
                            @php $available = $item->available_quantity; @endphp
                            <span class="font-semibold">Tersedia:</span>
                            <span class="badge {{ $available > 0 ? 'badge-success' : 'badge-error' }} ml-1">
                                {{ $available }}
                            </span>
                        </div>
                        <div class="card-actions justify-end mt-3">
                            {{-- Kondisi @if sekarang menggunakan nilai $available yang benar --}}
                            @if($available > 0)
                                <a href="{{ route('user.borrow.create', ['item_id' => $item->id]) }}"
                                   class="btn btn-sm bg-pastelOrange text-white">
                                    Pinjam
                                </a>
                            @else
                                <button class="btn btn-sm btn-disabled">Stok Habis</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-10 text-gray-500">
            <p>Tidak ada barang yang ditemukan.</p>
            @if(request()->has('search') || request()->has('category'))
                 <a href="{{ route('user.items.index') }}" class="btn btn-sm btn-link mt-2">Reset Filter/Pencarian</a>
            @endif
        </div>
    @endif


    <div class="mt-8">
         @if ($items->hasPages())
             {{ $items->appends(request()->query())->links() }}
         @endif
    </div>

@endsection

@push('scripts')
@endpush
