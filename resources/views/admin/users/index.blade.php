@extends('layouts.admin')

@section('title', 'Manage Accounts')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">
            Pengelolaan Akun
        </h1>
        <button class="btn bg-pastelOrange text-white btn-sm" onclick="create_user_modal.showModal()">
             <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
             </svg>
            Tambah User
        </button>
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

    @if ($errors->any())
    <div id="alert-validation" role="alert" class="alert alert-warning mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        <span> Gagal menambahkan user. Silakan klik 'Tambah User' lagi dan periksa error pada form.</span>
    </div>
    @endif


    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="table w-full">
            <thead class="text-xs text-white uppercase bg-compound">
                <tr>
                    <th>Nama & Email</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-black">
                @forelse ($users as $user)
                    <tr class="hover">
                        <td>
                            <div class="font-semibold">{{ $user->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $user->email ?? '' }}</div>
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td class="font-semibold">
                             <span class="badge badge-sm text-white
                                {{ $user->role === 'admin' ? 'badge-error' :
                                   ($user->role === 'operator' ? 'badge-warning' :
                                   'badge-success') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="text-center whitespace-nowrap">
                            <button class="btn btn-xs btn-outline btn-info mr-1"
                                    onclick="edit_user_modal_{{ $user->id }}.showModal()">
                                Edit
                            </button>

                            @if(Auth::id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-outline btn-error delete-button">Delete</button>
                            </form>
                        @endif
                        </td>
                    </tr>
                     @include('admin.users.edit', ['user' => $user])
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            Tidak ada data akun ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
         @if ($users->hasPages())
             {{ $users->links() }}
         @endif
    </div>

    @include('admin.users.create')

@endsection
