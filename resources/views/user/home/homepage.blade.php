@extends('layouts.user')

@section('title', 'Homepage - GoPinjam')

@section('content')
    <section class="bg-neutralize py-12 md:py-16 rounded-lg shadow-lg mb-8">
        <div class="container mx-auto px-6 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-greenSlate mb-3">
                Selamat Datang, {{ $user->name }}!
            </h1>
            <p class="text-gray-600 mb-6 text-lg">
                Siap untuk meminjam barang kebutuhan sekolahmu?
            </p>
            <a href="{{ route('user.items.index') }}" class="btn btn-primary btn-md bg-pastelOrange hover:bg-opacity-80 border-none text-white shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                Lihat & Pinjam Barang
            </a>
        </div>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <div class="flex items-center mb-3">
                    <div class="p-3 rounded-full bg-pastelOrange mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h2 class="card-title text-greenSlate">Peminjaman Aktif</h2>
                        <p class="text-3xl font-bold text-gray-700">{{ $activeBorrowsCount }}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mb-4">Barang yang sedang Anda pinjam atau menunggu diambil.</p>
                <div class="card-actions justify-end">
                    <a href="{{ route('user.pending') }}" class="btn btn-sm btn-outline border-greenSlate text-greenSlate hover:bg-greenSlate hover:text-white">
                        Lihat Riwayat Saya
                    </a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body items-center text-center">
                <div class="p-4 rounded-full bg-pastelOrange mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                </div>
                <h2 class="card-title text-greenSlate">Cari Barang</h2>
                <p class="text-sm text-gray-500 mb-4">Jelajahi semua barang yang tersedia untuk dipinjam.</p>
                <div class="card-actions">
                    <a href="{{ route('user.items.index') }}" class="btn btn-primary bg-pastelOrange hover:bg-opacity-80 border-none text-white">Mulai Mencari</a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                 <div class="flex items-center mb-3">
                    <div class="p-3 rounded-full bg-pastelOrange mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25M9 12.75L11.25 15L13.5 12.75M9 12.75L6.75 15L9 17.25m1.5-4.5l2.25 2.25L13.5 15m0 0L9 19.5m2.25-2.25L13.5 15M5.625 5.625A2.25 2.25 0 017.875 3.375h8.25A2.25 2.25 0 0118.375 5.625v8.25A2.25 2.25 0 0116.125 16.125h-8.25A2.25 2.25 0 015.625 13.875v-8.25z" /></svg>
                    </div>
                    <div>
                        <h2 class="card-title text-greenSlate">Pengajuan Terakhir</h2>
                        @if($lastBorrowRequests->count() > 0)
                            <p class="text-sm text-gray-500">Status pengajuan terbaru Anda.</p>
                        @else
                            <p class="text-sm text-gray-500">Anda belum membuat pengajuan.</p>
                        @endif
                    </div>
                </div>

                @if($lastBorrowRequests->count() > 0)
                    <ul class="space-y-2 text-sm">
                        @foreach($lastBorrowRequests as $request)
                        <li class="p-2 rounded-md bg-base-200/50">
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-700 truncate w-3/5">
                                    {{ $request->items->first()->name ?? 'Barang tidak diketahui' }}
                                    ({{ $request->items->first()->pivot->quantity ?? 0 }} unit)
                                </span>
                                @php
                                    $status = $request->status;
                                    $badgeClass = match($status) {
                                        'pending' => 'badge-warning',
                                        'approved' => 'badge-info',
                                        'borrowed' => 'badge-primary',
                                        'returned' => 'badge-success',
                                        'rejected' => 'badge-error',
                                        default => 'badge-ghost',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} badge-sm">{{ ucfirst($status) }}</span>
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                Diajukan: {{ $request->request_date ? \Carbon\Carbon::parse($request->request_date)->isoFormat('D MMM YY') : '-' }}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif

                <div class="card-actions justify-end mt-4">
                    <a href="{{ route('user.pending') }}" class="btn btn-sm btn-outline border-greenSlate text-greenSlate hover:bg-greenSlate hover:text-white">
                        Lihat Semua Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush