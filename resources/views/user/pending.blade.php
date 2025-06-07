@extends('layouts.user')

@section('title', 'Riwayat Peminjaman Saya')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Riwayat Peminjaman Saya
        </h1>
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

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="table w-full table-zebra">
            <thead class="text-xs text-black uppercase bg-gray-100">
                <tr>
                    <th>ID Req.</th>
                    <th>Tgl. Ajuan</th>
                    <th>Barang Dipinjam</th>
                    <th>Jml</th>
                    <th>Tgl. Wajib Kembali</th>
                    <th>Tgl. Kembali Aktual</th>
                    <th class="text-center">Status</th>
                    <th>Operator</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse ($borrowRequests as $request)
                    <tr class="hover">
                        <td>#{{ $request->id }}</td>
                        <td>{{ $request->request_date ? \Carbon\Carbon::parse($request->request_date)->isoFormat('D MMM YYYY, HH:mm') : '-' }}</td>
                        <td>
                            {{ $request->items->first()->name ?? 'N/A' }}
                        </td>
                        <td>
                            {{ $request->items->first()->pivot->quantity ?? 'N/A' }}
                        </td>
                        <td>{{ $request->expected_return_date ? \Carbon\Carbon::parse($request->expected_return_date)->isoFormat('D MMM YYYY') : '-' }}</td>
                        <td>{{ $request->return_date ? \Carbon\Carbon::parse($request->actual_return_date)->isoFormat('D MMM YYYY, HH:mm') : '-' }}</td>
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
                        <td class="whitespace-nowrap">
                            @if($request->status === 'pending')
                                <form action="{{ route('user.borrow.cancel', $request) }}" method="POST" onsubmit="return confirm('Batalkan permintaan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-outline btn-error cancel-button">Batalkan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            Anda belum memiliki riwayat peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
         @if ($borrowRequests->hasPages())
            {{ $borrowRequests->links() }}
         @endif
    </div>

@endsection

@push('scripts')
    {{-- JS Tambahan jika diperlukan --}}
@endpush

