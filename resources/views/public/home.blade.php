@extends('layouts.lay-home')

@section('title', 'Andre Raditya | Founder Si Jum')

@section('content')

<header class="hero-section relative pt-48 pb-16 md:pt-64 md:pb-24 text-text-primary">
    <div class="container relative mx-auto px-6 text-center text-white">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 font-khusus text-gold" data-aos="fade-up">
            Andre Raditya
        </h1>
        <p class="text-xl md:text-2xl mb-6 font-medium" data-aos="fade-up" data-aos-delay="100">
            Founder SIJUM — Bertumbuh Bersama Dalam Kebaikan
        </p>
        <p class="text-base md:text-lg mb-8 max-w-2xl mx-auto font-light" data-aos="fade-up" data-aos-delay="200">
            Saya seorang penulis. Kemampuan saya adalah memikirkan hal yang belum terpikirkan oleh orang lain.
        </p>
    </div>
</header>

<div class="py-6 bg-card-bg" data-aos="fade-in">
    <div class="container mx-auto px-6 flex justify-center space-x-8">
        <a href="https://www.facebook.com/andre.raditya27"
            class="text-2xl transition-colors text-gold hover:text-text-primary" data-aos="fade-down"
            data-aos-delay="100"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/andreradityaguru/"
            class="text-2xl transition-colors text-gold hover:text-text-primary" data-aos="fade-down"
            data-aos-delay="200"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/c/AndreRaditya"
            class="text-2xl transition-colors text-gold hover:text-text-primary" data-aos="fade-down"
            data-aos-delay="300"><i class="fab fa-youtube"></i></a>
        <a href="https://www.tiktok.com/@andreradityaguru"
            class="text-2xl transition-colors text-gold hover:text-text-primary" data-aos="fade-down"
            data-aos-delay="400"><i class="fab fa-tiktok"></i></a>
    </div>
</div>

<section id="main" class="relative py-24 overflow-hidden">
    <div class="absolute inset-0">
        <div class="w-full h-full bg-cover" style="background-image: url('{{ asset('assets/img/cover.jpg') }}')"></div>
        <div class="absolute inset-0 bg-black opacity-60"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex justify-end">
            <div class="md:w-1/2 bg-black bg-opacity-20 backdrop-blur-sm border border-gray-700 rounded-lg p-8 shadow-lg"
                data-aos="fade-left">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gold" data-aos="fade-up">Rezeki Level 9</h2>
                <h3 class="text-2xl md:text-3xl font-semibold mb-6 text-text-primary" data-aos="fade-up"
                    data-aos-delay="100">The Ultimate Fortune</h3>
                <p class="text-lg mb-6 text-text-secondary" data-aos="fade-up" data-aos-delay="200">
                    Jika anda sudah bosan dengan kehidupan anda begitu-begitu saja. Atau anda mulai mendapati bahwa
                    kehidupan Anda hanya berpindah
                    dari satu masalah besar ke masalah besar yang lain...
                </p>
                <p class="text-lg mb-8 text-text-secondary" data-aos="fade-up" data-aos-delay="300">
                    Sudah ikut berbagai training, seminar, dan membaca ratusan buku. Tapi kehidupan tak juga
                    menemukan titik terangnya. Mungkin
                    sudah saatnya Anda mulai meninggalkan lebel Rezeki yang biasanya. Anda harus mulai mengenal dan
                    mengaktifkan Rezeki Level 9,
                    The Ultimate Fortune.
                </p>
                <a href="https://wa.me/082138677530"
                    class="inline-block font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105 bg-gold text-dark-bg"
                    data-aos="fade-up" data-aos-delay="400">
                    BOOK NOW!
                </a>
            </div>
        </div>
    </div>
</section>

<section class="relative py-16 overflow-hidden">
    <div class="absolute inset-0">
        <div class="w-full h-full bg-cover bg-center"
            style="background-image: url('{{ asset('assets/img/cover2.jpg') }}')"></div>
        <div class="absolute inset-0 bg-black opacity-60"></div>
    </div>

    <div class="container mx-auto px-6 relative text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gold" data-aos="fade-up">JOIN WITH US</h2>
        <h3 class="text-2xl md:text-3xl font-semibold mb-8 text-text-primary" data-aos="fade-up" data-aos-delay="100">
            SANTRI PELAYAN MASYARAKAT</h3>
        <p class="text-lg md:text-xl max-w-3xl mx-auto mb-10 text-text-secondary" data-aos="fade-up"
            data-aos-delay="200">
            Kami adalah abdi dan juga santri, berkewajiban untuk bertumbuh seiringmya waktu. Melayani umat serta
            masyarakat. Kami berupaya
            menjadi yang terbaik dari setiap pribadi yang ada.
        </p>
        <a href="https://wa.me/082133337058"
            class="inline-block font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105 bg-gold text-dark-bg"
            data-aos="fade-up" data-aos-delay="300">
            FOR MORE
        </a>
    </div>
</section>

