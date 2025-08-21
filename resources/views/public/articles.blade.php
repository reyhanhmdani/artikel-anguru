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
                            <span class="ml-1">{{ $article->created_at->diffForHumans() }}</span>
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