@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="my-8">

        {{-- Mobile Pagination --}}
        <div class="flex gap-3 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed rounded-lg">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-linear-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg transition transform hover:scale-105 shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Previous
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-linear-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg transition transform hover:scale-105 shadow-md">
                    Next
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @else
                <span
                    class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed rounded-lg">
                    Next
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            @endif

        </div>

        {{-- Desktop Pagination --}}
        <div class="hidden sm:flex sm:flex-col sm:items-center sm:gap-4">

            {{-- Info Text --}}
            <div class="text-sm text-gray-600">
                Menampilkan
                @if ($paginator->firstItem())
                    <span class="font-bold text-blue-600">{{ $paginator->firstItem() }}</span>
                    sampai
                    <span class="font-bold text-blue-600">{{ $paginator->lastItem() }}</span>
                @else
                    <span class="font-bold text-blue-600">{{ $paginator->count() }}</span>
                @endif
                dari
                <span class="font-bold text-blue-600">{{ $paginator->total() }}</span>
                hasil
            </div>

            {{-- Pagination Buttons --}}
            <div class="flex items-center gap-2">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                        class="inline-flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="inline-flex items-center justify-center w-10 h-10 text-blue-600 bg-white border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition transform hover:scale-110 shadow-sm"
                        aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true"
                            class="inline-flex items-center justify-center w-10 h-10 text-gray-500 font-bold">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                    class="inline-flex items-center justify-center w-10 h-10 text-white font-bold bg-linear-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg transform scale-110">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="inline-flex items-center justify-center w-10 h-10 text-gray-700 font-semibold bg-white border border-gray-300 hover:bg-blue-50 hover:border-blue-400 hover:text-blue-600 rounded-lg transition transform hover:scale-105 shadow-sm"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="inline-flex items-center justify-center w-10 h-10 text-blue-600 bg-white border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition transform hover:scale-110 shadow-sm"
                        aria-label="{{ __('pagination.next') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                        class="inline-flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
