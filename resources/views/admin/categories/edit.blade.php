<x-form-modal id="edit_category_modal_{{ $category->id }}" title="Edit Kategori: {{ $category->name }}" maxWidth="max-w-lg">

    <form id="edit_category_form_content_{{ $category->id }}" method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Nama Kategori<span class="text-error">*</span></span> </div>
            <input type="text" name="name" placeholder="Masukkan nama kategori" value="{{ old('name', $category->name) }}"
                   class="input input-bordered w-full @error('name') input-error @enderror" required />
            @error('name') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
        </label>

        <label class="form-control w-full">
            <div class="label block"> <span class="label-text">Deskripsi</span> </div>
             <textarea name="description" class="textarea textarea-bordered w-full h-24 @error('description') textarea-error @enderror"
                       placeholder="Deskripsi singkat kategori (opsional)">{{ old('description', $category->description) }}</textarea>
            @error('description') <div class="label block"> <span class="label-text-alt text-error">{{ $message }}</span> </div> @enderror
        </label>

    </form>

    <x-slot name="actions">
        <button type="submit" form="edit_category_form_content_{{ $category->id }}" class="btn btn-primary">Update</button>
        <form method="dialog" class="inline">
            <button class="btn btn-ghost">Batal</button>
        </form>
    </x-slot>

</x-form-modal>