<section class="py-16 relative article-home">
    <div class="absolute inset-0 bg-black opacity-60"></div>
    <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center mb-12 text-gold">Artikel Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($articles as $article)
            <article
                class="blog-card rounded-lg overflow-hidden bg-card-bg shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col"
                data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('public.show-article', $article->id) }}" class="relative block">
                    <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('default.jpg') }}"
                        alt="{{ $article->title }}" class="w-full h-64 object-cover">
                    <div class="hover:bg-transparent transition duration-300 absolute inset-0 bg-gray-900 opacity-25">
                    </div>
                    <div
                        class="text-xs absolute top-4 right-4 bg-gold px-4 py-2 text-dark-bg rounded-full mt-3 mr-3 hover:bg-card-bg hover:text-gold transition duration-500 ease-in-out">
                        Terbaru
                    </div>
                </a>

                <div class="px-6 py-4 mb-auto">
                    <div class="text-sm mb-2 text-gold">{{ $article->author }}</div>
                    <h3 class="text-xl font-bold mb-3 text-text-primary">
                        <a href="{{ route('public.show-article', $article->id) }}"
                            class="hover:text-gold transition-colors duration-200">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-text-secondary text-sm line-clamp-3">
                        {{ Str::limit(html_entity_decode(strip_tags($article->content)), 150) }}
                    </p>
                </div>

                <div
                    class="px-6 py-3 flex flex-row items-center justify-between bg-card-bg border-t border-gray-700/50">
                    <span class="py-1 text-xs font-regular text-text-secondary flex items-center">
                        <svg height="13px" width="13px" fill="currentColor" viewBox="0 0 512 512">
                            <path
                                d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256 c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128 c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z">
                            </path>
                        </svg>
                        <span class="ml-1">{{ $article->created_at->translatedFormat('j F Y') }}</span> 
                    </span>
                    <a href="{{ route('public.show-article', $article->id) }}"
                        class="py-1 text-xs font-regular text-text-secondary flex items-center hover:text-gold transition-colors duration-200">
                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="ml-1">Read</span>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="flex justify-center mt-12" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('public.articles') }}"
                class="inline-block font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105 bg-gold text-dark-bg">
                Artikel Lainnya
            </a>
        </div>
    </div>
</section>

<section class="py-16 bg-dark-bg">
    <div class="container mx-auto px-6" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center mb-12 text-gold">Mari bangun peradaban bersama</h2>

        <div class="relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center logo-carousel">
                <img src="{{ asset('assets/icon/ARDC-1.png') }}" alt="ARDC" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/DAMASKUS-1.png') }}" alt="DAMASKUS" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/RUMPERA-1.png') }}" alt="RUMPERA" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/THEAGEMAN-1.png') }}" alt="THEAGEMAN"
                    class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/AYOBUATBAIK-2.png') }}" alt="AYOBUATBAIK"
                    class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/SIJUM-1.png') }}" alt="SIJUM" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/MASJIDMULTIMANFAAT-1.png') }}" alt="MASJIDMULTIMANFAAT"
                    class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/RUMU-1.png') }}" alt="RUMU" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/SELFA-1.png') }}" alt="SELFA" class="h-20 mx-8 object-contain" />

                <img src="{{ asset('assets/icon/ARDC-1.png') }}" alt="ARDC" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/DAMASKUS-1.png') }}" alt="DAMASKUS" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/RUMPERA-1.png') }}" alt="RUMPERA" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/THEAGEMAN-1.png') }}" alt="THEAGEMAN"
                    class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/AYOBUATBAIK-2.png') }}" alt="AYOBUATBAIK"
                    class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/SIJUM-1.png') }}" alt="SIJUM" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/MASJIDMULTIMANFAAT-1.png') }}" alt="MASJIDMULTIMANFAAT"
                    class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/RUMU-1.png') }}" alt="RUMU" class="h-20 mx-8 object-contain" />
                <img src="{{ asset('assets/icon/SELFA-1.png') }}" alt="SELFA" class="h-20 mx-8 object-contain" />
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
{{-- Pastikan Anda sudah mengimpor AOS di layout utama atau di sini --}}
<script>
    AOS.init({
        duration: 800, // Durasi animasi
        easing: 'ease-in-out', // Kurva animasi
        once: true, // Animasi hanya berjalan satu kali saat di-scroll
        mirror: false // Animasi tidak berjalan saat di-scroll kembali
    });

    // Inisialisasi carousel (jika ada skrip kustom)
    // Misalnya, untuk efek infinite scroll
    const carousel = document.querySelector('.logo-carousel');
    const scrollSpeed = 0.5; // Kecepatan scroll

    function autoScroll() {
        if (carousel) {
            carousel.scrollLeft += scrollSpeed;
            if (carousel.scrollLeft >= (carousel.scrollWidth / 2)) {
                carousel.scrollLeft = 0;
            }
        }
    }

    setInterval(autoScroll, 16); // Jalankan setiap 16ms untuk 60fps
</script>
@endpush
