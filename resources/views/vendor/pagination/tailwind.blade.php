@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between w-full">
        <div class="hidden sm:block">
            <div>
                <p class="text-xs text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
        </div>
        <div>
            <div class="join">
                @if ($paginator->onFirstPage())
                    <button class="join-item btn btn-sm btn-disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">«</button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn btn-sm" aria-label="{{ __('pagination.previous') }}">«</a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <button class="join-item btn btn-sm btn-disabled" aria-disabled="true">{{ $element }}</button>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button class="join-item btn btn-sm btn-active bg-greenSlate text-white" aria-current="page">{{ $page }}</button>
                            @else
                                <a href="{{ $url }}" class="join-item btn btn-sm">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn btn-sm" aria-label="{{ __('pagination.next') }}">»</a>
                @else
                    <button class="join-item btn btn-sm btn-disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">»</button>
                @endif
            </div>
        </div>
    </nav>
@endif