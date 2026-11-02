<x-admin-layout title="Dashboard" active="dashboard">
    <div>
        <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">Dashboard Guru</h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">Ringkasan aktivitas belajar siswa dan materi pembelajaran.</p>
    </div>

    @if (session('status'))
        <div class="rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200/80 px-4 py-3 text-sm font-bold">
            {{ session('status') }}
        </div>
    @endif

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Siswa</p>
                    <p class="text-2xl font-extrabold text-gray-900 leading-tight">{{ $totalSiswa }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">{{ $activeStudents }} siswa aktif mengerjakan fitur</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Materi</p>
                    <p class="text-2xl font-extrabold text-gray-900 leading-tight">{{ $totalMateri }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">{{ $materiWithoutAudio }} materi belum ada audio</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Menunggu Review</p>
                    <p class="text-2xl font-extrabold text-gray-900 leading-tight">{{ $pendingRecordings }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">{{ $totalRecordings }} rekaman hafalan terkirim</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Rata-rata Quiz</p>
                    <p class="text-2xl font-extrabold text-gray-900 leading-tight">{{ $avgQuiz }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">Skor rata-rata pasangan quiz</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Rata-rata Soal PG</p>
                    <p class="text-2xl font-extrabold text-gray-900 leading-tight">{{ $avgMcq }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">Skor rata-rata soal pilihan ganda</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Rekaman Diterima</p>
                    <p class="text-2xl font-extrabold text-gray-900 leading-tight">{{ $recordingsByStatus['diterima'] ?? 0 }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-3 pt-3 border-t border-gray-100">
                {{ $recordingsByStatus['perlu_percobaan'] ?? 0 }} perlu percobaan ulang
            </p>
        </div>
    </div>

    {{-- Materi tanpa audio --}}
    @if ($materiWithoutAudio > 0)
        <div class="rounded-2xl bg-amber-50 border border-amber-200/80 p-5 flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.74-3L13.74 4a2 2 0 00-3.48 0L3.34 16a2 2 0 001.73 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-amber-800">{{ $materiWithoutAudio }} materi belum memiliki audio penjelasan</p>
                    <p class="text-xs text-amber-700 mt-0.5">Segera unggah audio agar siswa dapat mendengarkan penjelasan.</p>
                </div>
            </div>
            <a href="{{ route('admin.materi.index') }}" class="shrink-0 inline-flex justify-center items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors">
                Kelola Materi
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        {{-- Rekaman terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
            <div class="flex items-center justify-between gap-3 mb-4">
                <div>
                    <h3 class="text-base font-extrabold text-gray-900">Rekaman terbaru</h3>
                    <p class="text-xs text-gray-500">Lima setor hafalan yang terakhir dikirim siswa.</p>
                </div>
                <a href="{{ route('admin.hafalan.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700">Lihat semua →</a>
            </div>

            @if ($recentRecordings->isEmpty())
                <p class="text-sm text-gray-500 py-6 text-center">Belum ada rekaman hafalan yang masuk.</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach ($recentRecordings as $recording)
                        <li class="py-3 flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ $recording->user->name ?? 'Siswa' }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $recording->conceptCard->name ?? '—' }} · {{ $recording->created_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                            </div>
                            @php
                                $badgeClass = match ($recording->status) {
                                    'diterima' => 'bg-emerald-50 text-emerald-700',
                                    'perlu_percobaan' => 'bg-rose-50 text-rose-700',
                                    default => 'bg-amber-50 text-amber-700',
                                };
                            @endphp
                            <span class="shrink-0 self-start sm:self-center px-2.5 py-1 rounded-md text-[11px] font-extrabold uppercase tracking-wider {{ $badgeClass }}">
                                {{ $recording->statusLabel() }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Distribusi status rekaman --}}
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
            <h3 class="text-base font-extrabold text-gray-900">Status rekaman</h3>
            <p class="text-xs text-gray-500 mb-4">Sebaran hasil review setor hafalan.</p>

            @php
                $statusLabels = [
                    'menunggu' => ['Menunggu Review', 'bg-amber-500'],
                    'diterima' => ['Diterima', 'bg-emerald-500'],
                    'perlu_percobaan' => ['Perlu Percobaan', 'bg-rose-500'],
                ];
            @endphp

            <ul class="space-y-3">
                @foreach ($statusLabels as $key => [$label, $color])
                    @php $count = $recordingsByStatus[$key] ?? 0; @endphp
                    <li class="flex items-center justify-between gap-3 text-sm">
                        <span class="flex items-center gap-2 text-gray-600 font-medium">
                            <span class="w-2.5 h-2.5 rounded-full {{ $color }}"></span>
                            {{ $label }}
                        </span>
                        <span class="font-extrabold text-gray-900">{{ $count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-admin-layout>
