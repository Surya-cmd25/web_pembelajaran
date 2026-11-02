<x-guest-layout title="Daftar" max-width="max-w-lg">

    <div class="text-center mb-8">
        <h1 class="text-[28px] font-extrabold text-gray-900 tracking-tight">Daftar Akun Baru</h1>
        <p class="mt-2 text-sm text-gray-600">Mulai petualangan belajar sosiologi interaktifmu hari ini 🚀</p>
        <p class="text-sm text-gray-500">Lengkapi data di bawah untuk membuat akun SovNorm</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-6 sm:space-y-7">
        @csrf

        <x-auth-input
            label="Nama Lengkap"
            name="name"
            placeholder="Nama lengkap kamu"
            required
            autofocus
            autocomplete="name"
        />

        <x-auth-input
            label="Email"
            name="email"
            type="email"
            placeholder="budi@gmail.com"
            required
            autocomplete="username"
        />

        <x-auth-input
            label="Kata Sandi"
            name="password"
            password
            placeholder="Minimal 8 karakter"
            required
            autocomplete="new-password"
        />

        <x-auth-input
            label="Konfirmasi Kata Sandi"
            name="password_confirmation"
            password
            placeholder="Ulangi kata sandi"
            required
            autocomplete="new-password"
        />

        <div class="pt-1">
            <label class="flex items-start gap-2.5 text-xs text-gray-600 leading-relaxed cursor-pointer select-none">
                <input type="checkbox" name="terms" value="1" required
                    class="mt-0.5 w-4 h-4 rounded border-gray-300 text-[#2563EB] focus:ring-[#2563EB]/40">
                <span>
                    Saya menyetujui
                    <span class="font-semibold text-[#2563EB]">Ketentuan Layanan</span>
                    dan
                    <span class="font-semibold text-[#2563EB]">Kebijakan Privasi</span>
                    SovNorm
                </span>
            </label>
            @error('terms')
                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#1D4ED8] to-[#2563EB] py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/35 hover:-translate-y-0.5 transition-all duration-200">
                Daftar Sekarang
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col items-center gap-3 text-center text-sm">
        <p class="text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-[#2563EB] hover:text-[#1D4ED8] transition-colors">Masuk di sini</a>
        </p>
    </div>

</x-guest-layout>
