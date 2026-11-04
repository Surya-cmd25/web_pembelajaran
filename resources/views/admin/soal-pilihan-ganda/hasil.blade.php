<x-admin-layout title="Hasil Soal Pilihan Ganda" active="soal">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('admin.soal-pilihan-ganda.index') }}" class="text-xs font-bold text-gray-500 hover:text-blue-600">← Kelola Soal</a>
                <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight mt-1">Hasil Pengerjaan Siswa</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Nilai yang dikumpulkan siswa beserta review soal yang benar dan salah.</p>
            </div>
            <div class="flex items-center gap-2.5">
                <form method="GET" class="flex items-center gap-2">
                    <input type="search" name="q" value="{{ $q }}" placeholder="Cari nama / email…" class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </form>
                <a href="{{ route('admin.ekspor.soal') }}" class="px-4 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-sm font-bold transition-colors">Ekspor CSV</a>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-200/80 text-left text-xs font-bold text-gray-500 uppercase tracking-wide">
                            <th class="px-5 py-3.5">Siswa</th>
                            <th class="px-5 py-3.5 text-center">Benar</th>
                            <th class="px-5 py-3.5 text-center">Salah</th>
                            <th class="px-5 py-3.5 text-center">Nilai</th>
                            <th class="px-5 py-3.5">Level</th>
                            <th class="px-5 py-3.5">Durasi</th>
                            <th class="px-5 py-3.5">Dikumpulkan</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($attempts as $attempt)
                            @php
                                $pct = $attempt->total > 0 ? round($attempt->score / $attempt->total * 100) : 0;
                                $tone = $pct >= 80 ? 'bg-emerald-50 text-emerald-700' : ($pct >= 60 ? 'bg-blue-50 text-blue-700' : 'bg-rose-50 text-rose-700');
                            @endphp
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-5 py-4">
                                    <p class="font-bold text-gray-900">{{ $attempt->user->name ?? 'Siswa dihapus' }}</p>
                                    <p class="text-xs text-gray-400">{{ $attempt->user->email ?? '' }}</p>
                                </td>
                                <td class="px-5 py-4 text-center font-bold text-emerald-700">{{ $attempt->score }}</td>
                                <td class="px-5 py-4 text-center font-bold text-rose-600">{{ $attempt->total - $attempt->score }}</td>
                                <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center min-w-10 h-8 px-2 rounded-lg {{ $tone }} text-xs font-extrabold">{{ $pct }}</span></td>
                                <td class="px-5 py-4">
                                    <x-difficulty-badge :level="$attempt->difficulty" />
                                </td>
                                <td class="px-5 py-4 text-gray-600">
                                    {{ $attempt->duration_seconds !== null ? sprintf('%d:%02d', intdiv($attempt->duration_seconds, 60), $attempt->duration_seconds % 60) : '—' }}
                                </td>
                                <td class="px-5 py-4 text-gray-600">{{ $attempt->created_at->translatedFormat('d M Y, H:i') }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex justify-end">
                                        <a href="{{ route('admin.soal-pilihan-ganda.hasil.show', $attempt) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-bold text-gray-700 hover:border-blue-300 hover:text-blue-600 transition-all">
                                            Review Soal
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-12 text-center text-gray-400 font-medium">Belum ada siswa yang mengumpulkan jawaban.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($attempts->hasPages())
                <div class="px-5 py-4 border-t border-gray-100">{{ $attempts->links() }}</div>
            @endif
        </div>
    </div>
</x-admin-layout>
