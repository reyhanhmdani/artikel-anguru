<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Artikel') }}
        </h2>
    </x-slot>
    <x-slot name="title">
        Manajemen Artikel
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header dan Tombol-tombol Aksi --}}
            <div
                class="bg-white rounded-3xl shadow-xl p-6 sm:p-8 flex flex-col md:flex-row justify-between items-center mb-6 transition-all duration-300 ease-in-out">
                <h3 class="text-3xl md:text-4xl font-extrabold mb-4 md:mb-0 text-gray-800">
                    Daftar Artikel
                </h3>
                <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    {{-- Tombol Tambah Artikel Baru --}}
                    <a href="{{ route('articles.create') }}"
                        class="inline-flex items-center w-full sm:w-auto justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Artikel Baru
                    </a>
                    {{-- Tombol untuk melihat halaman sampah --}}
                    <a href="{{ route('articles.trash') }}"
                        class="inline-flex items-center w-full sm:w-auto justify-center bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <i class="fas fa-trash-restore mr-2"></i>
                        Kotak Sampah
                    </a>
                </div>
            </div>

            {{-- Pesan Sukses --}}
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md animate-fade-in"
                role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            {{-- Statistik Artikel dalam bentuk Card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <h4 class="text-sm font-semibold uppercase text-gray-500 mb-2">Total Artikel</h4>
                    <p class="text-4xl font-extrabold text-gray-800">{{ $totalArticles }}</p>
                </div>
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <h4 class="text-sm font-semibold uppercase text-green-500 mb-2">Artikel Aktif</h4>
                    <p class="text-4xl font-extrabold text-green-600">{{ $articles->total() }}</p>
                </div>
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <h4 class="text-sm font-semibold uppercase text-red-500 mb-2">Artikel Terhapus</h4>
                    <p class="text-4xl font-extrabold text-red-600">{{ $deletedArticlesCount }}</p>
                </div>
            </div>

            {{-- 🔽 Filter Tahun & Bulan (Versi Minimalis Responsif) --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 sm:p-6 mt-6">
                <form action="{{ route('articles.index') }}" method="GET"
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">

                    {{-- Title --}}
                    <h4 class="text-base sm:text-lg font-semibold text-gray-700">Filter Arsip</h4>

                    <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                        {{-- Dropdown Tahun --}}
                        <div class="relative">
                            <select name="year" onchange="this.form.submit()"
                                class="w-36 sm:w-44 appearance-none bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg py-2 pl-3 pr-8 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                                <option value="">Semua Tahun</option>
                                @foreach($availableYears as $availableYear)
                                <option value="{{ $availableYear }}" @selected($year==$availableYear)>
                                    {{ $availableYear }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Dropdown Bulan --}}
                        @if($year)
                        <div class="relative">
                            <select name="month" onchange="this.form.submit()"
                                class="w-36 sm:w-44 appearance-none bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg py-2 pl-3 pr-8 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                                <option value="">Semua Bulan ({{ $year }})</option>
                                @foreach($availableMonths as $availableMonth)
                                <option value="{{ $availableMonth->month_num }}" @selected($month==$availableMonth->
                                    month_num)>
                                    {{
                                    \Carbon\Carbon::create()->month($availableMonth->month_num)->translatedFormat('F')
                                    }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        {{-- Tombol Reset --}}
                        @if($year || $month)
                        <a href="{{ route('articles.index') }}"
                            class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-300 transition-all duration-200 shadow-sm">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>


            <div class="mt-8">
                {{-- Tampilan Card untuk Mode Mobile (Layar Kecil) --}}
                <div class="block md:hidden">
                    @forelse($articles as $index => $article)
                    <div
                        class="bg-white rounded-lg shadow-md p-4 mb-4 transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                        <div class="flex items-start space-x-4 mb-3">
                            <div class="flex-shrink-0">
                                <div class="text-xl font-bold text-gray-700">{{ $articles->firstItem() + $index }}</div>
                            </div>

                            <div class="flex items-center space-x-4">
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
                                <div class="flex-1 min-w-0">
                                    <div class="text-base font-bold text-gray-800 truncate">{{
                                        Str::limit($article->title, 50) }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $article->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm mb-2">
                            <span class="font-semibold text-gray-700">Kategori:</span>
                            <span class="text-gray-900 font-medium">{{ $article->category }}</span>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('articles.show', $article) }}"
                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Lihat">
                                <i class="fas fa-eye text-lg"></i>
                            </a>
                            <a href="{{ route('articles.edit', $article) }}"
                                class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200"
                                title="Edit">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                    title="Hapus">
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
                                        No. & Judul Artikel
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
                                @forelse($articles as $index => $article)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-4">
                                            {{-- Menampilkan nomor urut --}}
                                            <div class="text-sm font-medium text-gray-900 flex-shrink-0">
                                                {{ $articles->firstItem() + $index }}.
                                            </div>
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
                                            <div class="ml-4 flex-1">
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
                                            <a href="{{ route('articles.show', $article) }}"
                                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                                title="Lihat">
                                                <i class="fas fa-eye text-lg"></i>
                                            </a>
                                            <a href="{{ route('articles.edit', $article) }}"
                                                class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200"
                                                title="Edit">
                                                <i class="fas fa-edit text-lg"></i>
                                            </a>
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                    title="Hapus">
                                                    <i class="fas fa-trash text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
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
            @if($articles->hasPages() && $articles->total() > 0)
            <div class="px-6 py-4 mt-6 bg-white rounded-lg shadow-xl border-t border-gray-200">
                {{ $articles->links('includes.pagination')->withQueryString() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>