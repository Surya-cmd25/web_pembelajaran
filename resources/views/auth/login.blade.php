<x-guest-layout title="Masuk" max-width="max-w-md">

    <div class="text-center mb-8">
        <h1 class="text-[28px] font-extrabold text-gray-900 tracking-tight">Selamat Datang</h1>
        <p class="mt-2 text-sm text-gray-600">Senang bertemu denganmu lagi 👋</p>
        <p class="text-sm text-gray-500">Masuk ke akun belajarmu di bawah ini</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6 sm:space-y-7">
        @csrf

        <x-auth-input
            label="Email"
            name="email"
            type="email"
            placeholder="Masukkan email"
            required
            autofocus
            autocomplete="username"
        />

        <div class="space-y-2">
            <x-auth-input
                label="Kata Sandi"
                name="password"
                password
                placeholder="Masukkan kata sandi"
                required
                autocomplete="current-password"
            />

            <div class="text-right">
                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-gray-500 hover:text-[#2563EB] transition-colors">
                    Lupa kata sandi?
                </a>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#1D4ED8] to-[#2563EB] py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/35 hover:-translate-y-0.5 transition-all duration-200">
                Masuk
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col items-center gap-3 text-center text-sm">
        <p class="text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold text-[#2563EB] hover:text-[#1D4ED8] transition-colors">Daftar sekarang</a>
        </p>
    </div>

</x-guest-layout>
