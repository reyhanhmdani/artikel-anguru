<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<title>@yield('title') | {{ config('app.name', 'Anguru') }}</title>

<link rel="icon" type="image/png" href="{{ asset('assets/icon/ARDC.png') }}">
{{-- Menggunakan helper asset() Laravel untuk path CSS Anda --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- Jika ada CSS tambahan spesifik halaman --}}
{{-- @stack('styles') --}}
