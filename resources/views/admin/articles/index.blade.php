<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Article') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header dan Tombol Tambah Artikel --}}
            <div
                class="bg-white rounded-3xl shadow-xl p-6 sm:p-8 flex flex-col md:flex-row justify-between items-center mb-6">
                <h3 class="text-3xl md:text-4xl font-extrabold mb-4 md:mb-0 text-gray-800">
                    Daftar Artikel
                </h3>
                <a href="{{ route('articles.create') }}"
                    class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Artikel Baru
                </a>
            </div>

            {{-- Pesan Sukses --}}
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-6 rounded-lg animate-fade-in"
                role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            {{-- Statistik Artikel dalam bentuk Card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white rounded-xl shadow-md p-6 text-center">
                    <h4 class="text-sm font-semibold uppercase text-gray-500 mb-2">Total Artikel</h4>
                    <p class="text-4xl font-extrabold text-gray-800">{{ $totalArticles }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 text-center">
                    <h4 class="text-sm font-semibold uppercase text-green-500 mb-2">Artikel Aktif</h4>
                    <p class="text-4xl font-extrabold text-green-600">{{ $articles->total() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 text-center">
                    <h4 class="text-sm font-semibold uppercase text-red-500 mb-2">Artikel Terhapus</h4>
                    <p class="text-4xl font-extrabold text-red-600">{{ $deletedArticlesCount }}</p>
                </div>
            </div>

            <div class="mt-8">
                {{-- Tampilan Card untuk Mode Mobile (Layar Kecil) --}}
                <div class="block md:hidden">
                    @forelse($articles as $article)
                    <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                        <div class="flex items-center space-x-4 mb-3">
                            <div class="flex-shrink-0">
                                @if($article->image)
                                <img class="h-12 w-12 rounded-lg object-cover"
                                    src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                @else
                                <div
                                    class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-xl"></i>
                                </div>
                                @endif
                            </div>
                            <div>
                                <div class="text-base font-bold text-gray-800">{{ Str::limit($article->title, 50) }}
                                </div>
                            </div>
                        </div>
                        <div class="text-sm mb-2">
                            <span class="font-semibold text-gray-700">Kategori:</span>
                            <span class="text-gray-900 font-medium">{{ $article->category }}</span>
                        </div>
                        <div class="text-sm mb-4">
                            <span class="font-semibold text-gray-700">Tanggal:</span>
                            <span class="text-gray-900 font-medium">{{ $article->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-end space-x-3">
                            {{-- Tombol Lihat (Detail) dengan ikon --}}
                            <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-900"
                                title="Lihat">
                                <i class="fas fa-eye text-lg"></i>
                            </a>

                            {{-- Tombol Edit dengan ikon --}}
                            <a href="{{ route('articles.edit', $article) }}"
                                class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                <i class="fas fa-edit text-lg"></i>
                            </a>

                            {{-- Tombol Hapus dengan ikon --}}
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-lg shadow-md p-12 text-center text-gray-500">
                        Belum ada artikel yang ditambahkan.
                    </div>
                    @endforelse
                </div>

                {{-- Tampilan Tabel untuk Mode Desktop --}}
                <div class="hidden md:block bg-white rounded-lg shadow-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Judul Artikel
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Kategori
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($articles as $article)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($article->image)
                                                <img class="h-10 w-10 rounded-lg object-cover"
                                                    src="{{ asset('storage/' . $article->image) }}"
                                                    alt="{{ $article->title }}">
                                                @else
                                                <div
                                                    class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{
                                                    Str::limit($article->title, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $article->category }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $article->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            {{-- Tombol Lihat (Detail) dengan ikon --}}
                                            <a href="{{ route('articles.show', $article) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye text-lg"></i>
                                            </a>

                                            {{-- Tombol Edit dengan ikon --}}
                                            <a href="{{ route('articles.edit', $article) }}"
                                                class="text-yellow-600 hover:text-yellow-900">
                                                <i class="fas fa-edit text-lg"></i>
                                            </a>

                                            {{-- Tombol Hapus dengan ikon --}}
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada artikel yang ditambahkan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Paginasi --}}
            @if($articles->hasPages())
            <div class="px-6 py-4 mt-6 bg-white rounded-lg shadow-xl border-t border-gray-200">
                {{ $articles->links('includes.pagination') }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
