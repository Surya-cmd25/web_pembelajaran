@props(['title' => 'Panel Guru', 'active' => null])

@php
    $user = Auth::user();
    $firstName = $user ? explode(' ', $user->name)[0] : 'Guru';
    $avatarInitials = $user ? strtoupper(mb_substr($user->name, 0, 2)) : 'SN';
    $navClass = function (string $key) use ($active) {
        return $active === $key
            ? 'bg-blue-50 text-blue-600 font-bold'
            : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 font-medium';
    };
    $navIconClass = function (string $key) use ($active) {
        return $active === $key ? 'text-blue-600' : 'text-gray-400';
    };
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} — SovNorm</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='24' fill='%232563EB'/><path d='M30 35c0-4 3.5-7 8-7h24c8 0 14 6 14 14v28c0 4-3.5 7-8 7H44c-8 0-14-6-14-14V35z' fill='none' stroke='%23ffffff' stroke-width='6'/><path d='M50 28v49M30 42c6-3 14-3 20 0M50 42c6-3 14-3 20 0' stroke='%23ffffff' stroke-width='6' stroke-linecap='round'/></svg>">

    <script>try{if(!sessionStorage.getItem('sovnorm-intro')){document.documentElement.classList.add('intro');sessionStorage.setItem('sovnorm-intro','1')}}catch(e){}</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-[#1E293B] font-sans antialiased selection:bg-blue-100 selection:text-blue-900 min-h-screen flex">

    <!-- ============================================================== -->
    <!-- SIDEBAR                                                        -->
    <!-- ============================================================== -->
    <aside id="sidebar" class="app-sidebar fixed inset-y-0 left-0 z-50 w-64 lg:w-72 bg-white border-r border-gray-200/80 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
        <div>
            <!-- Sidebar Header / Logo -->
            <div class="sidebar-brand h-20 px-6 flex items-center gap-3 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-xl font-extrabold text-[#0F172A] tracking-tight block">SovNorm</span>
                    <span class="text-[11px] font-medium text-blue-600 block -mt-0.5 font-semibold">Panel Guru</span>
                </div>
                <button id="closeSidebarBtn" class="lg:hidden ml-auto p-1.5 text-gray-400 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="app-nav p-4 space-y-1.5 text-[14px]">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('dashboard') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('dashboard') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.materi.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('materi') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('materi') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Kelola Materi</span>
                </a>

                <a href="{{ route('admin.kartu-hafalan.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('kartu') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('kartu') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span>Kartu Hafalan</span>
                </a>

                <a href="{{ route('admin.norma.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('norma') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('norma') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Galeri Norma</span>
                </a>

                <a href="{{ route('admin.pasangan-quiz.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('quiz') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('quiz') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    <span>Pasangan Quiz</span>
                </a>

                <a href="{{ route('admin.soal-pilihan-ganda.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('soal') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('soal') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Soal Pilihan Ganda</span>
                </a>

                <a href="{{ route('admin.puzzle.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('puzzle') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('puzzle') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                    </svg>
                    <span>Puzzle</span>
                </a>

                <a href="{{ route('admin.hafalan.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('hafalan') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('hafalan') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    </svg>
                    <span>Review Setor Hafalan</span>
                </a>

                <a href="{{ route('admin.siswa.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ $navClass('siswa') }}">
                    <svg class="w-5 h-5 shrink-0 {{ $navIconClass('siswa') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Data Siswa</span>
                </a>

                <div class="pt-3 mt-3 border-t border-gray-100">
                    <a href="{{ route('beranda') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-50 font-medium transition-all duration-200">
                        <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                        <span>Halaman Siswa</span>
                    </a>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden backdrop-blur-xs"></div>

    <!-- ============================================================== -->
    <!-- MAIN CONTENT WRAPPER (KANAN SIDEBAR)                           -->
    <!-- ============================================================== -->
    <div class="flex-1 lg:pl-72 flex flex-col min-w-0 min-h-screen">

        <!-- Top Header Bar -->
        <header class="app-header h-20 bg-white/90 backdrop-blur-md border-b border-gray-200/70 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button id="openSidebarBtn" class="lg:hidden p-2 text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="title-enter text-xl sm:text-2xl font-bold text-[#0F172A] tracking-tight">
                    Selamat datang, {{ $firstName }}! 👋
                </h1>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">

                <!-- User Profile Pill -->
                <div class="relative">
                    <button id="userMenuBtn" class="flex items-center gap-2.5 pl-1.5 pr-3 py-1 rounded-full border border-gray-200/90 bg-white hover:border-gray-300 shadow-2xs transition-all">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                            {{ $avatarInitials }}
                        </div>
                        <span class="text-sm font-bold text-gray-800">{{ $firstName }}</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-2xl border border-gray-200 shadow-xl py-2 z-50 text-xs">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="font-bold text-gray-900">{{ $user->name }}</p>
                            <p class="text-gray-400">{{ $user->email }}</p>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Panel Guru
                        </a>
                        <a href="{{ route('profil.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profil Saya
                        </a>
                        <a href="{{ route('beranda') }}" class="flex items-center gap-2.5 px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/></svg>
                            Halaman Siswa
                        </a>
                        <div class="my-1 border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2.5 px-4 py-2.5 font-semibold text-rose-600 hover:bg-rose-50">
                                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Keluar Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="page-enter p-4 sm:p-7 lg:p-8 space-y-6 flex-1">
            {{ $slot }}
        </main>

        <footer class="p-4 sm:p-7 pt-0 text-center text-xs text-gray-400 font-medium">
            <div class="bg-white rounded-2xl border border-gray-200/80 p-4 shadow-2xs">
                © 2026 SovNorm. Media Pembelajaran Interaktif Nilai &amp; Norma Sosial.
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
