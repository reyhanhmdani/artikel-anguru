<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Article Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form untuk membuat artikel baru -->
            <div
                class="bg-white overflow-hidden shadow-xl sm:rounded-3xl transform transition duration-500 hover:scale-105">
                <div class="p-6 sm:p-10 text-gray-900 bg-gradient-to-br from-indigo-50 to-purple-50">
                    <h3
                        class="text-3xl md:text-4xl font-extrabold mb-8 text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-purple-600">
                        Isi Detail Artikel Baru
                    </h3>
                    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul Artikel -->
                        <div class="mb-6">
                            <label for="title" class="block text-lg font-semibold text-gray-700 mb-2">Judul
                                Artikel:</label>
                            <input type="text" name="title" id="title"
                                class="shadow-sm appearance-none border-2  rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 @error('title') border-red-500 @enderror"
                                value="{{ old('title') }}">
                            @error('title')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block text-lg font-semibold text-gray-700 mb-2">Gambar
                                Artikel:</label>
                            <input type="file" name="image" id="image"
                                class="shadow-sm appearance-none border-2 border-gray-200 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                            @error('image')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Publikasi -->
                        <div class="mb-6">
                            <label for="created_at" class="block text-lg font-semibold text-gray-700 mb-2">Tanggal
                                Publikasi:</label>
                            <input type="date" name="created_at" id="created_at"
                                class="shadow-sm appearance-none border-2 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 @error('created_at') border-red-500 @enderror"
                                value="{{ old('created_at') }}">
                            @error('created_at')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konten Artikel dengan CKEditor 4 -->
                        <div class="mb-6">
                            <label for="content" class="block text-lg font-semibold text-gray-700 mb-2">Konten
                                Artikel:</label>
                            <textarea name="content" id="content"
                                class="w-full @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                            @error('content')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full transition-all duration-300 shadow-md hover:shadow-xl">
                                Simpan Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Scripts -->
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('content', {
        height: 500,
        // Konfigurasi toolbar yang lebih lengkap
        toolbar: [
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize' ] }
        ]
    });
</script>

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
</style>
