<nav id="main-navbar"
    class="hidden md:flex items-center justify-between p-6 bg-dark-bg backdrop-blur-sm shadow-lg fixed w-full z-30 border-b border-gray-700/50">
    <div class="flex-1">
        <a href="#" class="text-2xl font-bold font-khusus text-gold">Andre Raditya</a>
    </div>

    <div class="flex justify-center items-center space-x-8">
        <a href="/" class="text-text-primary hover:text-gold transition-colors duration-200">Home</a>
        <a href="/bioghraphy" class="text-text-primary hover:text-gold transition-colors duration-200">Profil</a>
        <a href="/articles" class="text-text-primary hover:text-gold transition-colors duration-200">Artikel</a>
        <a href="https://www.facebook.com/andre.raditya27"
            class="text-text-primary hover:text-gold transition-colors duration-200">Facebook</a>
        <a href="#" class="text-text-primary hover:text-gold transition-colors duration-200">Instagram</a>
    </div>

    <div class="flex-1 flex justify-end">
        <div class="relative">
            {{-- Menggunakan form untuk pencarian --}}
            <form action="{{ route('public.search_result') }}" method="GET" class="relative">
                <input type="text" name="query" placeholder="Search..."
                    class="pl-10 pr-4 py-2 border rounded-full bg-gray-800 border-gray-600 text-text-primary focus:outline-none focus:ring-2 focus:ring-gold"
                    value="{{ request('query') }}" />
                <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
