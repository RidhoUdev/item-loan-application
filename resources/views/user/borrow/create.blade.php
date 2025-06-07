@extends('layouts.user')

@section('title', 'Form Peminjaman Barang')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Form Peminjaman Barang
        </h1>
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
        <span> Gagal mengajukan peminjaman. Silakan klik 'Ajukan Pinjam' lagi dan periksa error pada form.</span>
    </div>
    @endif


    <div class="card lg:card-side bg-base-100 shadow-xl border border-base-300">
        <figure class="w-full lg:w-1/3 bg-gray-100 p-4">
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="rounded-lg object-contain max-h-64 lg:max-h-full" />
            @else
                <div class="w-full h-64 lg:h-full flex items-center justify-center text-gray-400">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                 </div>
            @endif
        </figure>

        <div class="card-body w-full lg:w-2/3">
            <span class="badge badge-ghost">{{ $item->category->name ?? 'N/A' }}</span>
            <h2 class="card-title text-2xl">{{ $item->name }}</h2>
            <p class="text-gray-600 mt-1">{{ $item->description }}</p>

            <div class="divider my-4"></div>

            <form method="POST" action="{{ route('user.borrow.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">

                <div class="form-control">
                     <label class="label">
                        <span class="label-text font-semibold">Stok Tersedia Saat Ini:</span>
                        <span class="label-text-alt badge badge-lg {{ $availableQuantity > 0 ? 'badge-success' : 'badge-error' }}">{{ $availableQuantity }}</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Jumlah Pinjam<span class="text-error">*</span></span>
                        </div>
                        <input type="number" name="quantity" placeholder="Jumlah" value="{{ old('quantity', 1) }}"
                               min="1" max="{{ $availableQuantity }}"
                               class="input input-bordered w-full @error('quantity') input-error @enderror" required />
                        @error('quantity')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Tanggal Pengembalian<span class="text-error">*</span></span>
                        </div>
                        <input type="date" name="expected_return_date"
                               value="{{ old('expected_return_date') }}"
                               min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                               class="input input-bordered w-full @error('expected_return_date') input-error @enderror" required />
                        @error('expected_return_date')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                </div>

                <div class="card-actions justify-end mt-6">
                    <a href="{{ route('user.items.index') }}" class="btn btn-ghost">Kembali ke Daftar</a>
                    <button type="submit" class="btn bg-pastelOrange text-white">Ajukan Peminjaman</button>
                </div>
            </form>
        </div>
    </div>

@endsection