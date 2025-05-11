@extends('layouts.admin')

@section('title', 'Admin Dashboard - GoPinjam')

@push('styles')
    <style>
        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Admin Dashboard
        </h1>
        <p class="text-gray-600">Ringkasan aktivitas dan statistik peminjaman barang.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="card bg-warning text-warning-content shadow-lg">
            <div class="card-body">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-sm font-semibold opacity-80">PERMINTAAN PENDING</div>
                        <div class="text-3xl font-bold">{{ $totalPendingRequests ?? 0 }}</div>
                    </div>
                    <div class="text-4xl opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-info text-info-content shadow-lg">
            <div class="card-body">
                 <div class="flex justify-between items-center">
                    <div>
                        <div class="text-sm font-semibold opacity-80">BARANG DIPINJAM SAAT INI</div>
                        <div class="text-3xl font-bold">{{ $totalBorrowedCurrently ?? 0 }}</div>
                    </div>
                    <div class="text-4xl opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75L14.25 12m0 0l2.25 2.25M14.25 12l2.25-2.25M14.25 12L12 14.25m-2.58 4.92l-6.375-6.375a1.125 1.125 0 010-1.59L9.42 4.83c.211-.211.498-.33.796-.33H19.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-9.284c-.298 0-.585-.119-.796-.33z" /></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-neutral text-neutral-content shadow-lg">
            <div class="card-body">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-sm font-semibold opacity-80">TOTAL ITEM TERDAFTAR</div>
                        <div class="text-3xl font-bold">{{ $totalItems ?? 0 }}</div>
                    </div>
                    <div class="text-4xl opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <h2 class="card-title text-lg font-semibold text-gray-700">Frekuensi Peminjaman (7 Hari Terakhir)</h2>
                <div class="chart-container">
                    <div id="loanFrequencyChart"></div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <h2 class="card-title text-lg font-semibold text-gray-700">Top 5 Barang Paling Sering Dipinjam</h2>
                 <div class="chart-container">
                    <div id="topItemsChart"></div
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        window.dashboardChartData = {
            loanDates: @json($loanDates ?? []),
            loanCounts: @json($loanCounts ?? []),
            topItemNames: @json($topItemNames ?? []),
            topItemCounts: @json($topItemCounts ?? [])
        };
    </script>

    @vite('resources/js/chart.js')
@endpush
