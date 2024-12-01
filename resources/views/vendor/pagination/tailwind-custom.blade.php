@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-4">
        <div class="flex items-center space-x-2">
            <span class="text-xs font-medium text-gray-500">
                Menampilkan {{ $paginator->count() }} data dari total {{ $paginator->total() }} data <br/>
                Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}
            </span>
        </div>

        <div class="flex items-center space-x-2">
            @if ($paginator->onFirstPage())
                <span
                    class="px-2 py-1 text-sm font-medium text-gray-500 bg-gray-200 border border-gray-300 rounded-md cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left-pipe">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 6v12" />
                        <path d="M18 6l-6 6l6 6" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-2 py-1 text-sm font-medium text-white bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left-pipe">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 6v12" />
                        <path d="M18 6l-6 6l6 6" />
                    </svg>
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-2 py-1 text-sm font-medium text-white bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right-pipe">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 6l6 6l-6 6" />
                        <path d="M17 5v13" />
                    </svg>
                </a>
            @else
                <span
                    class="px-2 py-1 text-sm font-medium text-gray-500 bg-gray-200 border border-gray-300 rounded-md cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right-pipe">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 6l6 6l-6 6" />
                        <path d="M17 5v13" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
