@props(['id', 'title', 'maxWidth' => 'max-w-2xl'])

<dialog id="{{ $id }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-neutralize w-11/12 {{ $maxWidth }}">

        <div class="flex justify-between items-center pb-3 mb-4 border-b border-base-300">
            <h3 class="font-bold text-lg">{{ $title }}</h3>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
        </div>

        <div class="modal-content">
            {{ $slot }}
        </div>

        <div class="modal-action mt-6">
            {{ $actions ?? '' }}
        </div>

    </div>

</dialog>
