@extends('layouts.operator')

@section('title', 'Daftar Permintaan Aktif')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Permintaan Peminjaman Aktif
        </h1>
        <form method="GET" action="{{ route('operator.requests.index') }}" class="flex flex-wrap items-end gap-2">
            <label class="form-control w-full sm:w-auto">
                <div class="label pt-0">
                    <span class="label-text">Cari Peminjam</span>
                </div>
                <input type="text" name="borrower_search" placeholder="Nama/Email Peminjam..." value="{{ request('borrower_search') }}" class="input input-bordered input-sm w-full max-w-xs" />
            </label>
            <label class="form-control w-full sm:w-auto">
                <div class="label pt-0">
                    <span class="label-text">Filter Status</span>
                </div>
                <select name="status_filter" class="select select-bordered select-sm w-full max-w-xs">
                    <option value="all_active" {{ request('status_filter', 'all_active') == 'all_active' ? 'selected' : '' }}>Semua Aktif</option>
                    <option value="pending" {{ request('status_filter') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="approved" {{ request('status_filter') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="borrowed" {{ request('status_filter') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                </select>
            </label>
            <button type="submit" class="btn btn-sm bg-pastelOrange text-white">Filter</button> {{-- Warna tombol disesuaikan --}}
            @if(request()->has('status_filter') && request('status_filter') !== 'all_active' || request()->has('borrower_search'))
                <a href="{{ route('operator.requests.index') }}" class="btn btn-sm btn-ghost">Reset</a>
            @endif
        </form>
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
        <span> Gagal memproses permintaan.</span>
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
                    <th class="text-center">Status</th>
                    <th>Diproses Oleh</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse ($borrowRequests as $request)
                    <tr class="hover">
                        <td>#{{ $request->id }}</td>
                        <td><span class="font-semibold">{{ $request->borrower->name ?? 'N/A' }}</span><br> <span class="text-xs text-gray-500">{{ $request->borrower->email ?? '' }}</span></td>
                        <td>{{ $request->request_date ? \Carbon\Carbon::parse($request->request_date)->isoFormat('D MMM YY, HH:mm') : '-' }}</td>
                        <td>
                            <ul class="list-disc list-inside text-xs">
                                @foreach($request->items as $item)
                                    <li>{{ $item->name }} ({{ $item->pivot->quantity }} unit)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $request->expected_return_date ? \Carbon\Carbon::parse($request->expected_return_date)->isoFormat('D MMM YY') : '-' }}</td>
                        <td class="text-center">
                            @php
                                $status = $request->status;
                                $badgeClass = match($status) {
                                    'pending' => 'badge-warning',
                                    'approved' => 'badge-info',
                                    'borrowed' => 'badge-primary',
                                    default => 'badge-ghost',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} badge-md">{{ ucfirst($status) }}</span>
                        </td>
                        <td>{{ $request->operator->name ?? '-' }}</td>
                        <td class="text-center whitespace-nowrap">
                            @if($request->status === 'pending')
                                <form action="{{ route('operator.requests.approve', $request) }}" method="POST" class="inline mr-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-xs btn-success" title="Setujui">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                    </button>
                                </form>
                                <form action="{{ route('operator.requests.reject', $request) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-xs btn-error" title="Tolak">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </form>
                            @elseif($request->status === 'approved')
                                <form action="{{ route('operator.requests.markBorrowed', $request) }}" method="POST" class="inline">
                                     @csrf
                                     @method('PATCH')
                                     <button type="submit" class="btn btn-xs btn-primary" title="Tandai Sudah Diambil Peminjam">
                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                                         Dipinjam
                                     </button>
                                 </form>
                            @elseif($request->status === 'borrowed')
                                <form action="{{ route('operator.requests.return', $request) }}" method="POST" class="inline">
                                     @csrf
                                     @method('PATCH')
                                     <button type="submit" class="btn btn-xs btn-info" title="Tandai Sudah Dikembalikan">
                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" /></svg>
                                         Dikembalikan
                                     </button>
                                 </form>
                            @else
                                <span class="text-xs text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            Tidak ada permintaan peminjaman aktif ditemukan.
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
