<x-admin-layout title="Data Siswa" active="siswa">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">Data Siswa</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Pantau aktivitas dan capaian belajar setiap siswa.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.ekspor.quiz') }}" class="px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:border-blue-300 hover:text-blue-600 font-bold text-xs transition-colors">
                Ekspor Nilai Quiz (CSV)
            </a>
            <a href="{{ route('admin.ekspor.soal') }}" class="px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:border-blue-300 hover:text-blue-600 font-bold text-xs transition-colors">
                Ekspor Nilai Soal PG (CSV)
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200/80 px-4 py-3 text-sm font-bold">
            {{ session('status') }}
        </div>
    @endif

    {{-- Pencarian --}}
    <form method="GET" action="{{ route('admin.siswa.index') }}" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <label for="q" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Cari Siswa</label>
                <input
                    type="text"
                    name="q"
                    id="q"
                    value="{{ $q ?? '' }}"
                    placeholder="Cari berdasarkan nama atau email..."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <div class="flex gap-2 sm:items-end">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors shadow-md shadow-blue-500/20">
                    Cari
                </button>
                <a href="{{ route('admin.siswa.index') }}" class="px-5 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300 font-bold text-sm transition-colors">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/70 text-left">
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Siswa</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Rekaman</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Skor Quiz</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Skor Soal PG</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Aktivitas</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Bergabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($students as $student)
                        @php
                            $bestQuiz = $student->quizAttempts->first();
                            $bestMcq = $student->mcqAttempts->first();
                            $completed = (int) $student->activities_count;
                            $percent = (int) round(($completed / 6) * 100);
                        @endphp
                        <tr class="hover:bg-gray-50/60">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ strtoupper(mb_substr($student->name, 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-gray-900 truncate">{{ $student->name }}</p>
                                        <p class="text-xs text-gray-400 truncate">{{ $student->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-gray-700">{{ $student->recordings_count }}</span>
                                <span class="text-xs text-gray-400">rekaman</span>
                            </td>
                            <td class="px-5 py-4 font-bold text-gray-700">
                                {{ $bestQuiz?->score ?? '-' }}
                            </td>
                            <td class="px-5 py-4 font-bold text-gray-700">
                                {{ $bestMcq?->score ?? '-' }}
                            </td>
                            <td class="px-5 py-4 min-w-[160px]">
                                <div class="flex items-center gap-2">
                                    <div class="flex-1 h-2 rounded-full bg-gray-100 overflow-hidden">
                                        <div class="h-2 rounded-full bg-blue-600" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-gray-600 shrink-0">{{ $completed }}/6</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-xs text-gray-500 whitespace-nowrap">
                                {{ $student->created_at->locale('id')->translatedFormat('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-500">
                                {{ $q ? 'Tidak ada siswa yang cocok dengan pencarian "' . $q . '".' : 'Belum ada siswa terdaftar.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($students->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
