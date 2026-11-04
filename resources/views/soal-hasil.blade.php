@php
    $pct = $attempt->total > 0 ? round($attempt->score / $attempt->total * 100) : 0;
    $tone = $pct >= 80 ? 'bg-emerald-100 text-emerald-700' : ($pct >= 60 ? 'bg-blue-100 text-blue-700' : 'bg-rose-100 text-rose-700');
@endphp
<x-dashboard-layout title="Hasil Soal" active="soal">
    <div class="flex items-center gap-2 text-xs font-semibold text-gray-500">
        <a href="{{ route('soal') }}" class="inline-flex items-center gap-1.5 hover:text-blue-600 transition-colors">← Soal Pilihan Ganda</a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-800 font-bold">Hasil</span>
    </div>

    <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-2xl {{ $tone }} flex flex-col items-center justify-center">
                <span class="text-2xl font-extrabold leading-none">{{ $pct }}</span>
                <span class="text-[10px] font-bold uppercase tracking-wider mt-1">Nilai</span>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="text-base font-extrabold text-gray-900">Jawaban benar {{ $attempt->score }} dari {{ $attempt->total }} soal</h3>
                    <x-difficulty-badge :level="$attempt->difficulty" />
                </div>
                <p class="text-xs text-gray-500 mt-0.5">
                    @if ($attempt->duration_seconds !== null)
                        Waktu pengerjaan {{ sprintf('%d:%02d', intdiv($attempt->duration_seconds, 60), $attempt->duration_seconds % 60) }} ·
                    @endif
                    Hasil ini sudah dikirim ke guru.
                </p>
            </div>
        </div>
        <a href="{{ route('soal') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-xs font-bold text-center transition-colors">Kembali ke Soal</a>
    </section>

    <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Pembahasan jawabanmu</h3>
    <x-mcq-review :review="$attempt->review ?? []" />
</x-dashboard-layout>
