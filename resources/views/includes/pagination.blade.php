@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation"
    class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-6 mt-6 px-2">

    {{-- Info halaman --}}
    <div class="text-xs sm:text-sm text-gray-600 text-center sm:text-left order-2 sm:order-1">
        Menampilkan
        <span class="font-semibold text-gray-800">{{ $paginator->firstItem() }}</span>
        –
        <span class="font-semibold text-gray-800">{{ $paginator->lastItem() }}</span>
        dari
        <span class="font-semibold text-gray-800">{{ $paginator->total() }}</span>
        hasil
    </div>

    {{-- Navigasi halaman --}}
    <div
        class="flex items-center justify-center flex-wrap gap-1 sm:gap-2 order-1 sm:order-2 w-full sm:w-auto bg-white rounded-lg shadow-sm p-2 sm:p-0 border sm:border-0">

        {{-- Tombol Sebelumnya --}}
        @if ($paginator->onFirstPage())
        <span
            class="px-3 py-2 text-sm sm:text-base text-gray-400 bg-gray-100 rounded-md cursor-not-allowed select-none flex items-center justify-center">
            &laquo;
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
            class="px-3 py-2 text-sm sm:text-base text-gray-700 bg-white border border-gray-200 rounded-md hover:bg-blue-50 hover:text-blue-600 transition">
            &laquo;
        </a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
        @if (is_string($element))
        <span class="px-3 py-2 text-sm text-gray-400">{{ $element }}</span>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span
            class="px-3 py-2 text-sm sm:text-base font-semibold text-white bg-blue-600 border border-blue-600 rounded-md shadow-sm">
            {{ $page }}
        </span>
        @else
        <a href="{{ $url }}"
            class="px-3 py-2 text-sm sm:text-base text-gray-700 bg-white border border-gray-200 rounded-md hover:bg-blue-50 hover:text-blue-600 transition">
            {{ $page }}
        </a>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Tombol Selanjutnya --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="px-3 py-2 text-sm sm:text-base text-gray-700 bg-white border border-gray-200 rounded-md hover:bg-blue-50 hover:text-blue-600 transition">
            &raquo;
        </a>
        @else
        <span
            class="px-3 py-2 text-sm sm:text-base text-gray-400 bg-gray-100 rounded-md cursor-not-allowed select-none flex items-center justify-center">
            &raquo;
        </span>
        @endif
    </div>
</nav>
@endif