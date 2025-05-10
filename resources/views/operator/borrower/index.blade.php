@extends('layouts.operator')

@section('title', 'Histori Peminjaman per Peminjam')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Histori Peminjaman
        </h1>

        <form method="GET" action="{{ route('operator.borrower.history.index') }}" class="flex flex-wrap items-end gap-2">
            <label class="form-control w-full sm:w-auto">
                <div class="label pt-0">
                    <span class="label-text">Cari Peminjam</span>
                </div>
                <input type="text" name="search_borrower" placeholder="Nama/Email Peminjam..." value="{{ request('search_borrower') }}" class="input input-bordered input-sm w-full max-w-xs" />
            </label>
            <label class="form-control w-full sm:w-auto">
                <div class="label pt-0">
                    <span class="label-text">Filter Status</span>
                </div>
                <select name="status_history" class="select select-bordered select-sm w-full max-w-xs">
                    <option value="all" {{ request('status_history', 'all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ request('status_history') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status_history') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="borrowed" {{ request('status_history') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                    <option value="returned" {{ request('status_history') == 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="rejected" {{ request('status_history') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </label>
            <button type="submit" class="btn btn-sm bg-pastelOrange text-white">Cari</button>
            @if(request()->has('search_borrower') || (request()->has('status_history') && request('status_history') !== 'all'))
                <a href="{{ route('operator.borrower.history.index') }}" class="btn btn-sm btn-ghost">Reset</a>
            @endif
        </form>
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition role="alert" class="alert alert-success mb-4">
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
         <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition role="alert" class="alert alert-error mb-4">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="table w-full table-zebra">
            <thead class="text-xs text-black uppercase bg-gray-100">
                <tr>
                    <th>ID Req.</th>
                    <th>Peminjam</th>
                    <th>Tgl. Ajuan</th>
                    <th>Barang & Jumlah</th>
                    <th>Tgl. Wajib Kembali</th>
                    <th>Tgl. Aktual Kembali</th>
                    <th class="text-center">Status</th>
                    <th>Diproses Oleh</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse ($borrowRequests as $request)
                    <tr class="hover">
                        <td>#{{ $request->id }}</td>
                        <td>
                            <div class="font-semibold">{{ $request->borrower->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $request->borrower->email ?? '' }}</div>
                        </td>
                        <td>{{ $request->request_date ? \Carbon\Carbon::parse($request->request_date)->isoFormat('D MMM YY, HH:mm') : '-' }}</td>
                        <td>
                            <ul class="list-disc list-inside text-xs">
                                @foreach($request->items as $item)
                                    <li>{{ $item->name }} ({{ $item->pivot->quantity }} unit)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $request->expected_return_date ? \Carbon\Carbon::parse($request->expected_return_date)->isoFormat('D MMM YY') : '-' }}</td>
                        <td>{{ $request->return_date ? \Carbon\Carbon::parse($request->return_date)->isoFormat('D MMM YY, HH:mm') : '-' }}</td>
                        <td class="text-center">
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
                            <span class="badge {{ $badgeClass }} badge-md">{{ ucfirst($status) }}</span>
                        </td>
                        <td>{{ $request->operator->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            @if(request()->has('search_borrower') || request()->has('status_history'))
                                Tidak ada histori peminjaman ditemukan dengan filter saat ini.
                            @else
                                Belum ada histori peminjaman.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
         @if ($borrowRequests->hasPages())
            {{ $borrowRequests->appends(request()->query())->links() }}
         @endif
    </div>

@endsection
