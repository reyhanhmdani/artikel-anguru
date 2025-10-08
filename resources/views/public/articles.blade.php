@extends('layouts.lay-home')

@section('title', 'Kumpulan Artikel Terbaik')

@section('content')
<main class="pt-24 pb-20 md:pt-32">
    {{-- Hero Section --}}
    <section class="relative py-24 overflow-hidden">
        <div class="absolute inset-0">
            <div class="w-full h-full bg-cover bg-center"
                style="background-image: url('{{ asset('assets/img/cover.jpg') }}')"></div>
            <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 text-gold drop-shadow-lg font-khusus">Kumpulan Artikel
                Terbaik</h1>
            <p class="text-lg md:text-xl text-text-secondary max-w-3xl mx-auto">
                Temukan inspirasi dan wawasan mendalam dari berbagai tulisan Andre Raditya tentang rezeki, kehidupan,
                dan perjalanan spiritual.
            </p>
        </div>
    </section>

    {{-- Filter Arsip: Dropdown Pop-up Minimalis --}}
    <div class="container mx-auto px-6 pt-8 pb-10">
        <div class="flex justify-end">
            {{-- Dropdown Filter Utama --}}
            <div x-data="{ open: false }" class="relative inline-block text-left z-20">
                {{-- Tombol Toggle Filter --}}
                <button @click="open = !open" type="button"
                    class="inline-flex justify-center w-full rounded-lg border border-gray-600 shadow-sm px-4 py-2 bg-card-bg text-sm font-medium text-text-primary hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-dark-bg focus:ring-gold transition duration-200">
                    @if($year)
                    {{-- Tampilan Tombol --}}
                    {{-- Pengecekan $month sudah aman karena sudah dikonversi jadi integer di controller --}}
                    @if($month)
                    {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') . ' ' . $year }}
                    @else
                    {{ 'Arsip ' . $year }}
                    @endif
                    @else
                    (Tahun & Bulan)
                    @endif

                    {{-- Ikon Arrow --}}
                    <svg class="h-5 w-5 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Panel Dropdown (Menggantikan pop-up native browser) --}}
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-card-bg ring-1 ring-black ring-opacity-5 divide-y divide-gray-700 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button">

                    <div class="py-1">
                        {{-- 1. PILIHAN TAHUN (Semua Kategori) --}}
                        <div class="px-3 py-2 text-gold font-semibold text-xs uppercase tracking-wider">Pilih Tahun
                        </div>
                        @foreach($availableYears as $availableYear)
                        <a href="{{ route('public.articles', ['year' => $availableYear]) }}"
                            class="flex items-center px-4 py-2 text-sm hover:bg-dark-bg @if($year == $availableYear) text-gold font-semibold @else text-text-primary @endif"
                            role="menuitem">
                            {{ $availableYear }}
                        </a>
                        @endforeach
                    </div>

                    {{-- 2. PILIHAN BULAN (Filter) --}}
                    @if($year)
                    <div class="py-1">
                        <div class="px-3 py-2 text-gold font-semibold text-xs uppercase tracking-wider">Bulan ({{ $year
                            }})</div>
                        <a href="{{ route('public.articles', ['year' => $year]) }}"
                            class="flex items-center px-4 py-2 text-sm hover:bg-dark-bg @if(!$month) text-red-400 font-semibold @else text-text-primary @endif"
                            role="menuitem">
                            Semua Bulan
                        </a>
                        @foreach($availableMonths as $availableMonth)
                        <a href="{{ route('public.articles', ['year' => $year, 'month' => $availableMonth->month_num]) }}"
                            class="flex items-center px-4 py-2 text-sm hover:bg-dark-bg @if($month == $availableMonth->month_num) text-gold font-semibold @else text-text-primary @endif"
                            role="menuitem">
                            {{ $availableMonth->month_name }}
                        </a>
                        @endforeach
                    </div>
                    @endif

                    {{-- Tombol Reset --}}
                    @if($year || $month)
                    <div class="py-1">
                        <a href="{{ route('public.articles') }}"
                            class="flex items-center px-4 py-2 text-sm bg-red-600 text-white hover:bg-red-700 rounded-b-md"
                            role="menuitem">
                            Reset Filter
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Artikel Terbaru (tampilan khusus) --}}
    <section class="py-16 bg-dark-bg">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($articles as $article)
                <article
                    class="blog-card rounded-lg overflow-hidden bg-card-bg shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col">
                    {{-- Tampilkan label "Terbaru" hanya jika kategorinya "Terbaru" --}}
                    @if($article->category === 'Terbaru')
                    <a href="{{ route('public.show-article', $article->id) }}" class="relative block">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('default.jpg') }}"
                            alt="{{ $article->title }}" class="w-full h-64 object-cover">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute inset-0 bg-gray-900 opacity-25">
                        </div>
                        <div
                            class="text-xs absolute top-4 right-4 bg-gold px-4 py-2 text-dark-bg rounded-full mt-3 mr-3 hover:bg-card-bg hover:text-gold transition duration-500 ease-in-out">
                            Terbaru
                        </div>
                    </a>
                    @else
                    {{-- Card tanpa label "Terbaru" --}}
                    <a href="{{ route('public.show-article', $article->id) }}" class="relative block">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('default.jpg') }}"
                            alt="{{ $article->title }}" class="w-full h-64 object-cover">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute inset-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                    @endif

                    <div class="px-6 py-4 mb-auto">
                        <div class="text-sm mb-2 text-gold">Andre Raditya</div>
                        <h3 class="text-xl font-bold mb-3 text-text-primary">
                            <a href="{{ route('public.show-article', $article->id) }}"
                                class="hover:text-gold transition-colors duration-200">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-text-secondary text-sm line-clamp-3">
                            {{ Str::limit(html_entity_decode(strip_tags($article->content)), 150) }}
                        </p>
                    </div>

                    <div
                        class="px-6 py-3 flex flex-row items-center justify-between bg-card-bg border-t border-gray-700/50">
                        <span class="py-1 text-xs font-regular text-text-secondary flex items-center">
                            <svg height="13px" width="13px" fill="currentColor" viewBox="0 0 512 512">
                                <path
                                    d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256 c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128 c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z">
                                </path>
                            </svg>
                            <span class="ml-1">{{ $article->created_at->translatedFormat('j F Y') }}</span>
                        </span>
                        <a href="{{ route('public.show-article', $article->id) }}"
                            class="py-1 text-xs font-regular text-text-secondary flex items-center hover:text-gold transition-colors duration-200">
                            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <span class="ml-1">Read</span>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            {{-- Paginasi --}}
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
</main>
@endsection