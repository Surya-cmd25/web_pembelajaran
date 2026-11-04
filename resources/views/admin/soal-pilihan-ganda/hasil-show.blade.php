@php
    $pct = $attempt->total > 0 ? round($attempt->score / $attempt->total * 100) : 0;
    $tone = $pct >= 80 ? 'bg-emerald-100 text-emerald-700' : ($pct >= 60 ? 'bg-blue-100 text-blue-700' : 'bg-rose-100 text-rose-700');
@endphp
<x-admin-layout title="Review Pengerjaan" active="soal">
    <div class="space-y-6">
        <div>
            <a href="{{ route('admin.soal-pilihan-ganda.hasil') }}" class="text-xs font-bold text-gray-500 hover:text-blue-600">← Hasil Pengerjaan Siswa</a>
            <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight mt-1">Review Pengerjaan</h2>
        </div>

        <section class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-2xl {{ $tone }} flex flex-col items-center justify-center">
                    <span class="text-2xl font-extrabold leading-none">{{ $pct }}</span>
                    <span class="text-[10px] font-bold uppercase tracking-wider mt-1">Nilai</span>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="text-base font-extrabold text-gray-900">{{ $attempt->user->name ?? 'Siswa dihapus' }}</h3>
                        <x-difficulty-badge :level="$attempt->difficulty" />
                    </div>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $attempt->user->email ?? '' }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="font-bold text-emerald-700">{{ $attempt->score }} benar</span> ·
                        <span class="font-bold text-rose-600">{{ $attempt->total - $attempt->score }} salah</span> ·
                        {{ $attempt->created_at->translatedFormat('d F Y, H:i') }}
                        @if ($attempt->duration_seconds !== null)
                            · durasi {{ sprintf('%d:%02d', intdiv($attempt->duration_seconds, 60), $attempt->duration_seconds % 60) }}
                        @endif
                    </p>
                </div>
            </div>
        </section>

        <x-mcq-review :review="$attempt->review ?? []" who="Jawaban siswa" />
    </div>
</x-admin-layout>
