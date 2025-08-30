{{-- Nomor Halaman --}}
<div class="hidden sm:block">
    <span class="relative z-0 inline-flex shadow-sm rounded-md">
        @if (is_array($elements['numbers']))
        {{-- Tombol '1' di awal --}}
        @if ($paginator->currentPage() > 3)
        <a href="{{ $paginator->url(1) }}"
            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:z-10 transition ease-in-out duration-150">
            1
        </a>
        @if ($paginator->currentPage() > 4)
        <span
            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">
            ...
        </span>
        @endif
        @endif

        {{-- Link Halaman di sekitar halaman aktif --}}
        @foreach ($elements['numbers'] as $page => $url)
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

        {{-- Ellipsis dan tombol halaman terakhir --}}
        @if ($paginator->currentPage() < $paginator->lastPage() - 2)
            @if ($paginator->lastPage() > 4 && $paginator->currentPage() < $paginator->lastPage() - 3)
                <span
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">
                    ...
                </span>
                @endif
                <a href="{{ $paginator->url($paginator->lastPage()) }}"
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:z-10 transition ease-in-out duration-150">
                    {{ $paginator->lastPage() }}
                </a>
                @endif
                @endif
    </span>
</div>