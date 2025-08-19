<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Article') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header dan Tombol Tambah Artikel -->
            <div
                class="bg-white overflow-hidden shadow-xl sm:rounded-3xl transform transition duration-500 hover:scale-105">
                <div
                    class="p-6 sm:p-10 bg-gradient-to-br from-indigo-50 to-purple-50 flex flex-col md:flex-row justify-between items-center text-gray-900">
                    <h3
                        class="text-3xl md:text-4xl font-extrabold mb-4 md:mb-0 text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-purple-600 animate-pulse">
                        Daftar Artikel
                    </h3>
                    <a href="{{ route('articles.create') }}"
                        class="inline-flex items-center bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 shadow-md hover:shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Artikel Baru
                    </a>
                </div>
            </div>

            <!-- Pesan Sukses -->
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-6 rounded-lg animate-fade-in"
                role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            <!-- Daftar Artikel -->
            <div class="mt-10">
                @if($articles->isEmpty())
                <div class="text-center py-20 bg-white rounded-3xl shadow-xl">
                    <p class="text-xl text-gray-500 font-medium">Belum ada artikel yang ditambahkan.</p>
                    <p class="mt-4 text-gray-400">Ayo mulai buat artikel pertama Anda sekarang!</p>
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($articles as $article)
                    <div
                        class="bg-white p-6 rounded-3xl shadow-lg border-2 border-transparent hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 animate-fade-in">
                        <h4 class="text-xl font-bold mb-2 text-indigo-600">{{ $article->title }}</h4>
                        <p class="text-sm text-gray-500 mb-4">{{ $article->created_at->format('d M Y') }}</p>

                        <div class="mt-4 flex space-x-2">
                            <!-- Tombol Lihat -->
                            <a href="{{ route('articles.show', $article) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full text-sm transition-all duration-200">
                                Lihat
                            </a>
                            <a href="{{ route('articles.edit', $article) }}"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full text-sm transition-all duration-200">
                                Edit
                            </a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full text-sm transition-all duration-200">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .75;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .grid>div:nth-child(1) {
        animation-delay: 0.1s;
    }

    .grid>div:nth-child(2) {
        animation-delay: 0.2s;
    }

    .grid>div:nth-child(3) {
        animation-delay: 0.3s;
    }
</style>