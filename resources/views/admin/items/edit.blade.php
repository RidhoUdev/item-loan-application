<x-form-modal id="edit_item_modal_{{ $item->id }}" title="Edit Item: {{ $item->name }}" maxWidth="max-w-3xl">

    <form id="edit_item_form_content_{{ $item->id }}" method="POST" action="{{ route('admin.items.update', $item) }}" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Nama Barang<span class="text-error">*</span></span> </div>
            <input type="text" name="name" placeholder="Masukkan nama barang" value="{{ old('name', $item->name) }}"
                   class="input input-bordered w-full @error('name') input-error @enderror" required />
            @error('name') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
        </label>

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Kategori<span class="text-error">*</span></span> </div>
            <select name="category_id" class="select select-bordered w-full @error('category_id') select-error @enderror" required>
                @foreach ($categories ?? [] as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
             @error('category_id') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
        </label>

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Deskripsi<span class="text-error">*</span></span> </div>
            <textarea name="description" class="textarea textarea-bordered w-full h-24 @error('description') textarea-error @enderror"
                      placeholder="Deskripsi detail barang" required>{{ old('description', $item->description) }}</textarea>
            @error('description') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
        </label>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <label class="form-control w-full">
                <div class="label block"> <span class="label-text">Jumlah Stok<span class="text-error">*</span></span> </div>
                <input type="number" name="quantity" placeholder="0" value="{{ old('quantity', $item->quantity) }}" min="0"
                       class="input input-bordered w-full @error('quantity') input-error @enderror" required />
                @error('quantity') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
            </label>

            <label class="form-control w-full">
                <div class="label block"> <span class="label-text">Status<span class="text-error">*</span></span> </div>
                <select name="status" class="select select-bordered w-full @error('status') select-error @enderror" required>
                    <option value="tersedia" {{ old('status', $item->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status', $item->status) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                 @error('status') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
            </label>
        </div>

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Ganti Gambar (Opsional)</span> </div>
             @if($item->image)
               <div class="mb-2">
                   <img src="{{ asset('storage/' . $item->image) }}" alt="Current Image" class="w-20 h-20 object-cover rounded">
                   <span class="text-xs text-gray-500">Gambar saat ini. Upload baru untuk mengganti.</span>
               </div>
             @endif
            <input type="file" name="image" class="file-input file-input-bordered w-full @error('image') file-input-error @enderror" />
            <div class="label block">
                 <span class="label-text-alt">Format: jpg, png, jpeg, gif, svg, webp. Max: 2MB</span>
            </div>
            @error('image') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
        </label>

    </form>

    <x-slot name="actions">
        <button type="submit" form="edit_item_form_content_{{ $item->id }}" class="btn btn-primary">Update</button>
        <form method="dialog" class="inline">
            <button class="btn btn-ghost">Batal</button>
        </form>
    </x-slot>

</x-form-modal>
