@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation"
        class="flex flex-col sm:flex-row justify-between items-center mt-6 space-y-4 sm:space-y-0">

        {{-- Informasi Halaman (Mobile & Desktop) --}}
        <div>
            <p class="text-sm text-gray-700 leading-5">
                Menampilkan
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                sampai
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                dari
                <span class="font-medium">{{ $paginator->total() }}</span>
                hasil
            </p>
        </div>

        {{-- Pagination untuk Desktop (sm:block) --}}
        <div class="hidden sm:flex items-center space-x-2">
            {{-- Tombol Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md leading-5">
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150">
                    Sebelumnya
                </a>
            @endif

            {{-- Nomor Halaman dengan Elipsis --}}
            <div class="hidden sm:block">
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">
                                {{ $element }}
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-600 border border-blue-600 cursor-default leading-5">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:z-10 transition ease-in-out duration-150">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </span>
            </div>

            {{-- Tombol Selanjutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150">
                    Selanjutnya
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-r-md leading-5">
                    Selanjutnya
                </span>
            @endif
        </div>

        {{-- Pagination untuk Mobile (sm:hidden) --}}
        <div class="flex sm:hidden items-center justify-center space-x-2 w-full">
            {{-- Tombol Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span
                    class="flex-1 text-center py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md leading-5">
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="flex-1 text-center py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150">
                    Sebelumnya
                </a>
            @endif

            {{-- Nomor Halaman Singkat --}}
            <span
                class="flex-1 text-center relative z-0 inline-flex shadow-sm rounded-md mx-2">
                @if ($paginator->lastPage() > 1)
                    {{-- Halaman Pertama --}}
                    @if ($paginator->currentPage() > 1)
                        <a href="{{ $paginator->url(1) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150">1</a>
                    @else
                        <span class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 cursor-default leading-5">1</span>
                    @endif

                    {{-- Elipsis --}}
                    @if ($paginator->currentPage() > 2)
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">...</span>
                    @endif

                    {{-- Halaman Saat Ini --}}
                    @if ($paginator->currentPage() > 1 && $paginator->currentPage() < $paginator->lastPage())
                        <span class="px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-600 border border-blue-600 cursor-default leading-5">{{ $paginator->currentPage() }}</span>
                    @endif

                    {{-- Elipsis --}}
                    @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                        <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">...</span>
                    @endif

                    {{-- Halaman Terakhir --}}
                    @if ($paginator->lastPage() > 1)
                        @if ($paginator->currentPage() != $paginator->lastPage())
                             <a href="{{ $paginator->url($paginator->lastPage()) }}" class="px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150">{{ $paginator->lastPage() }}</a>
                        @else
                            <span class="px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-600 border border-blue-600 cursor-default leading-5">{{ $paginator->lastPage() }}</span>
                        @endif
                    @endif
                @endif
            </span>

            {{-- Tombol Selanjutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="flex-1 text-center py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150">
                    Selanjutnya
                </a>
            @else
                <span
                    class="flex-1 text-center py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5">
                    Selanjutnya
                </span>
            @endif
        </div>
    </nav>
@endif
