<x-dashboard-layout title="Ruang Materi" active="materi">

    @php
        $prev = $currentIndex > 0 ? $siblings[$currentIndex - 1] : null;
        $next = $currentIndex < $siblings->count() - 1 ? $siblings[$currentIndex + 1] : null;
    @endphp

    <!-- Breadcrumbs / Back to Materi List -->
    <div class="flex items-center gap-2 text-xs font-semibold text-gray-500">
        <a href="{{ route('materi.index') }}" class="inline-flex items-center gap-1.5 hover:text-blue-600 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Materi</span>
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-800 font-bold truncate">{{ $materi->title }}</span>
    </div>

    <!-- Main White Card Container -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 sm:p-8 space-y-7">

        <!-- Header Row: Title, Audio Badge & Read State -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">
                {{ $currentIndex + 1 }}. {{ $materi->title }}
            </h2>

            <div class="self-start sm:self-auto flex items-center gap-2">
                @if ($isRead)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Sudah dibaca ✓
                    </span>
                @else
                    <form method="POST" action="{{ route('materi.markRead', ['slug' => $materi->slug]) }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold hover:bg-blue-100 transition-colors cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Tandai sudah dibaca
                        </button>
                    </form>
                @endif

                @if ($materi->audio_path)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Audio Tersedia
                    </span>
                @endif
            </div>
        </div>

        <!-- Row 1: Penjelasan Paragraf (Kiri) & Pesan Inti Box (Kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            <!-- Kiri: Uraian Penjelasan Singkat -->
            <div class="lg:col-span-7 space-y-3.5 text-sm sm:text-[15px] text-gray-700 leading-relaxed flex flex-col justify-center">
                @foreach (explode("\n\n", $materi->body) as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            <!-- Kanan: Green Card "PESAN INTI" -->
            <div class="lg:col-span-5 bg-gradient-to-br from-blue-600 to-[#1D4ED8] text-white rounded-2xl p-6 relative overflow-hidden shadow-sm flex flex-col justify-center min-h-[170px]">
                <!-- Subtle decorative circle in bottom right -->
                <div class="pointer-events-none absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-white/10 blur-xs"></div>

                <div>
                    <!-- Tag PESAN INTI -->
                    <span class="inline-block px-2 py-0.5 rounded bg-white/20 text-white font-extrabold text-[10px] uppercase tracking-wider">
                        PESAN INTI
                    </span>

                    <!-- Quote Italic -->
                    <p class="italic text-sm sm:text-[15px] font-medium text-white/95 mt-3 leading-relaxed">
                        {{ $materi->quote }}
                    </p>
                </div>
            </div>

        </div>

        <!-- Row 2: Pemutar Audio Penjelasan Guru -->
        @if ($materi->audio_path)
            <div class="p-4 sm:p-5 rounded-2xl bg-[#F8FAFC] border border-slate-200/80 space-y-3">

                <!-- Player Header: Title & Speed -->
                <div class="flex items-center justify-between text-xs">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        <span class="font-bold uppercase tracking-wider text-gray-600 text-[11px]">
                            PEMUTAR AUDIO PENJELASAN GURU
                        </span>
                    </div>

                    <button id="audioSpeedBtn" type="button" class="px-2 py-0.5 rounded-md bg-white border border-gray-200 font-bold text-gray-700 hover:bg-gray-50 transition-colors text-xs shadow-2xs">
                        <span id="audioSpeedText">1.0x</span>
                    </button>
                </div>

                <!-- Native Audio Player -->
                <audio id="materiAudio" controls preload="none" class="w-full" src="{{ asset('storage/' . $materi->audio_path) }}"></audio>

                <p class="text-xs text-gray-500 font-medium">
                    Durasi total: {{ $materi->formattedDuration() }}
                </p>
            </div>
        @else
            <div class="p-4 sm:p-5 rounded-2xl bg-[#F8FAFC] border border-slate-200/80 flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/></svg>
                </span>
                <span class="text-xs font-semibold text-gray-500">
                    Audio belum tersedia — guru sedang menyiapkan narasi
                </span>
            </div>
        @endif

        <!-- Row 3: 2 Summary Cards (CIRI UTAMA NORMA & FUNGSI POKOK) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <!-- Card 1: Ciri Utama Norma -->
            <div class="bg-[#F8FAFC] rounded-2xl p-4 sm:p-5 border border-slate-200/70 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-xs shrink-0">
                        <svg class="w-3.5 h-3.5 font-extrabold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <h4 class="font-extrabold text-xs text-gray-900 uppercase tracking-wider">
                        CIRI UTAMA NORMA
                    </h4>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed pl-8">
                    Diterima secara sosial, memiliki sanksi jika dilanggar, serta bersifat dinamis menyesuaikan peradaban masyarakat.
                </p>
            </div>

            <!-- Card 2: Fungsi Pokok -->
            <div class="bg-[#F8FAFC] rounded-2xl p-4 sm:p-5 border border-slate-200/70 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs shrink-0">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </span>
                    <h4 class="font-extrabold text-xs text-gray-900 uppercase tracking-wider">
                        FUNGSI POKOK
                    </h4>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed pl-8">
                    Membatasi perilaku egois, mewujudkan keadilan, serta menciptakan rasa aman bagi seluruh anggota kelompok sosial.
                </p>
            </div>

        </div>

        <!-- Row 4: Bottom Navigation (Sebelumnya & Lanjut) -->
        <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-3">

            <!-- Tombol Sebelumnya -->
            @if ($prev)
                <a href="{{ route('materi.show', $prev->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 hover:border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-xs transition-colors shadow-2xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    <span>Sebelumnya</span>
                </a>
            @else
                <button disabled class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200/60 bg-gray-50 text-gray-300 font-semibold text-xs cursor-not-allowed">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    <span>Sebelumnya</span>
                </button>
            @endif

            <!-- Indikator Posisi -->
            <span class="text-xs text-gray-400 font-medium">
                Materi {{ $currentIndex + 1 }} dari {{ $siblings->count() }}
            </span>

            <!-- Tombol Lanjut -->
            @if ($next)
                <a href="{{ route('materi.show', $next->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/20 transition-all duration-200">
                    <span>Lanjut ke materi berikutnya →</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <button disabled class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gray-100 text-gray-400 font-bold text-xs cursor-not-allowed">
                    <span>Lanjut ke materi berikutnya →</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            @endif

        </div>

    </div>

    @if ($materi->audio_path)
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const audio = document.getElementById('materiAudio');
                    const speedBtn = document.getElementById('audioSpeedBtn');
                    const speedText = document.getElementById('audioSpeedText');

                    if (!audio || !speedBtn) {
                        return;
                    }

                    const speeds = [1.0, 1.25, 1.5];
                    const labels = ['1.0x', '1.25x', '1.5x'];
                    let speedIndex = 0;

                    speedBtn.addEventListener('click', () => {
                        speedIndex = (speedIndex + 1) % speeds.length;
                        audio.playbackRate = speeds[speedIndex];
                        speedText.innerText = labels[speedIndex];
                    });
                });
            </script>
        @endpush
    @endif

</x-dashboard-layout>
