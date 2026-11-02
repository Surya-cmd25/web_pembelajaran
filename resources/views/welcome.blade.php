<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SovNorm — Media Pembelajaran Sosiologi Interaktif</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='48' fill='%232563EB'/><path d='M35 32c0-3.3 2.7-6 6-6h18c8.8 0 16 7.2 16 16 0 5.6-2.9 10.6-7.3 13.4C72.8 58 76 63.6 76 70c0 9.9-8.1 18-18 18H38c-3.3 0-6-2.7-6-6V32z' fill='%23ffffff'/></svg>">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-[#1E293B] font-sans antialiased selection:bg-amber-200 selection:text-amber-900">

    <!-- ============================================================== -->
    <!-- NAVIGATION BAR (MATCHING IMAGE 1)                              -->
    <!-- ============================================================== -->
    <header class="sticky top-0 z-50 bg-[#F8FAFC]/95 backdrop-blur-md border-b border-gray-200/70 transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo (Only logo icon on mobile, with text on larger screens) -->
            <a href="#" class="flex items-center gap-3 group shrink-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-gradient-to-tr from-[#1D4ED8] to-[#2563EB] flex items-center justify-center text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200 shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2a9 9 0 0 0-9 9c0 3.6 2.1 6.7 5.2 8.1.5.1.7-.2.7-.5v-2c0-.6.2-1.1.6-1.5-3.3-.4-4.8-2.2-4.8-4.7 0-1.2.5-2.2 1.3-3-.1-.3-.5-1.5.1-3 0 0 1-.3 3.3 1.2a11.5 11.5 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.5.2 2.7.1 3 .8.8 1.3 1.8 1.3 3 0 2.5-1.5 4.3-4.8 4.7.4.4.7 1 .7 1.9v2.8c0 .3.2.6.7.5A9 9 0 0 0 12 2z"/>
                    </svg>
                </div>
                <div class="hidden sm:block">
                    <span class="text-xl font-bold tracking-tight text-gray-900 flex items-center gap-1.5">
                        SovNorm
                    </span>
                    <p class="text-[11px] font-medium text-gray-500 tracking-wide uppercase">Media Pembelajaran Sosiologi</p>
                </div>
            </a>

            <!-- Desktop Navigation Links (Matching User's Screenshot) -->
            <nav id="desktopNav" class="hidden md:flex items-center gap-10 text-[15px]">
                <!-- Materi Audio (Active by default) -->
                <a href="#materi-audio" data-nav="materi-audio" class="nav-item group relative inline-flex flex-col py-1 cursor-pointer transition-colors">
                    <span class="nav-text font-bold text-gray-900 tracking-tight transition-colors">Materi Audio</span>
                    <span class="nav-indicator h-[3px] w-full bg-[#2563EB] rounded-full mt-1.5 transition-all duration-200"></span>
                </a>

                <!-- Setor Hafalan -->
                <a href="#setor-hafalan" data-nav="setor-hafalan" class="nav-item group relative inline-flex flex-col py-1 cursor-pointer transition-colors">
                    <span class="nav-text font-normal text-slate-500 hover:text-gray-900 tracking-tight transition-colors">Setor Hafalan</span>
                    <span class="nav-indicator opacity-0 h-[3px] w-full bg-[#2563EB] rounded-full mt-1.5 transition-all duration-200"></span>
                </a>

                <!-- Galeri Norma -->
                <a href="#galeri-norma" data-nav="galeri-norma" class="nav-item group relative inline-flex flex-col py-1 cursor-pointer transition-colors">
                    <span class="nav-text font-normal text-slate-500 hover:text-gray-900 tracking-tight transition-colors">Galeri Norma</span>
                    <span class="nav-indicator opacity-0 h-[3px] w-full bg-[#2563EB] rounded-full mt-1.5 transition-all duration-200"></span>
                </a>

                <!-- Zona Latihan -->
                <a href="#zona-latihan" data-nav="zona-latihan" class="nav-item group relative inline-flex flex-col py-1 cursor-pointer transition-colors">
                    <span class="nav-text font-normal text-slate-500 hover:text-gray-900 tracking-tight transition-colors">Zona Latihan</span>
                    <span class="nav-indicator opacity-0 h-[3px] w-full bg-[#2563EB] rounded-full mt-1.5 transition-all duration-200"></span>
                </a>

                <!-- Ulasan -->
                <a href="#ulasan" data-nav="ulasan" class="nav-item group relative inline-flex flex-col py-1 cursor-pointer transition-colors">
                    <span class="nav-text font-normal text-slate-500 hover:text-gray-900 tracking-tight transition-colors">Ulasan</span>
                    <span class="nav-indicator opacity-0 h-[3px] w-full bg-[#2563EB] rounded-full mt-1.5 transition-all duration-200"></span>
                </a>
            </nav>

            <!-- Right Actions -->
            <div class="flex items-center gap-3 sm:gap-4">
                @auth
                    <a href="{{ auth()->user()->isGuru() ? route('admin.dashboard') : route('beranda') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-semibold shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-200 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Buka Dashboard
                    </a>
                @else
                    <!-- Masuk Akun -->
                    <a href="{{ route('login') }}" class="hidden md:inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full text-sm font-semibold text-gray-700 hover:text-[#2563EB] transition-colors whitespace-nowrap">
                        Masuk Akun
                    </a>

                    <!-- Daftar -->
                    <a href="{{ route('register') }}" class="hidden sm:inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-semibold shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-200 whitespace-nowrap">
                        Daftar
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="mobileMenuToggle" class="md:hidden p-2 text-gray-600 hover:text-gray-900 focus:outline-none" aria-label="Buka Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200 bg-white/98 backdrop-blur-md px-6 py-5 space-y-4 shadow-xl">
            <div class="space-y-3 pb-3 border-b border-gray-100">
                <a href="#materi-audio" data-nav="materi-audio" class="mobile-nav-item block font-bold text-[#2563EB] text-base py-1">Materi Audio</a>
                <a href="#setor-hafalan" data-nav="setor-hafalan" class="mobile-nav-item block font-medium text-gray-700 hover:text-[#2563EB] text-base py-1">Setor Hafalan</a>
                <a href="#galeri-norma" data-nav="galeri-norma" class="mobile-nav-item block font-medium text-gray-700 hover:text-[#2563EB] text-base py-1">Galeri Norma</a>
                <a href="#zona-latihan" data-nav="zona-latihan" class="mobile-nav-item block font-medium text-gray-700 hover:text-[#2563EB] text-base py-1">Zona Latihan</a>
                <a href="#ulasan" data-nav="ulasan" class="mobile-nav-item block font-medium text-gray-700 hover:text-[#2563EB] text-base py-1">Ulasan</a>
                @auth
                    <a href="{{ auth()->user()->isGuru() ? route('admin.dashboard') : route('beranda') }}" class="block font-bold text-[#2563EB] text-base py-1">Buka Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block font-bold text-[#2563EB] text-base py-1">Masuk Akun</a>
                    <a href="{{ route('register') }}" class="block font-bold text-[#2563EB] text-base py-1">Daftar Sekarang</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- ============================================================== -->
    <!-- HERO SECTION                                                   -->
    <!-- ============================================================== -->
    <section class="relative pt-12 pb-20 lg:pt-16 lg:pb-28 overflow-hidden">
        <!-- Subtle background doodle & star top-right -->
        <div class="absolute top-6 right-10 lg:right-32 pointer-events-none opacity-40 select-none">
            <svg class="w-44 h-44 text-[#0F172A]" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.8">
                <!-- Abstract contour of face/listening ear -->
                <path d="M40 80 C 60 40, 140 30, 160 80 C 180 130, 130 180, 80 160 C 50 150, 45 110, 65 95 C 80 85, 95 105, 90 120" stroke-linecap="round"/>
            </svg>
            <div class="absolute top-2 right-4 text-amber-500 animate-pulse text-2xl font-bold">✦</div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-center">
                
                <!-- Left Column: Headline & Value Proposition -->
                <div class="lg:col-span-7 space-y-7">
                    <h1 class="text-4xl sm:text-5xl lg:text-[56px] font-extrabold text-[#0F172A] leading-[1.16] tracking-tight">
                        Pahami 
                        <span class="relative inline-block text-[#0F172A]">
                            Aturan Hidup
                            <svg class="absolute -bottom-2 left-0 w-full h-3.5 text-[#0F172A]" viewBox="0 0 260 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 9C65 3 190 2 256 10" stroke="currentColor" stroke-width="4.5" stroke-linecap="round"/>
                            </svg>
                        </span><br>
                        Bersama Lewat Suara,<br>
                        Visual, &amp; Tantangan.
                    </h1>

                    <p class="text-lg sm:text-[19px] text-gray-600 leading-relaxed max-w-2xl font-normal">
                        Menjelajahi konsep nilai sosial dan norma masyarakat dengan metode audio-learning, kartu konsep setor hafalan, visualisasi studi kasus, dan gamifikasi latihan terstruktur sesuai Kurikulum Merdeka.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-semibold text-base shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/35 hover:-translate-y-0.5 transition-all duration-200">
                                Mulai Belajar Sekarang!
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H7M17 7v10"/>
                                </svg>
                            </a>
                        @else
                            <a href="#materi-audio" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-semibold text-base shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/35 hover:-translate-y-0.5 transition-all duration-200">
                                Mulai Jelajah Materi
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H7M17 7v10"/>
                                </svg>
                            </a>
                        @endguest

                        <button id="heroPlayAudioBtn" class="inline-flex items-center gap-3 px-6 py-3.5 rounded-full bg-white hover:bg-gray-50 text-gray-800 font-semibold text-base border border-gray-200/90 shadow-sm hover:border-gray-300 transition-all duration-200 group">
                            <span class="w-7 h-7 rounded-full bg-blue-100 text-[#2563EB] flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-3.5 h-3.5 fill-current ml-0.5" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </span>
                            Dengarkan Audio Pertama
                        </button>
                    </div>
                </div>

                <!-- Right Column: Lab Sosio-Interaktif Card -->
                <div class="lg:col-span-5">
                    <div class="relative bg-white rounded-3xl border border-gray-200/90 shadow-2xl shadow-gray-200/60 p-5 sm:p-6 backdrop-blur-sm">
                        <!-- Card Header -->
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#EF4444]"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#F59E0B]"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#10B981]"></span>
                                </div>
                                <span class="text-xs font-bold text-gray-700 ml-2 tracking-wide">Lab Sosio-Interaktif</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-semibold border border-emerald-200/60">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                                Live Preview ↗
                            </span>
                        </div>

                        <!-- Card Body: Inner Sub-cards -->
                        <div class="pt-5 space-y-4">
                            <!-- Podcast Widget Sub-card -->
                            <div class="bg-[#F8FAFC] rounded-2xl p-4 border border-gray-100 shadow-sm hover:border-blue-200/80 transition-colors">
                                <div class="flex items-center justify-between text-xs mb-3">
                                    <div class="flex items-center gap-2 text-gray-800 font-semibold">
                                        <span class="w-5 h-5 rounded-md bg-[#2563EB] text-white flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2H3v2a9 9 0 0 0 8 8.94V23h2v-2.06A9 9 0 0 0 21 12v-2h-2z"/></svg>
                                        </span>
                                        <span class="truncate">Podcast Sosiologi: Nilai Vital &amp; Material</span>
                                    </div>
                                    <span class="text-gray-400 font-mono text-[11px] font-medium">08:45</span>
                                </div>

                                <!-- Audio visualizer waveform bars -->
                                <div class="flex items-center justify-between h-9 px-2 bg-white rounded-xl border border-gray-100">
                                    <div class="flex items-center gap-1.5 w-full justify-around">
                                        <span class="w-1 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span class="w-1 h-5 rounded-full bg-[#0F172A]"></span>
                                        <span class="w-1 h-6 rounded-full bg-[#2563EB]"></span>
                                        <span class="w-1 h-4 rounded-full bg-[#2563EB]"></span>
                                        <span class="w-1 h-7 rounded-full bg-[#0F172A]"></span>
                                        <span class="w-1 h-5 rounded-full bg-emerald-500"></span>
                                        <span class="w-1 h-3 rounded-full bg-gray-300"></span>
                                        <span class="w-1 h-6 rounded-full bg-[#2563EB]"></span>
                                        <span class="w-1 h-4 rounded-full bg-gray-300"></span>
                                        <span class="w-1 h-5 rounded-full bg-[#0F172A]"></span>
                                        <span class="w-1 h-2 rounded-full bg-gray-300"></span>
                                        <span class="w-1 h-4 rounded-full bg-gray-300"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Case Study Sub-card -->
                            <div class="bg-[#EFF6FF] rounded-2xl p-4 border border-blue-100/90 shadow-sm">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-800 bg-blue-100/80 px-2 py-0.5 rounded">
                                        STUDI KASUS CEPAT
                                    </span>
                                    <span class="text-amber-500 text-xs">💡</span>
                                </div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1">Mengapa Antre Termasuk Norma?</h4>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    Mencerminkan internalisasi nilai kesetaraan dan keadilan hak antar-warga.
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <span class="flex items-center gap-1.5 font-medium text-emerald-700">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Sesuai Silabus Kemendikbudristek
                            </span>
                            <span class="font-semibold text-gray-700 bg-gray-100 px-2 py-0.5 rounded-full text-[11px]">
                                Kelas X &amp; XI SMA
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION 1: RUANG MATERI AUDIO (MATCHING IMAGE 2 INTERACTION)    -->
    <!-- ============================================================== -->
    <section id="materi-audio" class="py-20 lg:py-24 bg-white border-t border-b border-gray-200/60 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-800 text-xs font-semibold mb-3 border border-blue-200/50">
                        <span>🎧</span> Ruang Suara &amp; Podcast Pembelajaran
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] tracking-tight">
                        Ruang Materi Audio: Dengarkan Narasi Sosiologi yang <span class="text-[#2563EB]">Hidup</span>
                    </h2>
                    <p class="mt-3 text-base text-gray-600 max-w-3xl leading-relaxed">
                        Dengarkan rangkuman materi ringkas dengan narasi sosiologis yang hidup dan relevan dengan kehidupan sehari-hari, dapat diakses kapan saja untuk belajar mandiri yang efektif.
                    </p>
                </div>

                <a href="#galeri-norma" class="inline-flex items-center gap-1 text-xs font-bold text-gray-600 hover:text-[#0F172A] whitespace-nowrap">
                    5 Modul Terstruktur ↗
                </a>
            </div>

            <!-- Two-Column Audio Layout: Module List vs Live Player -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Audio Modules List (Exactly as in Image 2) -->
                <div class="lg:col-span-7 space-y-3.5" id="audioModuleList">
                    
                    <!-- Module 1 -->
                    <div data-module-id="1" class="audio-module-item cursor-pointer p-5 rounded-2xl border border-gray-200/90 bg-white hover:border-gray-300 transition-all duration-200 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#E8FAF4] text-[#0F172A] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="text-gray-500 uppercase tracking-wider text-[11px] font-semibold">MODUL 1 • DASAR SOSIOLOGI</span>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-gray-500 text-[11px]">08:45</span>
                                    <span class="module-status-badge text-[11px] font-medium text-gray-500 flex items-center gap-1 hover:text-gray-800">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18v-6a9 9 0 0 1 18 0v6M3 18a3 3 0 0 0 3 3h1a3 3 0 0 0 3-3v-3a3 3 0 0 0-3-3H3v6zm18 0a3 3 0 0 1-3 3h-1a3 3 0 0 1-3-3v-3a3 3 0 0 1 3-3h1v6z"/></svg>
                                        Putar
                                    </span>
                                </div>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 module-title leading-snug">Nilai Sosial: Konsepsi Keindahan, Moral, &amp; Vital</h3>
                            <p class="text-xs text-gray-600 mt-1 line-clamp-2 module-excerpt">
                                Mengupas ragam nilai sosial Prof. Notonagoro: nilai material, vital, dan kerohanian dalam realitas warga.
                            </p>
                        </div>
                    </div>

                    <!-- Module 2 -->
                    <div data-module-id="2" class="audio-module-item cursor-pointer p-5 rounded-2xl border border-gray-200/90 bg-white hover:border-gray-300 transition-all duration-200 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#E8FAF4] text-[#0F172A] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="text-gray-500 uppercase tracking-wider text-[11px] font-semibold">MODUL 2 • ATURAN KEHIDUPAN</span>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-gray-500 text-[11px]">10:12</span>
                                    <span class="module-status-badge text-[11px] font-medium text-gray-500 flex items-center gap-1 hover:text-gray-800">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18v-6a9 9 0 0 1 18 0v6M3 18a3 3 0 0 0 3 3h1a3 3 0 0 0 3-3v-3a3 3 0 0 0-3-3H3v6zm18 0a3 3 0 0 1-3 3h-1a3 3 0 0 1-3-3v-3a3 3 0 0 1 3-3h1v6z"/></svg>
                                        Putar
                                    </span>
                                </div>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 module-title leading-snug">Norma Sosial: Dari Interaksi Menjadi Kesepakatan</h3>
                            <p class="text-xs text-gray-600 mt-1 line-clamp-2 module-excerpt">
                                Bagaimana kebiasaan berulang disepakati sebagai pedoman bertingkah laku kolektif demi ketertiban.
                            </p>
                        </div>
                    </div>

                    <!-- Module 3 (Active as in Image 2!) -->
                    <div data-module-id="3" class="audio-module-item active-module cursor-pointer p-5 rounded-2xl border-2 border-[#2563EB] bg-white shadow-sm transition-all duration-200 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#E8FAF4] text-[#0F172A] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="text-gray-500 uppercase tracking-wider text-[11px] font-semibold">MODUL 3 • KENALI SUMBERNYA</span>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-gray-500 text-[11px]">12:30</span>
                                    <span class="module-status-badge text-[11px] font-bold text-[#2563EB] bg-blue-100 px-2.5 py-0.5 rounded-full flex items-center gap-1 shadow-2xs">
                                        <svg class="w-2.5 h-2.5 fill-[#2563EB]" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        Aktif
                                    </span>
                                </div>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 module-title leading-snug">Empat Jenis Norma: Agama, Kesusilaan, Kesopanan, &amp; Hukum</h3>
                            <p class="text-xs text-gray-600 mt-1 line-clamp-2 module-excerpt">
                                Pembedahan sumber daya paksa dan daya ikat tiap norma beserta sanksi yang membayanginya.
                            </p>
                        </div>
                    </div>

                    <!-- Module 4 -->
                    <div data-module-id="4" class="audio-module-item cursor-pointer p-5 rounded-2xl border border-gray-200/90 bg-white hover:border-gray-300 transition-all duration-200 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#E8FAF4] text-[#0F172A] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="text-gray-500 uppercase tracking-wider text-[11px] font-semibold">MODUL 4 • KETERATURAN SOSIAL</span>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-gray-500 text-[11px]">09:15</span>
                                    <span class="module-status-badge text-[11px] font-medium text-gray-500 flex items-center gap-1 hover:text-gray-800">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18v-6a9 9 0 0 1 18 0v6M3 18a3 3 0 0 0 3 3h1a3 3 0 0 0 3-3v-3a3 3 0 0 0-3-3H3v6zm18 0a3 3 0 0 1-3 3h-1a3 3 0 0 1-3-3v-3a3 3 0 0 1 3-3h1v6z"/></svg>
                                        Putar
                                    </span>
                                </div>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 module-title leading-snug">Fungsi dan Sanksi: Pencegah Anomie &amp; Pengendali Sosial</h3>
                            <p class="text-xs text-gray-600 mt-1 line-clamp-2 module-excerpt">
                                Memahami konsep Emile Durkheim mengenai hilangnya pedoman norma (anomie) serta peran sanksi.
                            </p>
                        </div>
                    </div>

                    <!-- Module 5 -->
                    <div data-module-id="5" class="audio-module-item cursor-pointer p-5 rounded-2xl border border-gray-200/90 bg-white hover:border-gray-300 transition-all duration-200 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#E8FAF4] text-[#0F172A] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="text-gray-500 uppercase tracking-wider text-[11px] font-semibold">MODUL 5 • SOSIOLOGI MASA KINI</span>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-gray-500 text-[11px]">11:20</span>
                                    <span class="module-status-badge text-[11px] font-medium text-gray-500 flex items-center gap-1 hover:text-gray-800">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18v-6a9 9 0 0 1 18 0v6M3 18a3 3 0 0 0 3 3h1a3 3 0 0 0 3-3v-3a3 3 0 0 0-3-3H3v6zm18 0a3 3 0 0 1-3 3h-1a3 3 0 0 1-3-3v-3a3 3 0 0 1 3-3h1v6z"/></svg>
                                        Putar
                                    </span>
                                </div>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 module-title leading-snug">Nilai &amp; Norma Digital: Netiket, Cyberbullying, &amp; Jejak Algoritma</h3>
                            <p class="text-xs text-gray-600 mt-1 line-clamp-2 module-excerpt">
                                Dinamika norma di ruang siber, etika berinteraksi di media sosial, dan konstruksi identitas digital.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Interactive Now Playing Player Card -->
                <div class="lg:col-span-5 sticky top-28">
                    <div class="bg-white rounded-3xl border border-gray-200 shadow-xl p-6 sm:p-7">
                        
                        <!-- Top status: Sedang memutar & speed -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span id="playerPulse" class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#2563EB]"></span>
                                </span>
                                <span class="text-xs font-extrabold uppercase tracking-wider text-[#2563EB]">
                                    SEDANG MEMUTAR AUDIO
                                </span>
                            </div>

                            <button id="playerSpeedBtn" class="text-xs font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 px-2.5 py-1 rounded-full transition-colors">
                                1x
                            </button>
                        </div>

                        <!-- Active Module Details -->
                        <div class="mb-5">
                            <p id="playerSubtitle" class="text-xs font-medium text-gray-500 mb-1">Modul 3 • Kenali Sumbernya</p>
                            <h4 id="playerTitle" class="text-lg font-bold text-gray-900 leading-snug">
                                Empat Jenis Norma: Agama, Kesusilaan, Kesopanan, &amp; Hukum
                            </h4>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-600">
                                <span class="w-4 h-4 rounded-full bg-blue-100 text-[#2563EB] flex items-center justify-center text-[10px]">👤</span>
                                <span id="playerNarrator">Narator: Siti Rahmawati, M.Si</span>
                            </div>
                        </div>

                        <!-- Dynamic Audio Waveform -->
                        <div class="bg-gray-50/80 rounded-2xl p-4 border border-gray-100 mb-5">
                            <div id="playerWaveform" class="flex items-center justify-between gap-1.5 h-12 px-2">
                                <span class="w-1.5 h-4 bg-[#2563EB] rounded-full transition-all"></span>
                                <span class="w-1.5 h-8 bg-[#0F172A] rounded-full transition-all"></span>
                                <span class="w-1.5 h-10 bg-[#2563EB] rounded-full transition-all"></span>
                                <span class="w-1.5 h-5 bg-[#0F172A] rounded-full transition-all"></span>
                                <span class="w-1.5 h-9 bg-emerald-500 rounded-full transition-all"></span>
                                <span class="w-1.5 h-7 bg-[#2563EB] rounded-full transition-all"></span>
                                <span class="w-1.5 h-11 bg-[#0F172A] rounded-full transition-all"></span>
                                <span class="w-1.5 h-4 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-6 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-9 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-5 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-8 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-3 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-6 bg-gray-300 rounded-full transition-all"></span>
                            </div>

                            <!-- Scrubber & Timestamps -->
                            <div class="flex items-center justify-between text-xs font-mono text-gray-500 mt-2 px-1">
                                <span id="playerCurrentTime">03:24</span>
                                <span id="playerTotalTime">12:30</span>
                            </div>
                        </div>

                        <!-- Audio Controls -->
                        <div class="flex items-center justify-center gap-6 mb-6">
                            <!-- Rewind 10s -->
                            <button id="playerRewindBtn" class="text-gray-500 hover:text-gray-900 transition-colors p-2" title="Mundur 10 Detik">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.334 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z"/>
                                </svg>
                            </button>

                            <!-- Big Play / Pause Button -->
                            <button id="playerPlayPauseBtn" class="w-16 h-16 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white flex items-center justify-center shadow-lg shadow-blue-500/30 hover:scale-105 transition-all">
                                <!-- Pause Icon (default) -->
                                <svg id="pauseIcon" class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                                </svg>
                                <!-- Play Icon (hidden initially) -->
                                <svg id="playIcon" class="w-7 h-7 fill-current ml-0.5 hidden" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </button>

                            <!-- Forward 10s -->
                            <button id="playerForwardBtn" class="text-gray-500 hover:text-gray-900 transition-colors p-2" title="Maju 10 Detik">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.933 12.8a1 1 0 000-1.6L6.6 7.2A1 1 0 005 8v8a1 1 0 001.6.8l5.333-4zM19.933 12.8a1 1 0 000-1.6l-5.333-4A1 1 0 0013 8v8a1 1 0 001.6.8l5.333-4z"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Transcript Box -->
                        <div class="bg-amber-50/70 border border-amber-200/60 rounded-2xl p-4">
                            <div class="flex items-center justify-between text-xs mb-2">
                                <div class="flex items-center gap-1.5 font-bold text-amber-900">
                                    <span>📝</span> Ringkasan Transkrip
                                </div>
                                <span id="playerTranscriptMinute" class="text-amber-700/80 font-mono text-[11px]">Menit 04:10</span>
                            </div>
                            <blockquote id="playerTranscriptQuote" class="text-xs text-amber-900/90 leading-relaxed italic">
                                "Daya ikat norma berbeda menurut sumber legitimasi: dari sangsi batiniah kesusilaan hingga sangsi nyata aparatur hukum negara..."
                            </blockquote>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION 2: SETOR HAFALAN (RETRIEVAL PRACTICE & FLIP CARD)     -->
    <!-- ============================================================== -->
    <section id="setor-hafalan" class="py-20 lg:py-24 bg-[#F8FAFC] scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="mb-12">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-800 text-xs font-semibold mb-3 border border-amber-200/60">
                    <span>🎯</span> Metode Verbal Retrieval Practice
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] tracking-tight">
                    Setor Hafalan: Pelajari kartu konsep, lalu rekam penjelasanmu dengan 
                    <span class="relative inline-block text-[#0F172A]">
                        kata-katamu sendiri
                        <svg class="absolute -bottom-1.5 left-0 w-full h-3 text-[#2563EB]" viewBox="0 0 240 10" fill="none">
                            <path d="M3 6C70 2 160 2 237 7" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                        </svg>
                    </span>.
                </h2>
                <p class="mt-3 text-base text-gray-600 max-w-3xl leading-relaxed">
                    Uji pemahaman konseptualmu tanpa sekadar menghafal kata per kata. Balik kartu flashcard untuk melihat kunci kata, lalu aktifkan mikrofon untuk menyetorkan penalaran sosiologis mandiri.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Interactive 3D Flip Flashcard -->
                <div class="lg:col-span-6 space-y-4">
                    <div class="flex items-center justify-between text-xs font-semibold text-gray-600 px-1">
                        <span class="flex items-center gap-1.5">
                            <span>🎴</span> Klik Kartu Untuk Membalik (Depan / Belakang)
                        </span>
                        <span id="flashcardIndexBadge" class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full font-mono">
                            Kartu 1 dari 3
                        </span>
                    </div>

                    <!-- Flip Card Container (Perspective) -->
                    <div id="flashcardWrapper" class="perspective-1000 min-h-[340px] cursor-pointer group select-none">
                        <div id="flashcardInner" class="transform-style-3d relative w-full min-h-[340px] rounded-3xl transition-transform duration-500 shadow-xl">
                            
                            <!-- Card Front -->
                            <div class="backface-hidden absolute inset-0 w-full h-full bg-gradient-to-br from-[#0F172A] via-[#172554] to-[#020617] rounded-3xl p-8 text-white flex flex-col justify-between border border-blue-800/50">
                                <div>
                                    <div class="flex items-center justify-between mb-6">
                                        <span class="text-[11px] font-extrabold uppercase tracking-widest text-blue-300 bg-blue-900/60 px-3 py-1 rounded-full border border-blue-500/30">
                                            KARTU KONSEP UTAMA
                                        </span>
                                        <span class="text-xs text-blue-200/80 flex items-center gap-1 font-medium">
                                            ⟳ Ketuk untuk balik
                                        </span>
                                    </div>
                                    <h3 id="flashcardConceptTitle" class="text-2xl sm:text-3xl font-extrabold leading-snug tracking-tight text-white mb-4">
                                        Apa yang dimaksud dengan kondisi <span class="text-amber-400">Anomie</span> menurut Emile Durkheim?
                                    </h3>
                                    <p id="flashcardHint" class="text-blue-100/80 text-sm leading-relaxed">
                                        Pikirkan tentang perubahan sosial cepat dan dampaknya terhadap aturan kolektif di masyarakat.
                                    </p>
                                </div>

                                <div class="pt-6 border-t border-blue-800/80 flex items-center justify-between text-xs text-blue-300">
                                    <span>Klik untuk melihat kunci kata &amp; rubrik</span>
                                    <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                        ↗
                                    </span>
                                </div>
                            </div>

                            <!-- Card Back -->
                            <div class="backface-hidden rotate-y-180 absolute inset-0 w-full h-full bg-gradient-to-br from-[#1E293B] to-[#0F172A] rounded-3xl p-8 text-white flex flex-col justify-between border border-gray-700">
                                <div>
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-[11px] font-extrabold uppercase tracking-widest text-amber-300 bg-amber-950/60 px-3 py-1 rounded-full border border-amber-500/30">
                                            KATA KUNCI &amp; INDIKATOR
                                        </span>
                                        <span class="text-xs text-gray-400 flex items-center gap-1">
                                            ⟳ Ketuk untuk kembali
                                        </span>
                                    </div>
                                    <div id="flashcardKeywordsContent" class="space-y-3 text-sm text-gray-200">
                                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                                            <p class="font-bold text-amber-400 text-xs mb-1">1. Keadaan Tanpa Norma (Normlessness):</p>
                                            <p class="text-xs text-gray-300">Kondisi rapuhnya pedoman moral dan pudarnya kepatuhan terhadap aturan yang ada.</p>
                                        </div>
                                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                                            <p class="font-bold text-blue-300 text-xs mb-1">2. Pemicu Utama:</p>
                                            <p class="text-xs text-gray-300">Transisi sosial, industrialisasi cepat, atau krisis ekonomi yang mengubah tatanan.</p>
                                        </div>
                                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                                            <p class="font-bold text-sky-400 text-xs mb-1">3. Dampak Terhadap Individu:</p>
                                            <p class="text-xs text-gray-300">Kebingungan perilaku, alienasi, dan hilangnya pegangan nilai bersama.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-800 text-xs text-gray-400 flex items-center justify-between">
                                    <span>Sudah paham? Coba rekam di simulator kanan 👉</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Flashcard Navigation Tabs -->
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center gap-2">
                            <button data-card="1" class="flashcard-tab active px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#0F172A] text-white transition-colors">
                                1. Anomie
                            </button>
                            <button data-card="2" class="flashcard-tab px-3.5 py-1.5 rounded-full text-xs font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors">
                                2. Internalisasi Nilai
                            </button>
                            <button data-card="3" class="flashcard-tab px-3.5 py-1.5 rounded-full text-xs font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors">
                                3. Sanksi Hukum
                            </button>
                        </div>
                        <span class="text-xs text-gray-400 font-medium">Pilih kartu konsep</span>
                    </div>
                </div>

                <!-- Right Column: Voice Recording Submission Simulator -->
                <div class="lg:col-span-6">
                    <div class="bg-white rounded-3xl border border-gray-200 shadow-xl p-6 sm:p-7">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-full bg-blue-100 text-[#2563EB] flex items-center justify-center text-sm">
                                    🎙️
                                </span>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900">Simulator Setor Hafalan Suara</h4>
                                    <p class="text-[11px] text-gray-500">Jelaskan konsep dengan pemikiranmu sendiri</p>
                                </div>
                            </div>
                            <span id="recordingTimer" class="font-mono text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                01:30
                            </span>
                        </div>

                        <!-- Recording Waveform Area -->
                        <div class="bg-gray-50 rounded-2xl p-6 text-center border border-gray-100 mb-5 relative overflow-hidden">
                            <!-- Visualizer Dots/Bars -->
                            <div id="recordingWaveform" class="flex items-center justify-center gap-1.5 h-14 mb-3">
                                <span class="w-1.5 h-3 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-4 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-5 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-3 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-6 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-4 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-2 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-5 bg-gray-300 rounded-full transition-all"></span>
                                <span class="w-1.5 h-3 bg-gray-300 rounded-full transition-all"></span>
                            </div>

                            <p id="recordingStatusText" class="text-xs text-gray-600 font-medium">
                                Mikrofon siap. Klik tombol di bawah untuk mulai menjelaskan konsep terpilih.
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 mb-6">
                            <button id="startRecordingBtn" class="w-full sm:flex-1 py-3 px-5 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-semibold flex items-center justify-center gap-2 shadow-md shadow-blue-500/20 transition-all">
                                <span class="w-2.5 h-2.5 rounded-full bg-white"></span>
                                <span id="recordBtnLabel">Mulai Rekam Penjelasan</span>
                            </button>

                            <button id="listenRecordingBtn" class="w-full sm:w-auto py-3 px-6 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium flex items-center justify-center gap-2 transition-colors">
                                <span>🔊</span> Dengar Ulang
                            </button>
                        </div>

                        <!-- Feedback Box (Rubrik Penilaian) -->
                        <div class="bg-blue-50/70 border border-blue-200/70 rounded-2xl p-4">
                            <div class="flex items-center justify-between text-xs mb-2">
                                <span class="font-bold text-blue-900 flex items-center gap-1.5">
                                    <span>✨</span> Evaluasi Guru &amp; Rubrik Kata Kunci
                                </span>
                                <span class="text-[11px] font-semibold text-blue-800 bg-blue-100 px-2 py-0.5 rounded-full bg-blue-200/50">
                                    Siap Dinilai
                                </span>
                            </div>
                            <p class="text-xs text-blue-900/90 leading-relaxed">
                                Rubrik penilaian menilai: ketepatan konteks sosial, penyebutan istilah kunci tanpa membaca teks, serta contoh nyata yang relevan.
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION 3: GALERI EMPAT NORMA (COMPARISON MATRIX)              -->
    <!-- ============================================================== -->
    <section id="galeri-norma" class="py-20 lg:py-24 bg-white border-t border-b border-gray-200/60 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-800 text-xs font-semibold mb-3 border border-amber-200/50">
                        <span>📋</span> Matriks &amp; Analisis Komparatif
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] tracking-tight">
                        Galeri Empat Norma: 
                        <span class="relative inline-block text-[#0F172A]">
                            Pembeda Sumber
                            <svg class="absolute -bottom-1 left-0 w-full h-3 text-[#0F172A]" viewBox="0 0 240 10" fill="none">
                                <path d="M3 6C70 2 160 2 237 7" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </span> &amp; Konsekuensinya
                    </h2>
                    <p class="mt-3 text-base text-gray-600 max-w-3xl leading-relaxed">
                        Masyarakat hidup dengan 4 pilar aturan yang berbeda asal-usulnya. Pelajari peta perbandingan komprehensif berikut untuk memahami perbedaan daya ikat dan konsekuensinya.
                    </p>
                </div>

                <span class="inline-flex items-center gap-1 text-xs font-bold text-gray-600 whitespace-nowrap">
                    4 Pilar Utama ↗
                </span>
            </div>

            <!-- 4 Column Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- CARD 1: Norma Agama -->
                <div class="bg-[#F8FAFC] rounded-3xl p-6 border border-gray-200/80 hover:border-blue-300 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Card Top Bar: Icon + Edit icon -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-11 h-11 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg">
                                📖
                            </div>
                            <span class="text-gray-400 group-hover:text-gray-700 transition-colors">
                                ↗
                            </span>
                        </div>

                        <!-- Badge -->
                        <span class="inline-block text-[10px] font-extrabold uppercase tracking-widest text-gray-800 bg-gray-200/70 px-2.5 py-0.5 rounded-full mb-3">
                            PILAR I
                        </span>

                        <h3 class="text-xl font-extrabold text-gray-900 mb-2">Norma Agama</h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-6">
                            Petunjuk hidup yang berasal dari wahyu Tuhan Yang Maha Esa dan bersifat mutlak.
                        </p>

                        <!-- Structured Specs -->
                        <div class="space-y-4 text-xs">
                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Sumber Norma:</span>
                                <span class="font-bold text-gray-900">Tuhan / Kitab Suci</span>
                            </div>

                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Alasan Tindakan:</span>
                                <span class="font-medium text-gray-700 leading-snug block">Dorongan spiritual, keimanan, &amp; ketakwaan batiniah.</span>
                            </div>

                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Konsekuensi &amp; Sanksi:</span>
                                <span class="font-semibold text-rose-600 leading-snug block">Dosa, siksa di akhirat, dan kegelisahan rohani.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Example Box -->
                    <div class="mt-6 pt-4 border-t border-gray-200/80">
                        <span class="text-[11px] font-bold text-gray-900 block mb-1">Contoh Nyata:</span>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Menjalankan ibadah sholat/kebaktian tepat waktu, menghormati sesama pemeluk agama.
                        </p>
                    </div>
                </div>

                <!-- CARD 2: Norma Kesusilaan -->
                <div class="bg-[#F8FAFC] rounded-3xl p-6 border border-gray-200/80 hover:border-blue-300 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Card Top Bar: Icon + Edit icon -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-11 h-11 rounded-2xl bg-blue-100 text-blue-800 flex items-center justify-center text-lg">
                                🧡
                            </div>
                            <span class="text-gray-400 group-hover:text-gray-700 transition-colors">
                                ↗
                            </span>
                        </div>

                        <!-- Badge -->
                        <span class="inline-block text-[10px] font-extrabold uppercase tracking-widest text-gray-800 bg-gray-200/70 px-2.5 py-0.5 rounded-full mb-3">
                            PILAR II
                        </span>

                        <h3 class="text-xl font-extrabold text-gray-900 mb-2">Norma Kesusilaan</h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-6">
                            Peraturan hidup yang dianggap sebagai suara hati nurani manusia mengenai baik-buruk.
                        </p>

                        <!-- Structured Specs -->
                        <div class="space-y-4 text-xs">
                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Sumber Norma:</span>
                                <span class="font-bold text-[#0F172A]">Hati Nurani (Moralitas Insani)</span>
                            </div>

                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Alasan Tindakan:</span>
                                <span class="font-medium text-gray-700 leading-snug block">Integritas pribadi, kejujuran nurani, dan empati.</span>
                            </div>

                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Konsekuensi &amp; Sanksi:</span>
                                <span class="font-semibold text-rose-600 leading-snug block">Penyesalan batin mendalam, rasa bersalah, &amp; malu.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Example Box -->
                    <div class="mt-6 pt-4 border-t border-gray-200/80">
                        <span class="text-[11px] font-bold text-gray-900 block mb-1">Contoh Nyata:</span>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Tidak menyontek saat ujian, mengembalikan dompet orang asing yang terjatuh di jalan.
                        </p>
                    </div>
                </div>

                <!-- CARD 3: Norma Kesopanan -->
                <div class="bg-[#F8FAFC] rounded-3xl p-6 border border-gray-200/80 hover:border-blue-300 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Card Top Bar: Icon + Edit icon -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-11 h-11 rounded-2xl bg-blue-100 text-blue-800 flex items-center justify-center text-lg">
                                👥
                            </div>
                            <span class="text-gray-400 group-hover:text-gray-700 transition-colors">
                                ↗
                            </span>
                        </div>

                        <!-- Badge -->
                        <span class="inline-block text-[10px] font-extrabold uppercase tracking-widest text-gray-800 bg-gray-200/70 px-2.5 py-0.5 rounded-full mb-3">
                            PILAR III
                        </span>

                        <h3 class="text-xl font-extrabold text-gray-900 mb-2">Norma Kesopanan</h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-6">
                            Peraturan yang timbul dari pergaulan segolongan manusia dalam tata krama sehari-hari.
                        </p>

                        <!-- Structured Specs -->
                        <div class="space-y-4 text-xs">
                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Sumber Norma:</span>
                                <span class="font-bold text-gray-900">Pergaulan Masyarakat &amp; Adat</span>
                            </div>

                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Alasan Tindakan:</span>
                                <span class="font-medium text-gray-700 leading-snug block">Kepantasan sosial, kesantunan bertutur, keharmonisan.</span>
                            </div>

                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Konsekuensi &amp; Sanksi:</span>
                                <span class="font-semibold text-rose-600 leading-snug block">Teguran, cemoohan, dikucilkan dari pergaulan.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Example Box -->
                    <div class="mt-6 pt-4 border-t border-gray-200/80">
                        <span class="text-[11px] font-bold text-gray-900 block mb-1">Contoh Nyata:</span>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Menyapa guru saat berpapasan, tidak makan sambil berbicara keras di tempat umum.
                        </p>
                    </div>
                </div>

                <!-- CARD 4: Norma Hukum -->
                <div class="bg-[#F8FAFC] rounded-3xl p-6 border border-gray-200/80 hover:border-blue-300 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Card Top Bar: Icon + Edit icon -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-11 h-11 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg">
                                ⚖️
                            </div>
                            <span class="text-gray-400 group-hover:text-gray-700 transition-colors">
                                ↗
                            </span>
                        </div>

                        <!-- Badge -->
                        <span class="inline-block text-[10px] font-extrabold uppercase tracking-widest text-gray-800 bg-gray-200/70 px-2.5 py-0.5 rounded-full mb-3">
                            PILAR IV
                        </span>

                        <h3 class="text-xl font-extrabold text-gray-900 mb-2">Norma Hukum</h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-6">
                            Peraturan resmi yang dibuat oleh penguasa/lembaga negara dengan sifat memaksa tegas.
                        </p>

                        <!-- Structured Specs -->
                        <div class="space-y-4 text-xs">
                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Sumber Norma:</span>
                                <span class="font-bold text-gray-900">Lembaga Negara (Undang-Undang)</span>
                            </div>

                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Alasan Tindakan:</span>
                                <span class="font-medium text-gray-700 leading-snug block">Kepatuhan yuridis, jaminan keadilan, perlindungan.</span>
                            </div>

                            <div>
                                <span class="text-gray-400 font-medium block mb-0.5 text-[11px]">Konsekuensi &amp; Sanksi:</span>
                                <span class="font-semibold text-rose-600 leading-snug block">Tegas &amp; Nyata: Denda, kurungan, hingga pidana.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Example Box -->
                    <div class="mt-6 pt-4 border-t border-gray-200/80">
                        <span class="text-[11px] font-bold text-gray-900 block mb-1">Contoh Nyata:</span>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Memakai helm &amp; membawa SIM saat berkendara, membayar pajak tepat waktu.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION 4: ZONA LATIHAN (GAMIFIKASI & ASESMEN)                  -->
    <!-- ============================================================== -->
    <section id="zona-latihan" class="py-20 lg:py-24 bg-[#F8FAFC] scroll-mt-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-left mb-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-800 text-xs font-semibold mb-3 border border-blue-200/60">
                    <span>🎮</span> Zona Gamifikasi &amp; Asesmen Formatif
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] tracking-tight">
                    Zona Latihan: Tiga Mode Belajar 
                    <span class="relative inline-block text-[#0F172A]">
                        Gamifikasi
                        <svg class="absolute -bottom-1.5 left-0 w-full h-3 text-[#2563EB]" viewBox="0 0 160 10" fill="none">
                            <path d="M3 6C50 2 110 2 157 7" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                        </svg>
                    </span>
                </h2>
                <p class="mt-3 text-base text-gray-600 max-w-2xl leading-relaxed">
                    Pilih mode belajar favoritmu untuk menguji ketangkasan nalar sosiologismu: mulai dari kuis berwaktu, analisis fenomena viral, hingga simulasi pencocokan puzzle norma.
                </p>
            </div>

            <!-- Mode Selector Tabs -->
            <div class="flex flex-wrap items-center gap-3 mb-8">
                <button id="modeTab1" class="quiz-mode-tab active px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold bg-[#0F172A] text-white flex items-center gap-2 shadow-sm transition-all">
                    <span>✓</span> Kuis Cepat Berwaktu
                </button>
                <button id="modeTab2" class="quiz-mode-tab px-5 py-2.5 rounded-full text-xs sm:text-sm font-medium bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition-all">
                    <span>📰</span> Analisis Kasus Viral
                </button>
                <button id="modeTab3" class="quiz-mode-tab px-5 py-2.5 rounded-full text-xs sm:text-sm font-medium bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition-all">
                    <span>🧩</span> Puzzle Sorter Norma
                </button>
            </div>

            <!-- Interactive Quiz Card -->
            <div class="bg-white rounded-3xl border border-gray-200 shadow-xl p-6 sm:p-9 relative">
                
                <!-- Quiz Meta Bar -->
                <div class="flex flex-wrap items-center justify-between gap-4 pb-5 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <span id="quizQuestionCountBadge" class="bg-amber-100 text-amber-900 text-xs font-bold px-3 py-1 rounded-full">
                            Soal 1 dari 5
                        </span>
                        <span id="quizTopicBadge" class="text-xs text-gray-500 font-medium">
                            Topik: Nilai Material vs Nilai Vital
                        </span>
                    </div>

                    <div class="flex items-center gap-4 text-xs font-mono font-bold">
                        <span class="flex items-center gap-1.5 text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                            ⏳ <span id="quizTimerText">00:25</span>
                        </span>
                        <span class="flex items-center gap-1.5 text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200/50">
                            Skor : <span id="quizScoreText">0</span>
                        </span>
                    </div>
                </div>

                <!-- Question Body -->
                <div class="py-7">
                    <h3 id="quizQuestionText" class="text-lg sm:text-xl font-bold text-gray-900 leading-relaxed mb-6">
                        Seorang pekerja bangunan membutuhkan helm pelindung dan sepatu keselamatan agar dapat bekerja tanpa bahaya fisik. Dalam klasifikasi nilai Prof. Notonagoro, helm tersebut paling tepat digolongkan sebagai...
                    </h3>

                    <!-- Options list -->
                    <div id="quizOptionsContainer" class="space-y-3.5">
                        
                        <!-- Option A -->
                        <div data-option="A" class="quiz-option cursor-pointer p-4 rounded-2xl border border-gray-200 bg-white hover:border-gray-300 hover:bg-gray-50/70 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-gray-100 text-gray-700 font-bold text-xs flex items-center justify-center group-hover:bg-gray-200">
                                    A
                                </span>
                                <span class="text-sm font-semibold text-gray-800 option-label">Nilai Kerohanian</span>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-gray-400 flex items-center justify-center option-radio">
                                <div class="w-2.5 h-2.5 rounded-full bg-transparent"></div>
                            </div>
                        </div>

                        <!-- Option B (Correct) -->
                        <div data-option="B" class="quiz-option cursor-pointer p-4 rounded-2xl border border-gray-200 bg-white hover:border-gray-300 hover:bg-gray-50/70 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-gray-100 text-gray-700 font-bold text-xs flex items-center justify-center group-hover:bg-gray-200">
                                    B
                                </span>
                                <span class="text-sm font-semibold text-gray-800 option-label">Nilai Vital</span>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-gray-400 flex items-center justify-center option-radio">
                                <div class="w-2.5 h-2.5 rounded-full bg-transparent"></div>
                            </div>
                        </div>

                        <!-- Option C -->
                        <div data-option="C" class="quiz-option cursor-pointer p-4 rounded-2xl border border-gray-200 bg-white hover:border-gray-300 hover:bg-gray-50/70 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-gray-100 text-gray-700 font-bold text-xs flex items-center justify-center group-hover:bg-gray-200">
                                    C
                                </span>
                                <span class="text-sm font-semibold text-gray-800 option-label">Nilai Estetika (Keindahan)</span>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-gray-400 flex items-center justify-center option-radio">
                                <div class="w-2.5 h-2.5 rounded-full bg-transparent"></div>
                            </div>
                        </div>

                        <!-- Option D -->
                        <div data-option="D" class="quiz-option cursor-pointer p-4 rounded-2xl border border-gray-200 bg-white hover:border-gray-300 hover:bg-gray-50/70 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-gray-100 text-gray-700 font-bold text-xs flex items-center justify-center group-hover:bg-gray-200">
                                    D
                                </span>
                                <span class="text-sm font-semibold text-gray-800 option-label">Nilai Logika (Kebenaran)</span>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-gray-400 flex items-center justify-center option-radio">
                                <div class="w-2.5 h-2.5 rounded-full bg-transparent"></div>
                            </div>
                        </div>

                    </div>

                    <!-- Explanation Alert (Appears after answer) -->
                    <div id="quizExplanationBox" class="hidden mt-5 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900">
                        <span class="font-bold">Penjelasan:</span> Nilai Vital adalah segala sesuatu yang berguna bagi manusia untuk dapat mengadakan kegiatan atau aktivitas secara optimal (contoh: helm kerja bagi tukang, cangkul bagi petani).
                    </div>
                </div>

                <!-- Quiz Card Footer Action -->
                <div class="pt-4 border-t border-gray-100 flex items-center justify-end">
                    <button id="quizNextBtn" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-semibold shadow-md shadow-blue-500/20 transition-all">
                        <span>Soal Berikutnya</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                    </button>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION 5: ULASAN / TESTIMONI SISWA & GURU                     -->
    <!-- ============================================================== -->
    <section id="ulasan" class="py-20 lg:py-24 bg-white border-t border-b border-gray-200/60 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] tracking-tight">
                        Apa Kata Para <span class="text-[#0F172A]">Guru &amp; Siswa</span> Kami?
                    </h2>
                    <p class="mt-3 text-base text-gray-600 max-w-2xl leading-relaxed">
                        Kisah nyata guru dan siswa SMA yang mengalami peningkatan pemahaman sosiologi lewat narasi audio dan simulator SovNorm.
                    </p>
                </div>

                <div class="flex items-center gap-1.5 bg-amber-50 border border-amber-200/80 px-4 py-2 rounded-full text-xs font-bold text-amber-900">
                    <span>⭐</span>
                    <span>Nilai 4.9/5 dari 300+ Sekolah</span>
                </div>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Testimonial 1 -->
                <div class="bg-[#F8FAFC] rounded-3xl p-7 border border-gray-200/80 flex flex-col justify-between hover:shadow-lg transition-shadow">
                    <div>
                        <!-- Header with avatar & name -->
                        <div class="flex items-center gap-3.5 mb-4">
                            <div class="w-11 h-11 rounded-full bg-blue-100 text-[#0F172A] font-bold text-sm flex items-center justify-center">
                                BA
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 leading-tight">Bambang Anshori, M.Pd</h4>
                                <p class="text-[11px] text-gray-500">Guru Sosiologi SMAN 1 Yogyakarta</p>
                            </div>
                        </div>

                        <!-- 5 Stars -->
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3.5">
                            ★★★★★
                        </div>

                        <!-- Quote -->
                        <p class="text-xs text-gray-600 leading-relaxed italic">
                            "Metode audio SovNorm sangat membantu siswa saya mengaitkan teori Notonagoro dan Durkheim dengan fenomena nyata. Latihan setor hafalan membuat siswa aktif berargumen."
                        </p>
                    </div>

                    <!-- Footer Verification Badge -->
                    <div class="mt-6 pt-4 border-t border-gray-200/70 flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Terverifikasi Guru Sosiologi
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-[#F8FAFC] rounded-3xl p-7 border border-gray-200/80 flex flex-col justify-between hover:shadow-lg transition-shadow">
                    <div>
                        <!-- Header with avatar & name -->
                        <div class="flex items-center gap-3.5 mb-4">
                            <div class="w-11 h-11 rounded-full bg-blue-100 text-[#2563EB] font-bold text-sm flex items-center justify-center">
                                ND
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 leading-tight">Nadia Danastri</h4>
                                <p class="text-[11px] text-gray-500">Siswi Kelas XI SMA Labschool</p>
                            </div>
                        </div>

                        <!-- 5 Stars -->
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3.5">
                            ★★★★★
                        </div>

                        <!-- Quote -->
                        <p class="text-xs text-gray-600 leading-relaxed italic">
                            "Sebelumnya belajar norma terasa teoritis dan membosankan. Begitu mencoba fitur podcast mini dan puzzle kartu, konsep sosiologi jadi nempel banget di kepala tanpa capek menghafal."
                        </p>
                    </div>

                    <!-- Footer Verification Badge -->
                    <div class="mt-6 pt-4 border-t border-gray-200/70 flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Siswa Pengguna Aktif
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-[#F8FAFC] rounded-3xl p-7 border border-gray-200/80 flex flex-col justify-between hover:shadow-lg transition-shadow">
                    <div>
                        <!-- Header with avatar & name -->
                        <div class="flex items-center gap-3.5 mb-4">
                            <div class="w-11 h-11 rounded-full bg-slate-200 text-slate-800 font-bold text-sm flex items-center justify-center">
                                RH
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 leading-tight">Rizky Hernanda, S.Sos</h4>
                                <p class="text-[11px] text-gray-500">Pembina Olimpiade Sosiologi SMA</p>
                            </div>
                        </div>

                        <!-- 5 Stars -->
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3.5">
                            ★★★★★
                        </div>

                        <!-- Quote -->
                        <p class="text-xs text-gray-600 leading-relaxed italic">
                            "Rubrik evaluasi setor suara dan analisis studi kasus media sosialnya sangat selaras dengan AKM dan Kurikulum Merdeka. Media yang segar bagi pendidikan ilmu sosial."
                        </p>
                    </div>

                    <!-- Footer Verification Badge -->
                    <div class="mt-6 pt-4 border-t border-gray-200/70 flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Instruktur OSN Sosiologi
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- SECTION 6: CALL TO ACTION BANNER (KOMUNITAS SOSIOLOGI)        -->
    <!-- ============================================================== -->
    <section class="py-16 lg:py-20 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-gradient-to-r from-[#1D4ED8] via-[#1E40AF] to-[#0F172A] rounded-3xl p-8 sm:p-12 lg:p-16 text-white overflow-hidden shadow-2xl">
                
                <!-- Watermark graphic on right side -->
                <div class="absolute right-0 top-0 bottom-0 pointer-events-none opacity-10 flex items-center select-none">
                    <span class="text-[180px] font-black tracking-tighter rotate-90 transform translate-x-12">
                        GLYPH
                    </span>
                </div>

                <div class="relative z-10 max-w-2xl space-y-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-blue-200 text-xs font-semibold backdrop-blur-sm border border-white/10">
                        <span>👥</span> Komunitas Belajar Interaktif
                    </span>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white">
                        Bergabung dengan Komunitas Belajar Sosiologi
                    </h2>

                    <p class="text-base sm:text-lg text-blue-100/90 leading-relaxed font-normal">
                        Tingkatkan pemahaman sosiologi dengan materi audio terpadu, rubrik verbal otomatis, dan bank studi kasus kurikulum terkini.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-semibold text-base shadow-lg shadow-blue-500/25 transition-all duration-200">
                                Mulai Belajar Sekarang
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                            </a>
                        @else
                            <a href="#zona-latihan" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-semibold text-base shadow-lg shadow-blue-500/25 transition-all duration-200">
                                Mulai Belajar Sekarang
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                            </a>
                        @endguest
                        <a href="#panduan-sekolah" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-medium text-base border border-white/15 transition-all duration-200">
                            Panduan Untuk Sekolah
                        </a>
                    </div>
                </div>

                <!-- Subtle corner badge button -->
                <div class="absolute top-6 right-6 hidden sm:block">
                    <span class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:text-white transition-colors cursor-pointer">
                        ↗
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- CLIENT INTERACTIVITY JAVASCRIPT                               -->
    <!-- ============================================================== -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ==========================================================
            // 1. NAVBAR ACTIVE INTERACTION & SCROLL SPY (MATCHING IMAGE 1)
            // ==========================================================
            const navItems = document.querySelectorAll('#desktopNav .nav-item');
            const mobileNavItems = document.querySelectorAll('.mobile-nav-item');
            const sections = [
                'materi-audio',
                'setor-hafalan',
                'galeri-norma',
                'zona-latihan',
                'ulasan'
            ];

            let isManualScroll = false;
            let scrollTimer = null;

            function setActiveNav(targetNavId) {
                // Update Desktop Nav
                navItems.forEach(item => {
                    const navId = item.getAttribute('data-nav');
                    const textSpan = item.querySelector('.nav-text');
                    const indicator = item.querySelector('.nav-indicator');
                    
                    if (navId === targetNavId) {
                        if (textSpan) {
                            textSpan.className = 'nav-text font-bold text-gray-900 tracking-tight transition-colors';
                        }
                        if (indicator) {
                            indicator.classList.remove('opacity-0');
                            indicator.classList.add('opacity-100');
                        }
                    } else {
                        if (textSpan) {
                            textSpan.className = 'nav-text font-normal text-slate-500 hover:text-gray-900 tracking-tight transition-colors';
                        }
                        if (indicator) {
                            indicator.classList.remove('opacity-100');
                            indicator.classList.add('opacity-0');
                        }
                    }
                });

                // Update Mobile Nav
                mobileNavItems.forEach(item => {
                    const navId = item.getAttribute('data-nav');
                    if (navId === targetNavId) {
                        item.className = 'mobile-nav-item block font-bold text-[#2563EB]';
                    } else {
                        item.className = 'mobile-nav-item block font-medium text-gray-700 hover:text-[#2563EB]';
                    }
                });
            }

            // Click listener for desktop nav with smooth scroll & scroll spy lock
            navItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    const navId = item.getAttribute('data-nav');
                    setActiveNav(navId);

                    const targetSection = document.getElementById(navId);
                    if (targetSection) {
                        isManualScroll = true;
                        clearTimeout(scrollTimer);

                        const headerOffset = 84;
                        const elementTop = targetSection.getBoundingClientRect().top + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: elementTop,
                            behavior: 'smooth'
                        });

                        // Release manual lock after scroll animation finishes
                        scrollTimer = setTimeout(() => {
                            isManualScroll = false;
                        }, 800);
                    }
                });
            });

            // Click listener for mobile nav
            mobileNavItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    const navId = item.getAttribute('data-nav');
                    setActiveNav(navId);
                    document.getElementById('mobileMenu').classList.add('hidden');

                    const targetSection = document.getElementById(navId);
                    if (targetSection) {
                        isManualScroll = true;
                        clearTimeout(scrollTimer);
                        const headerOffset = 84;
                        const elementTop = targetSection.getBoundingClientRect().top + window.pageYOffset - headerOffset;
                        window.scrollTo({
                            top: elementTop,
                            behavior: 'smooth'
                        });
                        scrollTimer = setTimeout(() => {
                            isManualScroll = false;
                        }, 800);
                    }
                });
            });

            // Click listener for mobile CTA 'Mulai Belajar'
            const mobileCtaBtn = document.getElementById('mobileCtaBtn');
            if (mobileCtaBtn) {
                mobileCtaBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    setActiveNav('zona-latihan');
                    document.getElementById('mobileMenu').classList.add('hidden');
                    const targetSection = document.getElementById('zona-latihan');
                    if (targetSection) {
                        isManualScroll = true;
                        clearTimeout(scrollTimer);
                        const headerOffset = 84;
                        const elementTop = targetSection.getBoundingClientRect().top + window.pageYOffset - headerOffset;
                        window.scrollTo({
                            top: elementTop,
                            behavior: 'smooth'
                        });
                        scrollTimer = setTimeout(() => {
                            isManualScroll = false;
                        }, 800);
                    }
                });
            }

            // Scroll Spy using IntersectionObserver
            const observerOptions = {
                root: null,
                rootMargin: '-20% 0px -55% 0px',
                threshold: 0
            };

            const sectionObserver = new IntersectionObserver((entries) => {
                if (isManualScroll) return; // Ignore scroll spy during programmatic smooth scrolling
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        if (sections.includes(id)) {
                            setActiveNav(id);
                        }
                    }
                });
            }, observerOptions);

            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) sectionObserver.observe(el);
            });

            // Mobile Menu Drawer Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // ==========================================================
            // 2. RUANG MATERI AUDIO INTERACTION (MATCHING IMAGE 2)
            // ==========================================================
            const modulesData = {
                1: {
                    moduleNum: "Modul 1 • Dasar Sosiologi",
                    title: "Nilai Sosial: Konsepsi Keindahan, Moral, & Vital",
                    narrator: "Narator: Tim Kurikulum Sosiologi SovNorm",
                    duration: "08:45",
                    transcript: "“Nilai bukan sekadar apa yang disukai, melainkan anggapan dasar tentang apa yang benar, berharga, dan pantas dijadikan tolok ukur tindakan sosial dalam masyarakat...”",
                    minute: "Menit 03:20"
                },
                2: {
                    moduleNum: "Modul 2 • Aturan Kehidupan",
                    title: "Norma Sosial: Dari Interaksi Menjadi Kesepakatan",
                    narrator: "Narator: Dr. Aris Munandar",
                    duration: "10:12",
                    transcript: "“Norma adalah wujud konkret dari nilai-nilai sosial. Bila nilai adalah gagasan tentang yang baik, norma adalah petunjuk teknis bagaimana bertindak...”",
                    minute: "Menit 02:45"
                },
                3: {
                    moduleNum: "Modul 3 • Kenali Sumbernya",
                    title: "Empat Jenis Norma: Agama, Kesusilaan, Kesopanan, & Hukum",
                    narrator: "Narator: Siti Rahmawati, M.Si",
                    duration: "12:30",
                    transcript: "“Daya ikat norma berbeda menurut sumber legitimasi: dari sangsi batiniah kesusilaan hingga sangsi nyata aparatur hukum negara...”",
                    minute: "Menit 04:10"
                },
                4: {
                    moduleNum: "Modul 4 • Keteraturan Sosial",
                    title: "Fungsi dan Sanksi: Pencegah Anomie & Pengendali Sosial",
                    narrator: "Narator: Prof. Hendarman",
                    duration: "09:15",
                    transcript: "“Ketika norma melemah dan kehilangan daya ikat, masyarakat berada dalam risiko anomie: kondisi disorientasi moral yang memicu keresahan sosial...”",
                    minute: "Menit 01:50"
                },
                5: {
                    moduleNum: "Modul 5 • Sosiologi Masa Kini",
                    title: "Nilai & Norma Digital: Netiket, Cyberbullying, & Jejak Algoritma",
                    narrator: "Narator: Tim Sosiologi Digital SovNorm",
                    duration: "11:20",
                    transcript: "“Di dunia maya, norma tidak serta-merta lenyap; netiket menjadi kesepakatan etika baru dalam menavigasi interaksi di ruang digital...”",
                    minute: "Menit 05:00"
                }
            };

            const moduleItems = document.querySelectorAll('.audio-module-item');
            const playerSubtitle = document.getElementById('playerSubtitle');
            const playerTitle = document.getElementById('playerTitle');
            const playerNarrator = document.getElementById('playerNarrator');
            const playerTotalTime = document.getElementById('playerTotalTime');
            const playerTranscriptQuote = document.getElementById('playerTranscriptQuote');
            const playerTranscriptMinute = document.getElementById('playerTranscriptMinute');
            const playerPlayPauseBtn = document.getElementById('playerPlayPauseBtn');
            const pauseIcon = document.getElementById('pauseIcon');
            const playIcon = document.getElementById('playIcon');
            const playerPulse = document.getElementById('playerPulse');
            const playerWaveform = document.getElementById('playerWaveform');
            const playerSpeedBtn = document.getElementById('playerSpeedBtn');
            const playerCurrentTime = document.getElementById('playerCurrentTime');

            let isPlaying = true;
            let currentSeconds = 204; // 03:24
            let timerInterval = null;

            // Optional Web Audio feedback
            let audioCtx = null;
            function playSoundBeep(freq = 440, duration = 0.15) {
                try {
                    if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, audioCtx.currentTime);
                    gain.gain.setValueAtTime(0.08, audioCtx.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + duration);
                    osc.connect(gain);
                    gain.connect(audioCtx.destination);
                    osc.start();
                    osc.stop(audioCtx.currentTime + duration);
                } catch(e) {}
            }

            function formatTime(secs) {
                const m = Math.floor(secs / 60).toString().padStart(2, '0');
                const s = (secs % 60).toString().padStart(2, '0');
                return `${m}:${s}`;
            }

            function startTimer() {
                if (timerInterval) clearInterval(timerInterval);
                timerInterval = setInterval(() => {
                    if (isPlaying) {
                        currentSeconds++;
                        playerCurrentTime.textContent = formatTime(currentSeconds);
                        // Animate waveform bars
                        const bars = playerWaveform.querySelectorAll('span');
                        bars.forEach((bar, idx) => {
                            const heights = ['0.75rem', '1.25rem', '1.75rem', '2.25rem', '2.75rem'];
                            const randomH = heights[(idx + currentSeconds) % heights.length];
                            bar.style.height = randomH;
                        });
                    }
                }, 1000);
            }

            startTimer();

            // Set active module function with exact styles matching Image 2
            function setActiveModule(id) {
                const data = modulesData[id];
                if (!data) return;

                moduleItems.forEach(item => {
                    const itemId = item.getAttribute('data-module-id');
                    const badge = item.querySelector('.module-status-badge');
                    
                    if (itemId === id.toString()) {
                        // EXACT ACTIVE STATE AS IN IMAGE 2:
                        // border-2 border-[#2563EB] bg-white shadow-sm
                        item.className = 'audio-module-item active-module cursor-pointer p-5 rounded-2xl border-2 border-[#2563EB] bg-white shadow-sm transition-all duration-200 flex items-start gap-4';
                        if (badge) {
                            badge.className = 'module-status-badge text-[11px] font-bold text-[#2563EB] bg-blue-100 px-2.5 py-0.5 rounded-full flex items-center gap-1 shadow-2xs';
                            badge.innerHTML = `<svg class="w-2.5 h-2.5 fill-[#2563EB]" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg> Aktif`;
                        }
                    } else {
                        // INACTIVE STATE AS IN IMAGE 2:
                        // border border-gray-200/90 bg-white
                        item.className = 'audio-module-item cursor-pointer p-5 rounded-2xl border border-gray-200/90 bg-white hover:border-gray-300 transition-all duration-200 flex items-start gap-4';
                        if (badge) {
                            badge.className = 'module-status-badge text-[11px] font-medium text-gray-500 flex items-center gap-1 hover:text-gray-800';
                            badge.innerHTML = `<svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18v-6a9 9 0 0 1 18 0v6M3 18a3 3 0 0 0 3 3h1a3 3 0 0 0 3-3v-3a3 3 0 0 0-3-3H3v6zm18 0a3 3 0 0 1-3 3h-1a3 3 0 0 1-3-3v-3a3 3 0 0 1 3-3h1v6z"/></svg> Putar`;
                        }
                    }
                });

                // Update right player details
                playerSubtitle.textContent = data.moduleNum;
                playerTitle.textContent = data.title;
                playerNarrator.textContent = data.narrator;
                playerTotalTime.textContent = data.duration;
                playerTranscriptQuote.textContent = data.transcript;
                if (playerTranscriptMinute) playerTranscriptMinute.textContent = data.minute;
                currentSeconds = 0;
                playerCurrentTime.textContent = "00:00";

                // Ensure playing state
                isPlaying = true;
                pauseIcon.classList.remove('hidden');
                playIcon.classList.add('hidden');
                playerPulse.classList.add('animate-ping');
                playSoundBeep(520, 0.12);
            }

            // Click listener on audio module cards
            moduleItems.forEach(item => {
                item.addEventListener('click', () => {
                    const id = item.getAttribute('data-module-id');
                    setActiveModule(id);
                });
            });

            // Initialize with Modul 3 active as shown in user's image 2
            setActiveModule(3);

            // Play / Pause Toggle
            playerPlayPauseBtn.addEventListener('click', () => {
                isPlaying = !isPlaying;
                if (isPlaying) {
                    pauseIcon.classList.remove('hidden');
                    playIcon.classList.add('hidden');
                    playerPulse.classList.add('animate-ping');
                    playSoundBeep(440, 0.1);
                } else {
                    pauseIcon.classList.add('hidden');
                    playIcon.classList.remove('hidden');
                    playerPulse.classList.remove('animate-ping');
                    playSoundBeep(330, 0.1);
                }
            });

            // Rewind & Forward buttons
            document.getElementById('playerRewindBtn').addEventListener('click', () => {
                currentSeconds = Math.max(0, currentSeconds - 10);
                playerCurrentTime.textContent = formatTime(currentSeconds);
                playSoundBeep(380, 0.08);
            });
            document.getElementById('playerForwardBtn').addEventListener('click', () => {
                currentSeconds += 10;
                playerCurrentTime.textContent = formatTime(currentSeconds);
                playSoundBeep(480, 0.08);
            });

            // Speed cycle
            const speeds = ['1x', '1.25x', '1.5x', '2x'];
            let speedIdx = 0;
            playerSpeedBtn.addEventListener('click', () => {
                speedIdx = (speedIdx + 1) % speeds.length;
                playerSpeedBtn.textContent = speeds[speedIdx];
                playSoundBeep(580, 0.05);
            });

            // Quick audio button & hero play button scroll & trigger
            const quickBtn = document.getElementById('quickAudioBtn');
            const heroPlayBtn = document.getElementById('heroPlayAudioBtn');
            [quickBtn, heroPlayBtn].forEach(b => {
                if (b) {
                    b.addEventListener('click', () => {
                        const target = document.getElementById('materi-audio');
                        if (target) {
                            target.scrollIntoView({ behavior: 'smooth' });
                            setActiveModule(1);
                        }
                    });
                }
            });

            // ==========================================================
            // 3. FLASHCARD 3D FLIP & CONCEPT SWITCHING
            // ==========================================================
            const flashcardWrapper = document.getElementById('flashcardWrapper');
            const flashcardInner = document.getElementById('flashcardInner');
            let isFlipped = false;

            flashcardWrapper.addEventListener('click', () => {
                isFlipped = !isFlipped;
                if (isFlipped) {
                    flashcardInner.classList.add('rotate-y-180');
                } else {
                    flashcardInner.classList.remove('rotate-y-180');
                }
            });

            const cardsData = {
                1: {
                    title: "Apa yang dimaksud dengan kondisi <span class='text-amber-400'>Anomie</span> menurut Emile Durkheim?",
                    hint: "Pikirkan tentang perubahan sosial cepat dan dampaknya terhadap aturan kolektif di masyarakat.",
                    keywords: `
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-amber-400 text-xs mb-1">1. Keadaan Tanpa Norma (Normlessness):</p>
                            <p class="text-xs text-gray-300">Kondisi rapuhnya pedoman moral dan pudarnya kepatuhan terhadap aturan yang ada.</p>
                        </div>
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-blue-300 text-xs mb-1">2. Pemicu Utama:</p>
                            <p class="text-xs text-gray-300">Transisi sosial, industrialisasi cepat, atau krisis ekonomi yang mengubah tatanan.</p>
                        </div>
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-sky-400 text-xs mb-1">3. Dampak Terhadap Individu:</p>
                            <p class="text-xs text-gray-300">Kebingungan perilaku, alienasi, dan hilangnya pegangan nilai bersama.</p>
                        </div>
                    `
                },
                2: {
                    title: "Bagaimana proses <span class='text-amber-400'>Internalisasi Nilai</span> terjadi dalam sosialisasi primer?",
                    hint: "Ingat kembali peran keluarga dan tahap pembentukan diri (taking the role of other).",
                    keywords: `
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-amber-400 text-xs mb-1">1. Penyerapan Nilai Mendalam:</p>
                            <p class="text-xs text-gray-300">Nilai diserap menjadi kepribadian batin tanpa perlu paksaan dari luar.</p>
                        </div>
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-blue-300 text-xs mb-1">2. Agen Utama:</p>
                            <p class="text-xs text-gray-300">Keluarga inti melalui keteladanan, pembiasaan, serta ganjaran dan hukuman afektif.</p>
                        </div>
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-sky-400 text-xs mb-1">3. Hasil Akhir:</p>
                            <p class="text-xs text-gray-300">Rasa bersalah otomatis muncul dari nurani jika melakukan pelanggaran.</p>
                        </div>
                    `
                },
                3: {
                    title: "Mengapa <span class='text-amber-400'>Sanksi Hukum</span> memiliki daya paksa tertinggi dibanding norma lain?",
                    hint: "Fokus pada legitimasi negara dan keberadaan aparatur penegak resmi.",
                    keywords: `
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-amber-400 text-xs mb-1">1. Legitimasi Kekuasaan Negara:</p>
                            <p class="text-xs text-gray-300">Dibuat oleh lembaga berwenang (DPR/Pemerintah) dan berlaku mengikat bagi seluruh warga.</p>
                        </div>
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-blue-300 text-xs mb-1">2. Alat Penegak Resmi:</p>
                            <p class="text-xs text-gray-300">Didukung oleh polisi, jaksa, dan pengadilan yang berhak menggunakan paksaan fisik sah.</p>
                        </div>
                        <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                            <p class="font-bold text-sky-400 text-xs mb-1">3. Kepastian Hukum:</p>
                            <p class="text-xs text-gray-300">Sanksi tertulis tegas (denda, kurungan) demi menjaga ketertiban umum.</p>
                        </div>
                    `
                }
            };

            const flashcardTabs = document.querySelectorAll('.flashcard-tab');
            const flashcardConceptTitle = document.getElementById('flashcardConceptTitle');
            const flashcardHint = document.getElementById('flashcardHint');
            const flashcardKeywordsContent = document.getElementById('flashcardKeywordsContent');
            const flashcardIndexBadge = document.getElementById('flashcardIndexBadge');

            flashcardTabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const cardNum = tab.getAttribute('data-card');
                    const d = cardsData[cardNum];
                    if (!d) return;

                    flashcardTabs.forEach(t => {
                        t.className = 'flashcard-tab px-3.5 py-1.5 rounded-full text-xs font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors';
                    });
                    tab.className = 'flashcard-tab active px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#0F172A] text-white transition-colors';

                    isFlipped = false;
                    flashcardInner.classList.remove('rotate-y-180');

                    flashcardIndexBadge.textContent = `Kartu ${cardNum} dari 3`;
                    flashcardConceptTitle.innerHTML = d.title;
                    flashcardHint.textContent = d.hint;
                    flashcardKeywordsContent.innerHTML = d.keywords;
                });
            });

            // Recording Simulator
            const startRecordingBtn = document.getElementById('startRecordingBtn');
            const recordBtnLabel = document.getElementById('recordBtnLabel');
            const recordingStatusText = document.getElementById('recordingStatusText');
            const recordingWaveform = document.getElementById('recordingWaveform');
            const recordingTimer = document.getElementById('recordingTimer');
            let isRecording = false;
            let recSeconds = 90;
            let recInterval = null;

            startRecordingBtn.addEventListener('click', () => {
                isRecording = !isRecording;
                if (isRecording) {
                    recordBtnLabel.textContent = "Hentikan & Simpan";
                    startRecordingBtn.classList.remove('bg-[#2563EB]', 'hover:bg-[#1D4ED8]');
                    startRecordingBtn.classList.add('bg-rose-600', 'hover:bg-rose-700');
                    recordingStatusText.innerHTML = "<span class='text-rose-600 font-bold'>● Merekam Suara...</span> Bicarakan pemahaman konsepmu dengan jelas.";
                    
                    const spans = recordingWaveform.querySelectorAll('span');
                    spans.forEach(s => s.classList.add('animate-wave-bar', 'bg-rose-500'));

                    recInterval = setInterval(() => {
                        recSeconds--;
                        if (recSeconds <= 0) {
                            clearInterval(recInterval);
                            stopRec();
                            return;
                        }
                        const m = Math.floor(recSeconds / 60).toString().padStart(2, '0');
                        const s = (recSeconds % 60).toString().padStart(2, '0');
                        recordingTimer.textContent = `${m}:${s}`;
                    }, 1000);
                } else {
                    stopRec();
                }
            });

            function stopRec() {
                isRecording = false;
                if (recInterval) clearInterval(recInterval);
                recordBtnLabel.textContent = "Mulai Rekam Penjelasan";
                startRecordingBtn.classList.add('bg-[#2563EB]', 'hover:bg-[#1D4ED8]');
                startRecordingBtn.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                recordingStatusText.innerHTML = "<span class='text-emerald-700 font-bold'>✓ Rekaman Tersimpan!</span> AI Evaluasi: Pemahaman konsep 94% sesuai rubrik sosiologi.";
                const spans = recordingWaveform.querySelectorAll('span');
                spans.forEach(s => {
                    s.classList.remove('animate-wave-bar', 'bg-rose-500');
                    s.classList.add('bg-emerald-500');
                });
            }

            // ==========================================================
            // 4. ZONA LATIHAN (INTERACTIVE QUIZ)
            // ==========================================================
            const quizQuestions = [
                {
                    topic: "Nilai Material vs Nilai Vital",
                    question: "Seorang pekerja bangunan membutuhkan helm pelindung dan sepatu keselamatan agar dapat bekerja tanpa bahaya fisik. Dalam klasifikasi nilai Prof. Notonagoro, helm tersebut paling tepat digolongkan sebagai...",
                    options: [
                        { key: "A", label: "Nilai Kerohanian" },
                        { key: "B", label: "Nilai Vital" },
                        { key: "C", label: "Nilai Estetika (Keindahan)" },
                        { key: "D", label: "Nilai Logika (Kebenaran)" }
                    ],
                    correct: "B",
                    explanation: "Nilai Vital adalah segala sesuatu yang berguna bagi manusia untuk dapat mengadakan kegiatan atau aktivitas secara optimal (contoh: helm kerja bagi tukang, cangkul bagi petani)."
                },
                {
                    topic: "Tingkatan Norma Sosial",
                    question: "Seseorang yang bersendawa dengan keras saat jamuan makan malam resmi akan dipandang kurang sopan dan mungkin ditegur oleh orang sekitarnya. Pelanggaran tersebut termasuk tingkatan norma...",
                    options: [
                        { key: "A", label: "Cara (Usage)" },
                        { key: "B", label: "Kebiasaan (Folkways)" },
                        { key: "C", label: "Tata Kelakuan (Mores)" },
                        { key: "D", label: "Adat Istiadat (Customs)" }
                    ],
                    correct: "A",
                    explanation: "Cara (Usage) memiliki daya ikat paling lemah, penyimpangannya hanya mendapat celaan atau cemoohan ringan."
                },
                {
                    topic: "Teori Sosiologi Emile Durkheim",
                    question: "Menurut Emile Durkheim, masyarakat modern terikat oleh solidaritas organik di mana keteraturan dijaga terutama oleh hukum yang bersifat...",
                    options: [
                        { key: "A", label: "Represif (Pembalasan dendam)" },
                        { key: "B", label: "Restitutif (Pemulihan keadaan)" },
                        { key: "C", label: "Sakral dan Magis" },
                        { key: "D", label: "Tradisional dan Tak Tertulis" }
                    ],
                    correct: "B",
                    explanation: "Hukum restitutif bertujuan memulihkan kembali keseimbangan hak dan kewajiban dalam pembagian kerja masyarakat modern."
                },
                {
                    topic: "Internalisasi Nilai",
                    question: "Proses ketika seorang anak menyerap nilai kejujuran dari orang tuanya sehingga ia merasa tidak nyaman jika berbohong disebut...",
                    options: [
                        { key: "A", label: "Difusi Nilai" },
                        { key: "B", label: "Asimilasi Nilai" },
                        { key: "C", label: "Internalisasi Nilai" },
                        { key: "D", label: "Akulturasi Nilai" }
                    ],
                    correct: "C",
                    explanation: "Internalisasi adalah proses penanaman nilai dan norma secara mendalam hingga menjadi bagian dari kesadaran batiniah individu."
                },
                {
                    topic: "Norma Hukum & Sanksi",
                    question: "Ciri paling mendasar yang membedakan norma hukum dari ketiga norma lainnya (agama, kesusilaan, kesopanan) adalah...",
                    options: [
                        { key: "A", label: "Hanya berlaku untuk kalangan pejabat" },
                        { key: "B", label: "Dibuat oleh lembaga resmi dan memiliki sanksi tegas memaksa" },
                        { key: "C", label: "Tidak memerlukan kepatuhan warga" },
                        { key: "D", label: "Berasal dari bisikan hati nurani murni" }
                    ],
                    correct: "B",
                    explanation: "Norma hukum diformalkan oleh lembaga negara dan ditegakkan dengan sanksi nyata oleh aparatur yang berwenang."
                }
            ];

            let currentQuizIndex = 0;
            let currentScore = 0;
            let answered = false;

            const quizQuestionCountBadge = document.getElementById('quizQuestionCountBadge');
            const quizTopicBadge = document.getElementById('quizTopicBadge');
            const quizQuestionText = document.getElementById('quizQuestionText');
            const quizOptionsContainer = document.getElementById('quizOptionsContainer');
            const quizExplanationBox = document.getElementById('quizExplanationBox');
            const quizNextBtn = document.getElementById('quizNextBtn');
            const quizScoreText = document.getElementById('quizScoreText');

            function renderQuiz(index) {
                const q = quizQuestions[index];
                answered = false;
                quizExplanationBox.classList.add('hidden');
                quizQuestionCountBadge.textContent = `Soal ${index + 1} dari ${quizQuestions.length}`;
                quizTopicBadge.textContent = `Topik: ${q.topic}`;
                quizQuestionText.textContent = q.question;

                quizOptionsContainer.innerHTML = '';
                q.options.forEach(opt => {
                    const optEl = document.createElement('div');
                    optEl.setAttribute('data-option', opt.key);
                    optEl.className = 'quiz-option cursor-pointer p-4 rounded-2xl border border-gray-200 bg-white hover:border-gray-300 hover:bg-gray-50/70 transition-all flex items-center justify-between group';
                    optEl.innerHTML = `
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-gray-100 text-gray-700 font-bold text-xs flex items-center justify-center group-hover:bg-gray-200">
                                ${opt.key}
                            </span>
                            <span class="text-sm font-semibold text-gray-800 option-label">${opt.label}</span>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-gray-400 flex items-center justify-center option-radio">
                            <div class="w-2.5 h-2.5 rounded-full bg-transparent"></div>
                        </div>
                    `;

                    optEl.addEventListener('click', () => {
                        if (answered) return;
                        answered = true;
                        const isCorrect = (opt.key === q.correct);

                        if (isCorrect) {
                            currentScore += 20;
                            quizScoreText.textContent = currentScore;
                            optEl.classList.remove('border-gray-200', 'bg-white');
                            optEl.classList.add('border-emerald-500', 'bg-emerald-50/80');
                            const radio = optEl.querySelector('.option-radio');
                            radio.classList.add('border-emerald-500', 'bg-emerald-500');
                            radio.innerHTML = '<span class="text-white text-xs">✓</span>';
                            playSoundBeep(640, 0.15);
                        } else {
                            optEl.classList.remove('border-gray-200', 'bg-white');
                            optEl.classList.add('border-rose-400', 'bg-rose-50/80');
                            const radio = optEl.querySelector('.option-radio');
                            radio.classList.add('border-rose-500', 'bg-rose-500');
                            radio.innerHTML = '<span class="text-white text-xs">✕</span>';

                            // Highlight correct one
                            const correctEl = quizOptionsContainer.querySelector(`[data-option="${q.correct}"]`);
                            if (correctEl) {
                                correctEl.classList.add('border-emerald-500', 'bg-emerald-50/80');
                                const cRadio = correctEl.querySelector('.option-radio');
                                cRadio.classList.add('border-emerald-500', 'bg-emerald-500');
                                cRadio.innerHTML = '<span class="text-white text-xs">✓</span>';
                            }
                            playSoundBeep(260, 0.2);
                        }

                        // Show explanation
                        quizExplanationBox.innerHTML = `<span class="font-bold">Penjelasan:</span> ${q.explanation}`;
                        quizExplanationBox.classList.remove('hidden');
                    });

                    quizOptionsContainer.appendChild(optEl);
                });
            }

            quizNextBtn.addEventListener('click', () => {
                if (currentQuizIndex < quizQuestions.length - 1) {
                    currentQuizIndex++;
                    renderQuiz(currentQuizIndex);
                    playSoundBeep(500, 0.08);
                } else {
                    alert(`Selamat! Anda telah menyelesaikan seluruh sesi kuis dengan skor akhir: ${currentScore} / 100.`);
                    currentQuizIndex = 0;
                    currentScore = 0;
                    quizScoreText.textContent = '0';
                    renderQuiz(0);
                }
            });

            // Tab mode switcher
            const modeTabs = [
                document.getElementById('modeTab1'),
                document.getElementById('modeTab2'),
                document.getElementById('modeTab3')
            ];

            modeTabs.forEach((tab, i) => {
                tab.addEventListener('click', () => {
                    modeTabs.forEach(t => {
                        t.className = 'quiz-mode-tab px-5 py-2.5 rounded-full text-xs sm:text-sm font-medium bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition-all';
                    });
                    tab.className = 'quiz-mode-tab active px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold bg-[#0F172A] text-white flex items-center gap-2 shadow-sm transition-all';
                    playSoundBeep(420, 0.06);

                    if (i === 0) {
                        currentQuizIndex = 0;
                        renderQuiz(0);
                    } else if (i === 1) {
                        quizQuestionCountBadge.textContent = "Kasus Viral 1";
                        quizTopicBadge.textContent = "Fenomena Live TikTok Meminta Hadiah";
                        quizQuestionText.textContent = "Fenomena siaran langsung di media sosial yang mengeksploitasi lansia demi hadiah virtual telah memicu keresahan publik. Berdasarkan sudut pandang norma, fenomena tersebut bertentangan dengan norma apa?";
                        quizExplanationBox.classList.add('hidden');
                    } else {
                        quizQuestionCountBadge.textContent = "Puzzle Sorter 1";
                        quizTopicBadge.textContent = "Kategori Norma Sosial";
                        quizQuestionText.textContent = "Cocokkan skenario berikut: 'Pengendara motor ditilang karena tidak menyalakan lampu utama di siang hari.' Termasuk dalam pilar norma apa?";
                        quizExplanationBox.classList.add('hidden');
                    }
                });
            });

        });
    </script>
</body>
</html>
