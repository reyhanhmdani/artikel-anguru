<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl p-6 md:p-10">
                <article class="prose max-w-none lg:prose-lg">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">{{ $article->title }}</h1>

                    <div class="flex items-center text-gray-500 mb-6 space-x-4">
                        <span class="text-sm font-semibold">Oleh: Ustad Andre Raditya</span>
                        <span class="text-sm">|</span>
                        <time datetime="{{ $article->created_at->format('Y-m-d') }}" class="text-sm">
                            {{ $article->created_at->translatedFormat('d F Y') }}
                        </time>
                        @if($article->category)
                        <span class="text-xs bg-indigo-100 text-indigo-800 font-medium px-2.5 py-0.5 rounded-full">
                            {{ $article->category }}
                        </span>
                        @endif
                    </div>

                    @if ($article->image)
                    <figure class="mb-8">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                            class="rounded-lg shadow-md w-full">
                        <figcaption class="text-center text-sm text-gray-500 mt-2">Gambar ilustrasi artikel</figcaption>
                    </figure>
                    @endif

                    <div class="article-content text-gray-700 leading-relaxed">
                        {!! $article->content !!}
                    </div>
                </article>

                <div class="mt-10 flex flex-wrap gap-4 justify-start items-center">
                    <a href="{{ route('articles.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-full transition-all duration-300">
                        Kembali ke Daftar Artikel
                    </a>
                    <a href="{{ route('articles.edit', $article->id) }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-full transition-all duration-300">
                        Edit Artikel
                    </a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-full transition-all duration-300">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>