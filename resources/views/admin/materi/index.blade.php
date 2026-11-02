<x-admin-layout title="Kelola Materi" active="materi">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">Kelola Materi</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Atur isi materi, urutan tampil, dan audio penjelasan.</p>
        </div>
        <a href="{{ route('admin.materi.create') }}" class="inline-flex justify-center items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors shadow-md shadow-blue-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Materi
        </a>
    </div>

    @if (session('status'))
        <div class="rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200/80 px-4 py-3 text-sm font-bold">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/70 text-left">
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Urutan</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Materi</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Audio</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Dibaca</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400">Status</th>
                        <th class="px-5 py-3.5 text-xs font-extrabold uppercase tracking-wider text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($materis as $materi)
                        <tr class="hover:bg-gray-50/60 align-top">
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-700 font-extrabold text-xs">
                                    {{ $materi->sort_order }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-bold text-gray-900">{{ $materi->title }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">/{{ $materi->slug }}</p>
                            </td>
                            <td class="px-5 py-4 min-w-[260px]">
                                @if ($materi->audio_path)
                                    <audio controls preload="none" src="{{ asset('storage/'.$materi->audio_path) }}" class="w-full h-9 mb-2"></audio>
                                    <form method="POST" action="{{ route('admin.materi.audio.destroy', $materi) }}" onsubmit="return confirm('Hapus audio penjelasan materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-700">Hapus Audio</button>
                                    </form>
                                @else
                                    <span class="inline-block px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 text-[11px] font-extrabold uppercase tracking-wider mb-2">
                                        Belum ada audio
                                    </span>
                                    <form method="POST" action="{{ route('admin.materi.audio', $materi) }}" enctype="multipart/form-data" class="flex flex-wrap items-center gap-2">
                                        @csrf
                                        <input type="file" name="audio" accept="audio/*" required class="text-xs text-gray-500 file:mr-2 file:px-3 file:py-1.5 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 file:text-xs file:font-bold file:cursor-pointer">
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-colors">
                                            Unggah Audio
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-gray-700">{{ $materi->reads_count }}</span>
                                <span class="text-xs text-gray-400">siswa</span>
                            </td>
                            <td class="px-5 py-4">
                                @if ($materi->is_published)
                                    <span class="px-2 py-1 rounded-md bg-emerald-50 text-emerald-700 text-[11px] font-extrabold uppercase tracking-wider">Terbit</span>
                                @else
                                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-500 text-[11px] font-extrabold uppercase tracking-wider">Draft</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.materi.edit', $materi) }}" class="text-xs font-bold text-blue-600 hover:text-blue-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.materi.destroy', $materi) }}" onsubmit="return confirm('Hapus materi beserta audionya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-500">
                                Belum ada materi. Klik "Tambah Materi" untuk membuat yang pertama.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($materis->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $materis->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
