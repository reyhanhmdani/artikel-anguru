{{-- resources/views/includes/public-mobile-nav.blade.php --}}

<div class="md:hidden" x-data="{ showSearchInput: false }" x-init="$watch('showSearchInput', value => {
         if (value) {
             $nextTick(() => $refs.searchInput.focus());
         }
     })">

    {{-- Floating Action Button (FAB) untuk Search --}}
    <button x-show="!showSearchInput" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-0" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-0" @click="showSearchInput = true"
        class="fixed top-5 right-5 z-40 flex items-center justify-center w-12 h-12 rounded-full
                   bg-gold text-dark-bg shadow-lg focus:outline-none focus:ring-2 focus:ring-gold focus:ring-offset-2 focus:ring-offset-dark-bg" style="display: none;">
        <i class="fas fa-search text-2xl"></i>
    </button>

    {{-- Input Search dengan Animasi Memanjang dari Kanan ke Kiri --}}
    <div x-show="showSearchInput" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-x-0" x-transition:enter-end="opacity-100 scale-x-100"
        x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="opacity-100 scale-x-100" x-transition:leave-end="opacity-0 scale-x-0"
        @click.outside="showSearchInput = false" class="fixed top-5 right-5 z-40 flex items-center bg-card-bg rounded-full shadow-lg p-2 pr-4 space-x-2
    w-11/12 md:w-1/2 origin-right" style="display: none;">

        <form action="{{ route('public.search_result') }}" method="GET" class="flex-grow flex">
            <input type="text" name="query" placeholder="Cari..." x-ref="searchInput"
                class="w-full py-1 pl-4 bg-transparent text-text-primary focus:outline-none"
                value="{{ request('query') }}">
            <button type="submit" class="text-text-secondary hover:text-gold ml-2">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <button @click="showSearchInput = false" class="text-text-secondary hover:text-gold text-xl">
            <i class="fas fa-times"></i>
        </button>
    </div>

    {{-- Navigasi Bawah (Fixed) - Kode Anda yang sudah ada --}}
    <div class="fixed bottom-0 left-0 right-0 z-50 bg-dark-bg/80 backdrop-blur-sm border-t border-gray-700/50">
        <div class="flex items-center justify-around py-3 px-4">
            <a href="profile" class="flex flex-col items-center text-text-secondary hover:text-text-primary">
                <i class="fas fa-user text-xl mb-1"></i>
                <span class="text-xs">Profil</span>
            </a>
            <a href="#" class="flex flex-col items-center text-text-secondary hover:text-text-primary">
                <i class="fab fa-facebook text-xl mb-1"></i>
                <span class="text-xs">Facebook</span>
            </a>
            <a href="/">
                <div
                    class="bg-gold text-dark-bg rounded-full w-14 h-14 flex flex-col items-center justify-center -mt-8 shadow-lg transform hover:scale-110 transition-transform">
                    <i class="fas fa-home text-2xl mb-1"></i>
                    <span class="text-xs"></span>
                </div>
            </a>
            <a href="#" class="flex flex-col items-center text-text-secondary hover:text-text-primary">
                <i class="fab fa-instagram text-xl mb-1"></i>
                <span class="text-xs">Instagram</span>
            </a>
            <a href="articles" class="flex flex-col items-center text-text-secondary hover:text-text-primary">
                <i class="fas fa-book text-xl mb-1"></i>
                <span class="text-xs">Artikel</span>
            </a>
        </div>
    </div>
</div>
