@extends('layouts.lay-home')

@section('title', 'Kumpulan Artikel Terbaik')

@section('content')
<main class="pt-24 pb-20 md:pt-32">
    <section class="relative py-24 overflow-hidden">
        <div class="absolute inset-0">
            <div class="w-full h-full bg-cover bg-center"
                style="background-image: url('{{ asset('assets/img/cover.jpg') }}')"></div>
            <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 text-gold drop-shadow-lg font-khusus">Kumpulan Artikel Terbaik</h1>
            <p class="text-lg md:text-xl text-text-secondary max-w-3xl mx-auto">
                Temukan inspirasi dan wawasan mendalam dari berbagai tulisan Andre Raditya tentang rezeki, kehidupan,
                dan perjalanan spiritual.
            </p>
        </div>
    </section>

    <section class="py-16 bg-dark-bg">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($articles as $key => $article)
                <article
                    class="blog-card rounded-lg overflow-hidden bg-card-bg shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 relative group">
                    @if($key === 0 && !request()->has('page'))
                        <div
                            class="absolute top-4 left-4 bg-gold text-dark-bg px-3 py-1 rounded-full text-xs font-bold uppercase z-10 opacity-90 group-hover:opacity-100 transition-opacity">
                            Terbaru
                        </div>
                    @endif
                    <a href="{{ route('public.show-article', $article->id) }}" class="block">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('default-article.jpg') }}"
                            alt="{{ $article->title }}"
                            class="w-full h-48 object-cover blog-image transform group-hover:scale-105 transition-transform duration-300" />
                    </a>
                    <div class="p-6">
                        <div class="text-sm mb-2 text-gold">andre raditya</div>
                        <h3 class="text-xl font-bold mb-3 text-text-primary">
                            <a href="{{ route('public.show-article', $article->id) }}"
                                class="hover:text-gold transition-colors duration-200">{{ $article->title }}</a>
                        </h3>
                        <p class="mb-4 text-text-secondary line-clamp-3">
                            {{ Str::limit(strip_tags($article->content), 150) }}
                        </p>
                        <a href="{{ route('public.show-article', $article->id) }}"
                            class="font-bold tracking-wider text-gold hover:underline transition-all duration-200">BACA
                            &rarr;</a>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
</main>
@endsection
