<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Container utama dengan styling yang Anda berikan --}}

        <h2 class="text-2xl font-bold text-center text-gold mb-6">Sign In</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block mb-1 text-sm text-gold">Email Address</label>
                <input id="email"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold @error('email') border-red-500 @enderror"
                    type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="you@gmail.com" />
                @error('email')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-1 text-sm text-gold">Password</label>
                <input id="password"
                    class="w-full border  rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold @error('password') border-red-500 @enderror"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                @error('password')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-gold shadow-sm focus:ring-gold mr-2"
                        name="remember">
                    <span class="text-sm text-gold">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                <a class="text-sm text-gold hover:underline" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
                @endif
            </div>

            <button type="submit" class="w-full bg-gold text-white py-2 rounded-lg hover:bg-secondary-gold transition">
                Log in
            </button>
        </form>

        {{-- Jika Anda ingin menambahkan link "Sign Up" seperti contoh Anda --}}
        {{-- Pastikan route 'register' tersedia --}}
        @if (Route::has('register'))
        <p class="text-sm text-center text-gray-500 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-gold hover:underline">Sign Up</a>
        </p>
        @endif
</x-guest-layout>
