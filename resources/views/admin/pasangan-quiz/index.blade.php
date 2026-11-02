<x-admin-layout title="Kelola Pasangan Quiz" active="quiz">
    @php
        $normBadge = [
            'agama' => 'bg-blue-50 text-blue-700 border-blue-200',
            'kesusilaan' => 'bg-rose-50 text-rose-700 border-rose-200',
            'kesopanan' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'hukum' => 'bg-amber-50 text-amber-700 border-amber-200',
        ];
    @endphp

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Pasangan Quiz</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Kelola situasi beserta norma yang tepat untuk game mencocokkan norma.</p>
            </div>
            <a href="{{ route('admin.pasangan-quiz.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M12 4v16m8-8H4"/></svg>
                Tambah Pasangan
            </a>
        </div>

        @if (session('status'))
            <div class="rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('status') }}</div>
        @endif

        <!-- Pairs Table -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-200/80 text-left text-xs font-bold text-gray-500 uppercase tracking-wide">
                            <th class="px-5 py-3.5 w-12 text-center">#</th>
                            <th class="px-5 py-3.5">Situasi</th>
                            <th class="px-5 py-3.5">Norma Benar</th>
                            <th class="px-5 py-3.5">Penjelasan</th>
                            <th class="px-5 py-3.5 text-center">Status</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($pairs as $pair)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-5 py-4 text-center text-xs font-bold text-gray-400">{{ $loop->iteration }}</td>
                                <td class="px-5 py-4 text-gray-800 font-medium max-w-[280px]">
                                    <p class="truncate" title="{{ $pair->situation }}">{{ $pair->situation }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $normBadge[$pair->correct_norm] ?? $normBadge['agama'] }}">
                                        {{ $normLabels[$pair->correct_norm] ?? $pair->correct_norm }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-gray-600 max-w-[240px]">
                                    @if ($pair->explanation)
                                        <p class="truncate" title="{{ $pair->explanation }}">{{ $pair->explanation }}</p>
                                    @else
                                        <span class="text-xs text-gray-400 font-medium">—</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if ($pair->is_active)
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 border border-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-50 border border-gray-200 px-3 py-1 text-xs font-bold text-gray-500">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.pasangan-quiz.edit', $pair) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-bold text-gray-700 hover:border-blue-300 hover:text-blue-600 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.pasangan-quiz.destroy', $pair) }}" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg border border-rose-200 bg-white px-3 py-1.5 text-xs font-bold text-rose-600 hover:bg-rose-50 transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-gray-400 font-medium">Belum ada pasangan quiz. Klik "Tambah Pasangan" untuk membuat yang pertama.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
