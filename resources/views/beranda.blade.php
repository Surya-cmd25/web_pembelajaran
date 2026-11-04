<x-dashboard-layout title="Dashboard Siswa" active="beranda">

    @php
        $userName = Auth::user() ? explode(' ', Auth::user()->name)[0] : 'Siswa';

        $nextLinks = [
            'materi' => ['url' => route('materi.index'), 'label' => 'Ruang Materi →'],
            'hafalan' => ['url' => route('setor-hafalan'), 'label' => 'Setor Hafalan →'],
            'galeri' => ['url' => route('galeri-norma'), 'label' => 'Galeri 4 Norma →'],
            'quiz' => ['url' => route('quiz'), 'label' => 'Quiz Mencocokkan →'],
            'soal' => ['url' => route('soal'), 'label' => 'Soal Pilihan Ganda →'],
            'puzzle' => ['url' => route('puzzle'), 'label' => 'Puzzle →'],
        ];

        $hafalanBadge = $pendingRecordings > 0
            ? ['text' => 'MENUNGGU REVIEW', 'class' => 'bg-amber-50 text-amber-700']
            : ($statuses['hafalan']
                ? ['text' => 'SUDAH DISETOR', 'class' => 'bg-emerald-50 text-emerald-700']
                : ['text' => 'PERLU REKAMAN', 'class' => 'bg-amber-50 text-amber-700']);
    @endphp

    <!-- ====================================================== -->
    <!-- SECTION 1: HERO CARD (BLUE BANNER)                     -->
    <!-- ====================================================== -->
    <section class="rounded-3xl bg-[#2563EB] text-white p-6 sm:p-8 lg:p-9 shadow-xl shadow-blue-600/15 relative overflow-hidden flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        <!-- Decorative subtle circles -->
        <div class="pointer-events-none absolute -right-16 -top-16 w-64 h-64 rounded-full bg-white/10 blur-2xl"></div>
        <div class="pointer-events-none absolute left-1/3 -bottom-20 w-80 h-80 rounded-full bg-blue-700/50 blur-3xl"></div>

        <!-- Left Content -->
        <div class="space-y-3.5 z-10 max-w-2xl">
            <!-- Target Belajar Minggu Ini Badge -->
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-semibold">
                <span>🎖️</span> Target Belajar Minggu Ini
            </span>

            <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-extrabold tracking-tight leading-snug">
                Selamat datang, {{ $userName }}! 👋
            </h2>

            <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                Yuk lanjutkan perjalanan belajarmu tentang norma sosial! "Norma baik membentuk masyarakat yang lebih harmonis."
            </p>
        </div>

        <!-- Right Progres Pembelajaran Card -->
        <div class="w-full lg:w-88 bg-white rounded-2xl p-5 text-gray-900 shadow-md shrink-0 z-10">
            <div class="flex items-center justify-between">
                <span class="text-xs font-extrabold uppercase tracking-wider text-blue-600">
                    PROGRES PEMBELAJARAN
                </span>
                <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 font-extrabold text-xs">
                    {{ $percent }}%
                </span>
            </div>

            <h3 class="text-sm font-bold text-gray-900 mt-2.5">
                {{ $doneCount }} dari {{ $totalActivities }} aktivitas selesai
            </h3>

            <!-- Progress bar -->
            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden mt-2.5">
                <div class="bg-blue-600 h-full rounded-full transition-all duration-700" style="width: {{ $percent }}%;"></div>
            </div>

            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-gray-500">Langkah selanjutnya:</span>
                @if ($nextFeature && isset($nextLinks[$nextFeature]))
                    <a href="{{ $nextLinks[$nextFeature]['url'] }}" class="font-bold text-blue-600 hover:text-blue-700 transition-colors">
                        {{ $nextLinks[$nextFeature]['label'] }}
                    </a>
                @else
                    <span class="font-bold text-emerald-600">Semua aktivitas selesai 🎉</span>
                @endif
            </div>
        </div>
    </section>


    <!-- ====================================================== -->
    <!-- SECTION 2: AYO MULAI BELAJAR! (6 MODUL KARTU)          -->
    <!-- ====================================================== -->
    <section class="space-y-4">

        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">
                    Ayo Mulai Belajar!
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">
                    Pilih modul materi, kuis interaktif, atau tantangan seru berikut.
                </p>
            </div>

            <!-- 6 Modul Tersedia Badge -->
            <span class="self-start sm:self-auto px-3.5 py-1 rounded-full border border-gray-200 bg-white text-gray-600 text-xs font-semibold shadow-2xs">
                6 Modul Tersedia
            </span>
        </div>

        <!-- 6 Modul Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            <!-- 1. Ruang Materi -->
            <div id="ruang-materi" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-5 flex flex-col justify-between transition-all duration-200 group">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <!-- Blue Book Icon -->
                        <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        @if ($statuses['materi'])
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold uppercase tracking-wider">
                                SELESAI DIBACA
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 text-[10px] font-extrabold uppercase tracking-wider">
                                BELUM DIBACA
                            </span>
                        @endif
                    </div>

                    <h3 class="text-base font-extrabold text-gray-900 mt-4 group-hover:text-blue-600 transition-colors">
                        Ruang Materi
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Pelajari konsep dasar nilai dan norma sosial dengan ringkas.
                    </p>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">{{ $materiCount }} Sub-topik Audio</span>
                    <a href="{{ route('materi.index') }}" class="font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                        Buka →
                    </a>
                </div>
            </div>

            <!-- 2. Setor Hafalan -->
            <div id="setor-hafalan" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-5 flex flex-col justify-between transition-all duration-200 group">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <!-- Amber Microphone Icon -->
                        <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                            </svg>
                        </div>
                        <span class="px-2 py-0.5 rounded-md {{ $hafalanBadge['class'] }} text-[10px] font-extrabold uppercase tracking-wider">
                            {{ $hafalanBadge['text'] }}
                        </span>
                    </div>

                    <h3 class="text-base font-extrabold text-gray-900 mt-4 group-hover:text-amber-600 transition-colors">
                        Setor Hafalan
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Latih pemahamanmu dengan 8 kartu konsep dan rekam suaramu.
                    </p>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">Maksimal 3 Menit</span>
                    <a href="{{ route('setor-hafalan') }}" class="font-bold text-amber-600 hover:text-amber-700 flex items-center gap-1 transition-colors">
                        Rekam →
                    </a>
                </div>
            </div>

            <!-- 3. Galeri Empat Norma -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-5 flex flex-col justify-between transition-all duration-200 group">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <!-- Emerald Gallery Icon -->
                        <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @if ($statuses['galeri'])
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold uppercase tracking-wider">
                                SELESAI
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 text-[10px] font-extrabold uppercase tracking-wider">
                                REKOMENDASI
                            </span>
                        @endif
                    </div>

                    <h3 class="text-base font-extrabold text-gray-900 mt-4 group-hover:text-emerald-600 transition-colors">
                        Galeri Empat Norma
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Jelajahi contoh penerapan nyata norma dalam kehidupan sehari-hari.
                    </p>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">Agama, Susila, Sopan, Hukum</span>
                    <a href="{{ route('galeri-norma') }}" class="font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 transition-colors">
                        Eksplor →
                    </a>
                </div>
            </div>

            <!-- 4. Quiz Mencocokkan -->
            <div id="quiz-mencocokkan" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-5 flex flex-col justify-between transition-all duration-200 group">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <!-- Orange Arrows Swap Icon -->
                        <div class="w-11 h-11 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </div>
                        @if ($statuses['quiz'])
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold uppercase tracking-wider">
                                SELESAI
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-md bg-orange-50 text-orange-700 text-[10px] font-extrabold uppercase tracking-wider">
                                GAME INTERAKTIF
                            </span>
                        @endif
                    </div>

                    <h3 class="text-base font-extrabold text-gray-900 mt-4 group-hover:text-orange-600 transition-colors">
                        Quiz Mencocokkan
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Hubungkan peristiwa dengan jenis norma yang sesuai per ronde.
                    </p>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">3 Pasangan Per Ronde</span>
                    <a href="{{ route('quiz') }}" class="font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 transition-colors">
                        Main →
                    </a>
                </div>
            </div>

            <!-- 5. Soal Pilihan Ganda -->
            <div id="soal-pilihan-ganda" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-5 flex flex-col justify-between transition-all duration-200 group">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <!-- Purple Check / Question Icon -->
                        <div class="w-11 h-11 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        @if ($statuses['soal'])
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold uppercase tracking-wider">
                                SELESAI
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 text-[10px] font-extrabold uppercase tracking-wider">
                                EVALUASI
                            </span>
                        @endif
                    </div>

                    <h3 class="text-base font-extrabold text-gray-900 mt-4 group-hover:text-purple-600 transition-colors">
                        Soal Pilihan Ganda
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Uji pemahamanmu berdasarkan studi kasus dan situasi konkrit.
                    </p>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">10 Butir Pertanyaan</span>
                    <a href="{{ route('soal') }}" class="font-bold text-purple-600 hover:text-purple-700 flex items-center gap-1 transition-colors">
                        Mulai →
                    </a>
                </div>
            </div>

            <!-- 6. Puzzle -->
            <div id="puzzle" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-5 flex flex-col justify-between transition-all duration-200 group">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <!-- Rose Puzzle Piece Icon -->
                        <div class="w-11 h-11 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                            </svg>
                        </div>
                        @if ($statuses['puzzle'])
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold uppercase tracking-wider">
                                SELESAI
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-md bg-rose-50 text-rose-700 text-[10px] font-extrabold uppercase tracking-wider">
                                TANTANGAN LOGIKA
                            </span>
                        @endif
                    </div>

                    <h3 class="text-base font-extrabold text-gray-900 mt-4 group-hover:text-rose-600 transition-colors">
                        Puzzle
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Susun 10 keping puzzle untuk mengungkap tokoh sosiologi nilai dan norma.
                    </p>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">Level 3 Tersedia</span>
                    <a href="{{ route('puzzle') }}" class="font-bold text-rose-600 hover:text-rose-700 flex items-center gap-1 transition-colors">
                        Susun →
                    </a>
                </div>
            </div>

        </div>
    </section>


    <!-- ====================================================== -->
    <!-- SECTION 3: PREVIEW GALERI: EMPAT PILAR NORMA SOSIAL    -->
    <!-- ====================================================== -->
    <section id="galeri-norma" class="space-y-4">

        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">
                    Preview Galeri: Empat Pilar Norma Sosial
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">
                    Sentuh salah satu kartu norma di bawah ini untuk melihat contoh konkret dan sanksinya.
                </p>
            </div>

            <!-- Lihat Modul Penuh Button -->
            <a href="{{ route('galeri-norma') }}" class="self-start sm:self-auto inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-blue-200 bg-blue-50/60 hover:bg-blue-100/70 text-blue-600 font-bold text-xs transition-colors">
                <span>Lihat Modul Penuh</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <!-- 4 Columns Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <!-- 1. Norma Agama (Light Blue Banner) -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-4 flex flex-col justify-between transition-all duration-200">
                <div>
                    <!-- Visual Banner Box -->
                    <div class="bg-[#DCEBFE] rounded-xl py-6 px-4 flex flex-col items-center justify-center text-center">
                        <span class="text-3xl select-none">🕌⛪</span>
                        <span class="text-xs font-bold text-gray-800 mt-2">Ibadah &amp; Doa</span>
                    </div>

                    <h3 class="text-sm font-extrabold text-gray-900 mt-3.5">
                        Norma Agama
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Aturan yang bersumber dari wahyu Tuhan Yang Maha Esa. Sanksi bersifat batiniah dan akhirat.
                    </p>
                </div>

                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="font-medium text-blue-600">Contoh: Toleransi</span>
                    <button onclick="openModalNorma('agama')" class="font-bold text-blue-600 hover:underline">
                        Detail
                    </button>
                </div>
            </div>

            <!-- 2. Norma Kesusilaan (Light Pink Banner) -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-4 flex flex-col justify-between transition-all duration-200">
                <div>
                    <!-- Visual Banner Box -->
                    <div class="bg-[#FFE4E8] rounded-xl py-6 px-4 flex flex-col items-center justify-center text-center">
                        <span class="text-3xl select-none">❤️🤝</span>
                        <span class="text-xs font-bold text-gray-800 mt-2">Hati Nurani</span>
                    </div>

                    <h3 class="text-sm font-extrabold text-gray-900 mt-3.5">
                        Norma Kesusilaan
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Aturan yang bersumber dari hati sanubari dan moral manusia untuk membedakan baik dan buruk.
                    </p>
                </div>

                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="font-medium text-rose-600">Contoh: Kejujuran</span>
                    <button onclick="openModalNorma('susila')" class="font-bold text-blue-600 hover:underline">
                        Detail
                    </button>
                </div>
            </div>

            <!-- 3. Norma Kesopanan (Light Mint Banner) -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-4 flex flex-col justify-between transition-all duration-200">
                <div>
                    <!-- Visual Banner Box -->
                    <div class="bg-[#D1FAE5] rounded-xl py-6 px-4 flex flex-col items-center justify-center text-center">
                        <span class="text-3xl select-none">🗣️🙇‍♂️</span>
                        <span class="text-xs font-bold text-gray-800 mt-2">Tata Krama</span>
                    </div>

                    <h3 class="text-sm font-extrabold text-gray-900 mt-3.5">
                        Norma Kesopanan
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Peraturan hidup yang timbul dari hasil pergaulan segolongan manusia. Bersumber dari adat istiadat.
                    </p>
                </div>

                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="font-medium text-emerald-600">Contoh: Salim Guru</span>
                    <button onclick="openModalNorma('sopan')" class="font-bold text-blue-600 hover:underline">
                        Detail
                    </button>
                </div>
            </div>

            <!-- 4. Norma Hukum (Light Amber Banner) -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-4 flex flex-col justify-between transition-all duration-200">
                <div>
                    <!-- Visual Banner Box -->
                    <div class="bg-[#FEF3C7] rounded-xl py-6 px-4 flex flex-col items-center justify-center text-center">
                        <span class="text-3xl select-none">⚖️📜</span>
                        <span class="text-xs font-bold text-gray-800 mt-2">Hukum Negara</span>
                    </div>

                    <h3 class="text-sm font-extrabold text-gray-900 mt-3.5">
                        Norma Hukum
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        Aturan tegas dan mengikat yang dibuat oleh lembaga berwenang (negara) dengan sanksi nyata.
                    </p>
                </div>

                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="font-medium text-amber-600">Contoh: Tertib Lalu Lintas</span>
                    <button onclick="openModalNorma('hukum')" class="font-bold text-blue-600 hover:underline">
                        Detail
                    </button>
                </div>
            </div>

        </div>
    </section>


    <!-- ============================================================== -->
    <!-- INTERACTIVE MODAL DETAIL NORMA                                 -->
    <!-- ============================================================== -->
    <div id="normaDetailModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-xs items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-gray-200 space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-3">
                    <span id="modalNormaEmoji" class="text-2xl p-2 rounded-xl bg-gray-50">🕌</span>
                    <div>
                        <h3 id="modalNormaTitle" class="text-base font-extrabold text-gray-900">Norma Agama</h3>
                        <span id="modalNormaCategory" class="text-[11px] font-semibold text-blue-600">Pilar 1</span>
                    </div>
                </div>
                <button onclick="closeModalNorma()" class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 hover:text-gray-700 flex items-center justify-center font-bold">✕</button>
            </div>

            <div class="space-y-3 text-xs sm:text-sm text-gray-700 leading-relaxed">
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="font-bold text-gray-900 block text-xs">Sumber &amp; Daya Ikat:</span>
                    <p id="modalNormaSource" class="text-gray-600 mt-0.5">Wahyu Tuhan Yang Maha Esa dan Kitab Suci.</p>
                </div>
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="font-bold text-gray-900 block text-xs">Sifat Sanksi:</span>
                    <p id="modalNormaSanction" class="text-gray-600 mt-0.5">Batiniah, penyesalan mendalam, dan pembalasan di akhirat.</p>
                </div>
                <div class="p-3.5 rounded-xl bg-blue-50/70 border border-blue-100">
                    <span class="font-bold text-blue-900 block text-xs">Contoh Penerapan Konkret:</span>
                    <p id="modalNormaExample" class="text-blue-800 mt-0.5">Saling menghormati saat pemeluk agama lain beribadah, menjalankan ajaran kebaikan, dan menjaga toleransi antarumat beragama.</p>
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button onclick="closeModalNorma()" class="px-5 py-2.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md transition-all">
                    Tutup Detail
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Data Norma Detail
            const normaData = {
                agama: {
                    title: 'Norma Agama',
                    category: 'Pilar 1 • Spiritual & Ketuhanan',
                    emoji: '🕌⛪',
                    source: 'Wahyu Tuhan Yang Maha Esa yang tertuang dalam Kitab Suci.',
                    sanction: 'Sifat sanksi bersifat batiniah, rasa bersalah mendalam, dan pembalasan kelak di akhirat.',
                    example: 'Menjalankan ibadah tepat waktu, tidak memaksakan keyakinan, dan menghormati perayaan hari besar agama lain.'
                },
                susila: {
                    title: 'Norma Kesusilaan',
                    category: 'Pilar 2 • Moral & Hati Nurani',
                    emoji: '❤️🤝',
                    source: 'Hati sanubari dan suara nurani manusia yang membedakan perbuatan baik dan jahat.',
                    sanction: 'Penyesalan batin, rasa malu terhadap diri sendiri, kegelisahan hati, dan pengucilan moral.',
                    example: 'Tidak menyontek saat ujian, mengembalikan dompet orang asing yang terjatuh di jalan, dan berlaku jujur.'
                },
                sopan: {
                    title: 'Norma Kesopanan',
                    category: 'Pilar 3 • Adat Pergaulan Masyarakat',
                    emoji: '🗣️🙇‍♂️',
                    source: 'Kebiasaan dan tata pergaulan hidup yang disepakati oleh kelompok masyarakat tertentu.',
                    sanction: 'Cemoohan, celaan lisan, teguran sosial, atau dikucilkan dari pergaulan sehari-hari.',
                    example: 'Menyapa atau mencium tangan guru saat berpapasan, tidak makan sambil berdiri atau berbicara, dan bertutur kata santun.'
                },
                hukum: {
                    title: 'Norma Hukum',
                    category: 'Pilar 4 • Hukum Positif Negara',
                    emoji: '⚖️📜',
                    source: 'Peraturan resmi tertulis yang dibuat oleh lembaga berwenang (Pemerintah/DPR) dengan aparat penegak.',
                    sanction: 'Tegas, nyata, mengikat semua orang, berupa denda finansial, kurungan penjara, hingga hukuman pidana.',
                    example: 'Memakai helm SNI dan memiliki SIM saat berkendara, membayar pajak tepat waktu, dan tidak melakukan pencurian.'
                }
            };

            function openModalNorma(key) {
                const data = normaData[key];
                if (!data) return;
                document.getElementById('modalNormaTitle').innerText = data.title;
                document.getElementById('modalNormaCategory').innerText = data.category;
                document.getElementById('modalNormaEmoji').innerText = data.emoji;
                document.getElementById('modalNormaSource').innerText = data.source;
                document.getElementById('modalNormaSanction').innerText = data.sanction;
                document.getElementById('modalNormaExample').innerText = data.example;

                const modal = document.getElementById('normaDetailModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeModalNorma() {
                const modal = document.getElementById('normaDetailModal');
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                }
            }

            // Close on escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModalNorma();
            });
        </script>
    @endpush

</x-dashboard-layout>
