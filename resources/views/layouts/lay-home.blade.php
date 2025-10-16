<!DOCTYPE html>
<html lang="en">

<head>
@include('includes.public-head')
</head>

<body class="font-sans bg-dark-bg">

    {{-- Mobile Navigation --}}
    @include('includes.public-mobile-nav')
    <!-- Desktop Navigation -->
    @include('includes.public-destkop-nav')

    @yield('header')
    @yield('content')

    @include('includes.public-footer')
    @include('includes.scripts')
    @stack('scripts')
</body>

</html>
