@extends('layouts.operator')

@section('title', 'Dashboard Operator - GoPinjam')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Dashboard Operator
        </h1>
        <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}! Berikut adalah ringkasan aktivitas peminjaman.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="card bg-warning text-warning-content shadow-xl border border-warning">
            <div class="card-body items-center text-center">
                <div class="flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <h2 class="card-title text-4xl font-bold">{{ $pendingRequestsCount }}</h2>
                <p class="font-semibold">Permintaan Peminjaman</p>
                <p class="text-sm opacity-80">(Menunggu Persetujuan)</p>
                <div class="card-actions justify-end mt-4">
                    <a href="{{ route('operator.requests.index', ['status_filter' => 'pending']) }}" class="btn btn-sm btn-outline border-current hover:bg-white hover:text-warning">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="card bg-info text-info-content shadow-xl border border-info">
            <div class="card-body items-center text-center">
                 <div class="flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75L14.25 12m0 0l2.25 2.25M14.25 12l2.25-2.25M14.25 12L12 14.25m-2.58 4.92l-6.375-6.375a1.125 1.125 0 010-1.59L9.42 4.83c.211-.211.498-.33.796-.33H19.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-9.284c-.298 0-.585-.119-.796-.33z" />
                    </svg>
                </div>
                <h2 class="card-title text-4xl font-bold">{{ $notReturnedItemsCount }}</h2>
                <p class="font-semibold">Barang Belum Dikembalikan</p>
                <p class="text-sm opacity-80">(Status: Disetujui/Dipinjam)</p>
                 <div class="card-actions justify-end mt-4">
                    <a href="{{ route('operator.requests.index', ['status_filter' => 'approved']) }}" class="btn btn-xs btn-outline border-current hover:bg-white hover:text-info">Lihat Disetujui</a>
                    <a href="{{ route('operator.requests.index', ['status_filter' => 'borrowed']) }}" class="btn btn-xs btn-outline border-current hover:bg-white hover:text-info">Lihat Dipinjam</a>
                </div>
            </div>
        </div>

        <div class="card bg-success text-success-content shadow-xl border border-success">
            <div class="card-body items-center text-center">
                <div class="flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="card-title text-4xl font-bold">{{ $returnedItemsCount }}</h2>
                <p class="font-semibold">Barang Sudah Dikembalikan</p>
                 <p class="text-sm opacity-80">(Status: Dikembalikan)</p>
                <div class="card-actions justify-end mt-4">
                    <a href="{{ route('operator.borrower.history.index', ['status_history' => 'returned']) }}" class="btn btn-sm btn-outline border-current hover:bg-white hover:text-success">Lihat Histori</a>
                </div>
            </div>
        </div>

    </div>
@endsection
