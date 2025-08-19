<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot> --}}

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white overflow-hidden shadow-xl sm:rounded-3xl transform transition duration-500 hover:scale-105">
                <div class="p-6 sm:p-10 bg-gradient-to-br from-indigo-50 to-purple-50 text-gray-900">
                    <h3
                        class="text-4xl font-extrabold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-purple-600 animate-pulse">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-lg text-gray-600">
                        Kelola semua artikel dan profil Anda dengan mudah di sini.
                    </p>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Card: Total Article -->
                <div
                    class="bg-white p-6 rounded-3xl shadow-lg border-2 border-transparent hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 animate-fade-in">
                    <h4 class="text-xl font-bold mb-2 text-indigo-600">Total Artikel</h4>
                    <p class="text-5xl font-extrabold text-gray-800">
                        {{ \App\Models\Article::count() }}
                    </p>
                </div>

                <!-- Card: Pintasan Tambah Article -->
                <div
                    class="bg-white p-6 rounded-3xl shadow-lg border-2 border-transparent hover:border-purple-400 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 animate-fade-in">
                    <h4 class="text-xl font-bold mb-4 text-purple-600">Pintasan Cepat</h4>
                    <a href="{{ route('articles.create') }}"
                        class="w-full inline-flex items-center justify-center bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 shadow-md hover:shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Buat Artikel Baru
                    </a>
                </div>

                <!-- Card: Kelola Artikel -->
                <div
                    class="bg-white p-6 rounded-3xl shadow-lg border-2 border-transparent hover:border-green-400 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 animate-fade-in">
                    <h4 class="text-xl font-bold mb-4 text-green-600">Kelola Konten</h4>
                    <a href="{{ route('articles.index') }}"
                        class="w-full inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 shadow-md hover:shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM6 11a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zM8 15a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                        </svg>
                        Lihat Semua Artikel
                    </a>
                </div>

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
        animation: fadeIn 1s ease-out forwards;
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
