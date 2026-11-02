@props(['maxWidth' => 'max-w-md', 'title' => ''])

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title . ' — ' : '' }}SovNorm — Media Pembelajaran Sosiologi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='48' fill='%232563EB'/><path d='M35 32c0-3.3 2.7-6 6-6h18c8.8 0 16 7.2 16 16 0 5.6-2.9 10.6-7.3 13.4C72.8 58 76 63.6 76 70c0 9.9-8.1 18-18 18H38c-3.3 0-6-2.7-6-6V32z' fill='%23ffffff'/></svg>">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Disable native browser password reveal & clear buttons (Edge / IE) */
        input::-ms-reveal,
        input::-ms-clear {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B] font-sans antialiased selection:bg-blue-100 selection:text-blue-900">

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden px-4 pt-24 pb-12 sm:pt-28 sm:pb-16">

        {{-- Decorative background blobs --}}
        <div class="pointer-events-none absolute -left-24 -bottom-24 w-96 h-96 rounded-full bg-blue-200/50 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 -top-24 w-96 h-96 rounded-full bg-amber-200/50 blur-3xl"></div>

        {{-- Decorative sparkles --}}
        <div class="pointer-events-none absolute inset-0 select-none hidden sm:block" aria-hidden="true">
            <span class="absolute top-16 left-16 text-amber-400 text-xl">✦</span>
            <span class="absolute top-20 right-28 text-blue-400 text-lg">✦</span>
            <span class="absolute bottom-32 left-24 text-amber-400 text-2xl">✦</span>
            <span class="absolute bottom-20 right-24 text-blue-500 text-lg">✦</span>

            <svg class="absolute bottom-24 left-6 w-24 h-24 text-blue-400/60" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 5">
                <path d="M5 70 Q 5 20 55 15" stroke-linecap="round"/>
            </svg>
            <svg class="absolute top-32 right-10 w-24 h-24 text-amber-400/60" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 5">
                <path d="M95 30 Q 95 80 45 85" stroke-linecap="round"/>
            </svg>
        </div>

        {{-- Top Navigation Bar --}}
        <header class="absolute top-0 inset-x-0 w-full px-5 py-5 sm:px-8 sm:py-6 flex items-center justify-between z-20 max-w-7xl mx-auto">
            {{-- Brand Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group" title="SovNorm - Kembali ke Beranda">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-[#1D4ED8] to-[#2563EB] flex items-center justify-center text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200 shrink-0">
                    <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2a9 9 0 0 0-9 9c0 3.6 2.1 6.7 5.2 8.1.5.1.7-.2.7-.5v-2c0-.6.2-1.1.6-1.5-3.3-.4-4.8-2.2-4.8-4.7 0-1.2.5-2.2 1.3-3-.1-.3-.5-1.5.1-3 0 0 1-.3 3.3 1.2a11.5 11.5 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.5.2 2.7.1 3 .8.8 1.3 1.8 1.3 3 0 2.5-1.5 4.3-4.8 4.7.4.4.7 1 .7 1.9v2.8c0 .3.2.6.7.5A9 9 0 0 0 12 2z"/>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-base sm:text-lg font-extrabold tracking-tight text-gray-900 group-hover:text-[#2563EB] transition-colors leading-tight">SovNorm</span>
                    <span class="hidden sm:inline text-[10px] uppercase font-semibold tracking-wider text-gray-400">Media Pembelajaran</span>
                </div>
            </a>

            {{-- Tombol Kembali ke Landing Page --}}
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-full border border-gray-200 bg-white/90 backdrop-blur-sm text-xs sm:text-sm font-semibold text-gray-700 hover:text-[#0F172A] hover:border-[#0F172A]/40 hover:bg-white shadow-xs hover:shadow transition-all duration-200 group">
                <svg class="w-4 h-4 text-gray-500 group-hover:-translate-x-1 group-hover:text-[#0F172A] transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </header>

        {{-- Card --}}
        <div class="relative z-10 w-full {{ $maxWidth }} bg-white rounded-[28px] border border-gray-200/90 shadow-2xl shadow-gray-200/60 p-7 sm:p-9">
            {{ $slot }}
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-password-toggle]').forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const container = btn.closest('.relative');
                const input = container ? container.querySelector('[data-password-input]') : null;
                if (!input) return;

                const isCurrentlyPassword = input.type === 'password';
                input.type = isCurrentlyPassword ? 'text' : 'password';

                const eyeOpen = btn.querySelector('[data-eye-open]');
                const eyeClosed = btn.querySelector('[data-eye-closed]');

                // Jika kata sandi terbuka (teks terlihat), tampilkan mata terbuka (eyeOpen)
                // Jika kata sandi tertutup (titik-titik), tampilkan mata dicoret (eyeClosed)
                if (eyeOpen && eyeClosed) {
                    eyeOpen.classList.toggle('hidden', !isCurrentlyPassword);
                    eyeClosed.classList.toggle('hidden', isCurrentlyPassword);
                }

                const newTitle = isCurrentlyPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi';
                btn.setAttribute('aria-label', newTitle);
                btn.setAttribute('title', newTitle);

                // Keep focus and cursor position at the end
                const len = input.value.length;
                input.focus();
                input.setSelectionRange(len, len);
            });
        });
    </script>
</body>
</html>
