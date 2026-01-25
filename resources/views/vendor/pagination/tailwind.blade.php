@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        {{-- Mobile --}}
        <div class="flex gap-2 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium
                    text-blue-300 bg-white border border-blue-200 cursor-not-allowed rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium
                   text-blue-700 bg-white border border-blue-300 rounded-md
                   hover:bg-blue-50 hover:text-blue-800 transition">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium
                   text-blue-700 bg-white border border-blue-300 rounded-md
                   hover:bg-blue-50 hover:text-blue-800 transition">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium
                    text-blue-300 bg-white border border-blue-200 cursor-not-allowed rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between sm:gap-4">

            <div>
                <p class="text-sm text-blue-700">
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

            <div>
                <span class="inline-flex shadow-sm rounded-md">

                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <span class="inline-flex items-center px-2 py-2
                            text-blue-300 bg-white border border-blue-200 cursor-not-allowed rounded-l-md">
                            ‹
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                           class="inline-flex items-center px-2 py-2
                           text-blue-600 bg-white border border-blue-300 rounded-l-md
                           hover:bg-blue-50 transition">
                            ‹
                        </a>
                    @endif

                    {{-- Pages --}}
                    @foreach ($elements as $element)

                        @if (is_string($element))
                            <span class="inline-flex items-center px-4 py-2
                                text-blue-400 bg-white border border-blue-200">
                                {{ $element }}
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="inline-flex items-center px-4 py-2
                                        font-semibold text-white bg-blue-600
                                        border border-blue-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="inline-flex items-center px-4 py-2
                                       text-blue-600 bg-white border border-blue-300
                                       hover:bg-blue-50 hover:text-blue-800 transition">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif

                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                           class="inline-flex items-center px-2 py-2
                           text-blue-600 bg-white border border-blue-300 rounded-r-md
                           hover:bg-blue-50 transition">
                            ›
                        </a>
                    @else
                        <span class="inline-flex items-center px-2 py-2
                            text-blue-300 bg-white border border-blue-200 cursor-not-allowed rounded-r-md">
                            ›
                        </span>
                    @endif

                </span>
            </div>
        </div>
    </nav>
@endif
