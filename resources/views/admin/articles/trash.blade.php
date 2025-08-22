<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header dan Tombol-tombol Aksi --}}
            <div
                class="bg-white rounded-3xl shadow-xl p-6 sm:p-8 flex flex-col md:flex-row justify-between items-center mb-6 transition-all duration-300 ease-in-out">
                <h3 class="text-3xl md:text-4xl font-extrabold mb-4 md:mb-0 text-gray-800">
                    Kotak Sampah Artikel
                </h3>
                <div class="flex flex-c@ol sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    {{-- Tombol Kembali ke Daftar Artikel --}}
                    <a href="{{ route('articles.index') }}"
                        class="inline-flex items-center w-full sm:w-auto justify-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            {{-- Pesan Status --}}
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md animate-fade-in"
                role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            {{-- Statistik Artikel Terhapus (opsional, jika Anda ingin menampilkan hitungan) --}}
            {{-- Anda perlu mengirimkan variabel ini dari controller jika ingin mengaktifkannya --}}
            {{--
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <h4 class="text-sm font-semibold uppercase text-red-500 mb-2">Total Artikel di Sampah</h4>
                    <p class="text-4xl font-extrabold text-red-600">{{ $deletedArticlesCount ?? $articles->total() }}
                    </p>
                </div>
                <div
                    class="bg-white rounded-xl shadow-md p-6 text-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <h4 class="text-sm font-semibold uppercase text-gray-500 mb-2">Total Artikel Keseluruhan</h4>
                    <p class="text-4xl font-extrabold text-gray-800">{{ $totalArticles ?? 'N/A' }}</p>
                </div>
            </div>
            --}}

            @if($articles->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-12 text-center text-gray-500 mt-8">
                Tidak ada artikel di kotak sampah.
            </div>
            @else
            <div class="mt-8">
                {{-- Tampilan Tabel untuk Desktop --}}
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
                                        Tanggal Dihapus
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($articles as $index => $article)
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
                                        <span class="text-sm text-gray-900">{{ $article->deleted_at->format('d M Y H:i')
                                            }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            {{-- Tombol Restore --}}
                                            <form action="{{ route('articles.restore', $article->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200"
                                                    title="Restore">
                                                    <i class="fas fa-trash-restore text-lg"></i>
                                                </button>
                                            </form>
                                            {{-- Tombol Hapus Permanen --}}
                                            <form action="{{ route('articles.force-delete', $article->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini secara permanen? Aksi ini tidak dapat diurungkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                    title="Hapus Permanen">
                                                    <i class="fas fa-trash-alt text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Paginasi --}}
            @if($articles->hasPages())
            <div class="px-6 py-4 mt-6 bg-white rounded-lg shadow-xl border-t border-gray-200">
                {{ $articles->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>
</x-app-layout>
