<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Biografi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">
                        {{ $biography ? 'Edit Biografi' : 'Buat Biografi Baru' }}
                    </h3>

                    {{-- Pesan Sukses --}}
                    @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('admin.biography.storeOrUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama --}}
                            <div class="col-span-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="name" id="name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    value="{{ old('name', $biography->name ?? '') }}">
                                @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tempat Lahir --}}
                            <div class="col-span-1">
                                <label for="birth_place" class="block text-sm font-medium text-gray-700">Tempat
                                    Lahir</label>
                                <input type="text" name="birth_place" id="birth_place"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    value="{{ old('birth_place', $biography->birth_place ?? '') }}">
                                @error('birth_place')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="col-span-1">
                                <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal
                                    Lahir</label>
                                <input type="date" name="birth_date" id="birth_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    value="{{ old('birth_date', $biography->birth_date ?? '') }}">
                                @error('birth_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Gambar Profil --}}
                            <div class="col-span-1">
                                <label for="profile_picture" class="block text-sm font-medium text-gray-700">Gambar
                                    Profil</label>
                                <input type="file" name="profile_picture" id="profile_picture"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                @error('profile_picture')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                                @if($biography && $biography->profile_picture)
                                <p class="text-xs text-gray-500 mt-2">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $biography->profile_picture) }}" alt="Foto Profil"
                                    class="mt-2 w-24 h-24 object-cover rounded-full">
                                @endif
                            </div>

                            {{-- Biografi Singkat --}}
                            <div class="col-span-2">
                                <label for="short_bio" class="block text-sm font-medium text-gray-700">Biografi
                                    Singkat</label>
                                <textarea name="short_bio" id="short_bio" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('short_bio', $biography->short_bio ?? '') }}</textarea>
                                @error('short_bio')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Biografi Lengkap --}}
                            <div class="col-span-2">
                                <label for="long_bio" class="block text-sm font-medium text-gray-700">Biografi
                                    Lengkap</label>
                                <textarea name="long_bio" id="long_bio" rows="6"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('long_bio', $biography->long_bio ?? '') }}</textarea>
                                @error('long_bio')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Pencapaian --}}
                            <div class="col-span-2">
                                <label for="achievements"
                                    class="block text-sm font-medium text-gray-700">Pencapaian/Penghargaan</label>
                                <textarea name="achievements" id="achievements" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('achievements', $biography->achievements ?? '') }}</textarea>
                                <p class="mt-2 text-sm text-gray-500">Tuliskan dalam format yang mudah dibaca, misalnya,
                                    satu pencapaian per baris.</p>
                                @error('achievements')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tautan Media Sosial --}}
                            <div class="col-span-2">
                                <label for="social_media_links" class="block text-sm font-medium text-gray-700">Tautan
                                    Media Sosial</label>
                                <textarea name="social_media_links" id="social_media_links" rows="2"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('social_media_links', $biography->social_media_links ?? '') }}</textarea>
                                <p class="mt-2 text-sm text-gray-500">Masukkan tautan dalam format teks atau JSON
                                    (contoh: {"instagram": "url", "facebook": "url"})</p>
                                @error('social_media_links')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ $biography ? 'Perbarui Biografi' : 'Simpan Biografi' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
