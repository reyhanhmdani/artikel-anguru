{{-- Ini adalah tempat Anda akan meletakkan skrip global dari resources/js/app.js setelah dikompilasi --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true, // Animasi hanya berjalan satu kali saat pertama kali muncul
        duration: 800, // Durasi animasi dalam milidetik
        easing: "ease-in-out", // Efek transisi
      });
</script>
{{-- Atau jika Anda menggunakan script.js terpisah seperti di kode awal Anda --}}
{{-- <script src="{{ asset('js/script.js') }}"></script> --}}
