@extends('layouts.lay-home')

@section('title', 'Biografi Ustadz Andre Raditya')

@section('content')
<main class="pt-24 pb-20 md:pt-32 bg-dark-bg text-text-primary">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-card-bg rounded-lg shadow-xl overflow-hidden p-8 md:p-12 mt-10">

            {{-- Bagian Atas: Gambar dan Nama --}}
            <div class="flex flex-col md:flex-row items-center md:items-start mb-10">
                <div class="flex-shrink-0 mb-6 md:mb-0 md:mr-10">
                    <img src="{{ asset('storage/' . $biography->profile_picture) }}"
                        alt="Foto Profil {{ $biography->name }}"
                        class="w-48 h-48 md:w-56 md:h-56 rounded-full object-cover border-4 border-gold shadow-lg">
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold font-khusus text-gold mb-2">{{ $biography->name }}</h1>
                    <p class="text-lg text-text-secondary">Ustadz, Penulis, Inspirator</p>

                    {{-- Informasi Singkat --}}
                    <div class="mt-4 text-text-secondary text-sm md:text-base">
                        @if($biography->birth_place || $biography->birth_date)
                        <p class="mb-1"><i class="fas fa-map-marker-alt text-gold mr-2"></i> Lahir di {{
                            $biography->birth_place }}, {{ \Carbon\Carbon::parse($biography->birth_date)->format('d F
                            Y') }}</p>
                        @endif
                        @if($biography->achievements)
                        <p><i class="fas fa-award text-gold mr-2"></i> {{ $biography->achievements }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Bagian Biografi --}}
            <div class="biography-content space-y-6 text-text-secondary leading-relaxed text-sm md:text-base">
                <p>{!! nl2br(e($biography->short_bio)) !!}</p>
                <p>{!! nl2br(e($biography->long_bio)) !!}</p>
            </div>

            {{-- Bagian Media Sosial (jika ada) --}}
            @if($biography->social_media_links)
            <div class="mt-8 pt-6 border-t border-gray-700/50">
                <h3 class="text-xl font-semibold text-text-primary mb-4">Ikuti di Media Sosial</h3>
                <div class="flex space-x-4">
                    {{-- Contoh tautan media sosial. Sesuaikan dengan data yang Anda simpan. --}}
                    <a href="#" class="text-text-secondary hover:text-gold transition-colors duration-200"
                        title="Instagram">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-text-secondary hover:text-gold transition-colors duration-200"
                        title="Facebook">
                        <i class="fab fa-facebook-square text-2xl"></i>
                    </a>
                    <a href="#" class="text-text-secondary hover:text-gold transition-colors duration-200"
                        title="YouTube">
                        <i class="fab fa-youtube text-2xl"></i>
                    </a>
                </div>
            </div>
            @endif

        </div>
    </div>
</main>
@endsection