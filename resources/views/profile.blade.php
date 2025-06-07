<dialog id="profile_modal" class="modal modal-bottom sm:modal-middle">
  <div class="modal-box w-11/12 max-w-lg"> 
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>

    <h3 class="font-bold text-xl mb-5 text-center">Profil Saya</h3>

    <div class="space-y-4">
        <div class="flex justify-center mb-6">
            <div class="avatar">
                <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'U') }}&background=random&color=fff&size=128" alt="Avatar {{ $user->name }}" />
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <tbody>
                    <tr>
                        <th class="w-1/3">Nama Lengkap</th>
                        <td>: {{ $user->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>: {{ $user->username ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $user->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td>: {{ $user->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Peran (Role)</th>
                        <td>: <span class="badge badge-neutral">{{ ucfirst($user->role ?? '-') }}</span></td>
                    </tr>
                    <tr>
                        <th>Bergabung Sejak</th>
                        <td>: {{ $user->created_at ? $user->created_at->isoFormat('D MMMM YYYY') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal-action mt-6">
        <form method="dialog">
            <button class="btn">Tutup</button>
        </form>
        
        
    </div>
  </div>
  
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>