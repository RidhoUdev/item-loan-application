<x-form-modal id="create_item_modal" title="Tambah Barang Baru" maxWidth="max-w-3xl">

    <form id="create_item_form_content" method="POST" action="{{ route('admin.items.store') }}" class="space-y-4"
        enctype="multipart/form-data">
        @csrf

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Nama Barang<span class="text-error">*</span></span> </div>
            <input type="text" name="name" placeholder="Masukkan nama barang" value="{{ old('name') }}"
                class="input  input-bordered w-full @error('name') input-error @enderror" required />
            @error('name')
                <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div>
            @enderror
        </label>

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Kategori<span class="text-error">*</span></span> </div>
            <select name="category_id"
                class="select select-bordered w-full @error('category_id') select-error @enderror" required>
                <option disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori</option>
                @foreach ($categories ?? [] as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div>
            @enderror
        </label>

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Deskripsi<span class="text-error">*</span></span> </div>
            <textarea name="description"
                class="textarea textarea-bordered w-full h-24 @error('description') textarea-error @enderror"
                placeholder="Deskripsi detail barang" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div>
            @enderror
        </label>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <label class="form-control w-full">
                <div class="label block"> <span class="label-text">Jumlah Stok<span class="text-error">*</span></span>
                </div>
                <input type="number" name="quantity" placeholder="0" value="{{ old('quantity', 0) }}" min="0"
                    class="input input-bordered w-full @error('quantity') input-error @enderror" required />
                @error('quantity')
                    <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div>
                @enderror
            </label>

            <label class="form-control w-full">
                <div class="label block"> <span class="label-text">Status<span class="text-error">*</span></span> </div>
                <select name="status" class="select select-bordered w-full @error('status') select-error @enderror"
                    required>
                    <option value="tersedia" {{ old('status', 'tersedia') == 'tersedia' ? 'selected' : '' }}>Tersedia
                    </option>
                    <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak
                        Tersedia</option>
                </select>
                @error('status')
                    <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div>
                @enderror
            </label>
        </div>

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Gambar Barang (Opsional)</span> </div>
            <input type="file" name="image" id="image_input"
                class="file-input file-input-bordered w-full @error('image') file-input-error @enderror"
                accept="image/*" />
            <div class="label block">
                <span class="label-text-alt">Format: jpg, png, jpeg, gif, svg, webp. Max: 2MB</span>
            </div>
            @error('image')
                <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div>
            @enderror
        </label>

        <div class="w-full mt-2">
            <div id="preview_container"
                class="relative w-full h-20 rounded-lg border-2 border-dashed border-base-300 flex items-center justify-center">

                <div id="placeholder_preview" class="text-center text-base-content text-opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-xs">Preview Gambar</span>
                </div>

                <img id="image_preview" src="#" alt="Preview Gambar"
                    class="absolute hidden h-20 w-20 rounded-lg object-cover" />

                <button type="button" id="reset_image_button"
                    class="btn btn-circle btn-xs absolute top-2 right-2 hidden bg-red-500 text-white hover:bg-red-600 border-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

    </form>

    <x-slot name="actions">
        <button type="submit" form="create_item_form_content" class="btn bg-pastelOrange text-white">Simpan</button>
        <form method="dialog" class="inline">
            <button class="btn btn-ghost">Batal</button>
        </form>
    </x-slot>


</x-form-modal>