<x-form-modal id="create_category_modal" title="Tambah Kategori Baru" maxWidth="max-w-lg">
    <form id="create_category_form_content" method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
        @csrf
        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Nama Kategori<span class="text-error">*</span></span> </div>
            <input type="text" name="name" placeholder="Masukkan nama kategori" value="{{ old('name') }}"
                   class="input input-bordered w-full @error('name') input-error @enderror" required />
            @error('name') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
        </label>

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Deskripsi</span> </div>
            <textarea name="description" class="textarea textarea-bordered w-full h-24 @error('description') textarea-error @enderror"
                      placeholder="Deskripsi singkat kategori (opsional)">{{ old('description') }}</textarea>
            @error('description') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
        </label>
    </form>

    <x-slot name="actions">
        <button type="submit" form="create_category_form_content" class="btn bg-pastelOrange text-white">Simpan</button>
        <form method="dialog" class="inline">
            <button class="btn btn-ghost">Batal</button>
        </form>
    </x-slot>
</x-form-modal>
