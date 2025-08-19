@extends('layouts.lay-home')

@section('title', $article->title)

@section('content')
<main>
    <div class="relative bg-cover bg-center h-[500px] flex items-center justify-center"
        style="background-image: url('{{ asset('storage/' . $article->image) }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div>

        <div class="relative z-10 text-center text-white p-6">
            <h1 class="text-2xl md:text-5xl font-bold mb-12 animate-fade-in-up">
                {{ $article->title }}
            </h1>
            <div class="flex items-center justify-center text-sm space-x-4 animate-fade-in-down">
                <span class="mr-4"><i class="fas fa-calendar-alt mr-2"></i>{{ $article->created_at->translatedFormat('d
                    F Y') }}</span>
                <span class="mr-4"><i class="fas fa-user mr-2"></i>Andre Raditya</span>
                @if($article->category)
                <span class="mr-4"><i class="fas fa-tag mr-2"></i>{{ $article->category }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="py-12 bg-card-bg text-text-primary">
        <div class="container mx-auto px-6">
            <article class="bg-card-bg p-8 rounded-lg shadow-lg">
                <div class="prose prose-invert max-w-none leading-relaxed">
                    {{-- Konten artikel akan dirender di sini --}}
                    {!! $article->content !!}
                </div>

                <div class="mt-8 pt-6 border-t border-gray-700 text-text-secondary">
                    <p class="mb-4">Bagikan Artikel Ini:</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-500 hover:text-blue-700 text-2xl"><i
                                class="fab fa-facebook-square"></i></a>
                        <a href="#" class="text-blue-400 hover:text-blue-600 text-2xl"><i
                                class="fab fa-twitter-square"></i></a>
                        <a href="#" class="text-red-500 hover:text-red-700 text-2xl"><i
                                class="fab fa-pinterest-square"></i></a>
                        <a href="#" class="text-green-500 hover:text-green-700 text-2xl"><i
                                class="fab fa-whatsapp-square"></i></a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-2xl"><i
                                class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </article>

            <section class="mt-12">
                <h2 class="text-3xl font-bold text-gold mb-6 text-center">Artikel Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($latestArticles as $otherArticle)
                    <article
                        class="blog-card rounded-lg overflow-hidden bg-card-bg shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col">
                        <a href="{{ route('public.show-article', $otherArticle->id) }}" class="relative block">
                            <img src="{{ $otherArticle->image ? asset('storage/' . $otherArticle->image) : asset('default.jpg') }}"
                                alt="{{ $otherArticle->title }}" class="w-full h-64 object-cover">
                            <div
                                class="hover:bg-transparent transition duration-300 absolute inset-0 bg-gray-900 opacity-25">
                            </div>
                        </a>

                        <div class="px-6 py-4 mb-auto">
                            <div class="text-sm mb-2 text-gold">andre raditya</div>
                            <h3 class="text-xl font-bold mb-3 text-text-primary">
                                <a href="{{ route('public.show-article', $otherArticle->id) }}"
                                    class="hover:text-gold transition-colors duration-200">
                                    {{ $otherArticle->title }}
                                </a>
                            </h3>
                            <p class="text-text-secondary text-sm line-clamp-3">
                                {{ Str::limit(strip_tags($otherArticle->content), 150) }}
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
                                <span class="ml-1">{{ $otherArticle->created_at->diffForHumans() }}</span>
                            </span>
                            <a href="{{ route('public.show-article', $otherArticle->id) }}"
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
            </section>
        </div>
    </div>
</main>
@endsection
