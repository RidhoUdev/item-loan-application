<x-form-modal id="edit_user_modal_{{ $user->id }}" title="Edit User: {{ $user->name }}" maxWidth="max-w-2xl">

  <form id="edit_user_form_content_{{ $user->id }}" method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
      @csrf
      @method('PUT')

      <label class="form-control w-full">
          <div class="label block"> <span class="label-text">Nama Lengkap<span class="text-error">*</span></span> </div>
          <input type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}"
                 class="input input-bordered w-full @error('name') input-error @enderror" required />
          @error('name') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
      </label>

      <label class="form-control w-full">
           <div class="label block"> <span class="label-text">Username<span class="text-error">*</span></span> </div>
           <input type="text" name="username" placeholder="Masukkan username unik" value="{{ old('username', $user->username) }}"
                  class="input input-bordered w-full @error('username') input-error @enderror" required />
           @error('username') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
      </label>

      <label class="form-control w-full">
          <div class="label block"> <span class="label-text">Email<span class="text-error">*</span></span> </div>
          <input type="email" name="email" placeholder="email@example.com" value="{{ old('email', $user->email) }}"
                 class="input input-bordered w-full @error('email') input-error @enderror" required />
          @error('email') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
      </label>

      <label class="form-control w-full">
          <div class="label block"> <span class="label-text">Nomor Telepon</span> </div>
          <input type="tel" name="phone" placeholder="Contoh: 08123456789" value="{{ old('phone', $user->phone) }}"
                 class="input input-bordered w-full @error('phone') input-error @enderror" />
          @error('phone') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
      </label>

      <label class="form-control w-full">
          <div class="label block"> <span class="label-text">Role<span class="text-error">*</span></span> </div>
          <select name="role" class="select select-bordered w-full @error('role') select-error @enderror" required>
              <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}>Operator</option>
              <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
          </select>
           @error('role') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
      </label>

      <label class="form-control w-full">
          <div class="label block">
              <span class="label-text">Password Baru (Opsional)</span>
              <span class="label-text-alt">Kosongkan jika tidak ingin diubah</span>
          </div>
          <input type="password" name="password" placeholder="Minimal 8 karakter"
                 class="input input-bordered w-full @error('password') input-error @enderror" />
          @error('password') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
      </label>

      <label class="form-control w-full">
           <div class="label block"> <span class="label-text">Konfirmasi Password Baru</span> </div>
           <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                  class="input input-bordered w-full" />
      </label>

  </form>

  <x-slot name="actions">
      <button type="submit" form="edit_user_form_content_{{ $user->id }}" class="btn btn-primary">Update</button>
      <form method="dialog" class="inline">
          <button class="btn btn-ghost">Batal</button>
      </form>
  </x-slot>

</x-form-modal>
