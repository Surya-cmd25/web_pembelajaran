<x-admin-layout title="Kelola Puzzle" active="puzzle">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Puzzle</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Atur gambar, jumlah kotak, dan waktu pengerjaan untuk setiap level (maksimal {{ $maxLevels }} level).</p>
            </div>
            @if ($levels->count() < $maxLevels)
                <a href="{{ route('admin.puzzle.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M12 4v16m8-8H4"/></svg>
                    Tambah Level
                </a>
            @else
                <span class="px-4 py-2.5 rounded-xl bg-gray-100 text-gray-400 text-sm font-bold">Level sudah penuh ({{ $maxLevels }}/{{ $maxLevels }})</span>
            @endif
        </div>

        @if (session('status'))
            <div class="rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="rounded-xl bg-rose-50 border border-rose-100 px-4 py-3 text-sm font-semibold text-rose-700">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-200/80 text-left text-xs font-bold text-gray-500 uppercase tracking-wide">
                            <th class="px-5 py-3.5 text-center">Level</th>
                            <th class="px-5 py-3.5">Gambar</th>
                            <th class="px-5 py-3.5">Judul</th>
                            <th class="px-5 py-3.5 text-center">Kotak</th>
                            <th class="px-5 py-3.5 text-center">Waktu</th>
                            <th class="px-5 py-3.5 text-center">Status</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($levels as $level)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold">{{ $level->level }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    <img src="{{ $level->imageUrl() }}" alt="{{ $level->title }}" class="w-20 h-14 rounded-xl object-cover border border-gray-200">
                                </td>
                                <td class="px-5 py-4 text-gray-800 font-semibold max-w-[260px]"><p class="truncate">{{ $level->title }}</p></td>
                                <td class="px-5 py-4 text-center text-gray-600 font-medium">{{ $level->cols }} × {{ $level->rows }} <span class="text-xs text-gray-400">({{ $level->pieceCount() }})</span></td>
                                <td class="px-5 py-4 text-center text-gray-600 font-medium">{{ sprintf('%d:%02d', intdiv($level->time_limit, 60), $level->time_limit % 60) }}</td>
                                <td class="px-5 py-4 text-center">
                                    @if ($level->is_active)
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 border border-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-50 border border-gray-200 px-3 py-1 text-xs font-bold text-gray-500">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.puzzle.edit', $level) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-bold text-gray-700 hover:border-blue-300 hover:text-blue-600 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.puzzle.destroy', $level) }}" onsubmit="return confirm('Hapus data ini?')">
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
                                <td colspan="7" class="px-5 py-12 text-center text-gray-400 font-medium">Belum ada level. Klik "Tambah Level" untuk membuat yang pertama.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
