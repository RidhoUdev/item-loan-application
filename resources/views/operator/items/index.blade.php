@extends('layouts.operator')

@section('title', 'Daftar Barang')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Daftar Barang Sekolah
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
        <span> Gagal mengubah status</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="table w-full table-zebra">
            <thead class="text-xs text-black uppercase bg-gray-100">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Stok Tersedia</th>
                    <th class="text-center">Stok Total</th>
                    <th class="text-center">Status & Aksi</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse ($items as $item)
                    <tr class="hover">
                        <td>{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                        <td>
                             @if($item->image)
                                <div class="avatar">
                                    <div class="w-12 h-12 rounded">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" />
                                    </div>
                                </div>
                            @else
                                <div class="avatar placeholder">
                                     <div class="bg-neutral-focus text-neutral-content rounded w-12 h-12">
                                         <span class="text-xs">No Img</span>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="font-bold">{{ $item->name }}</div>
                        </td>
                        <td>{{ $item->category->name ?? 'N/A' }}</td>
                        <td class="whitespace-nowrap">{{ Str::limit($item->description, 70, '...') ?? '-' }}</td>
                        <td class="text-center whitespace-nowrap">
                            <span class="badge badge-secondary">{{ $item->available_quantity }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-neutral badge-lg">{{ $item->quantity }}</span>
                        </td>
                        <td class="text-center whitespace-nowrap">
                            <span class="badge badge-sm {{ $item->status === 'tersedia' ? 'badge-success' : 'badge-error' }} mr-2">
                                {{ ucfirst($item->status) }}
                            </span>

                            <form action="{{ route('operator.items.updateStatus', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')

                                @if($item->status === 'tersedia')
                                    <input type="hidden" name="status" value="tidak tersedia">
                                    <button type="submit" class="btn btn-xs btn-warning" title="Jadikan Tidak Tersedia">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                    </button>
                                @else
                                     <input type="hidden" name="status" value="tersedia">
                                     <button type="submit" class="btn btn-xs btn-success" title="Jadikan Tersedia">
                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                     </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            Tidak ada data item ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
         @if ($items->hasPages())
             {{ $items->links() }}
         @endif
    </div>

@endsection

@push('scripts')
@endpush
