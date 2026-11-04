<x-admin-layout title="Kelola Soal Pilihan Ganda" active="soal">
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Soal Pilihan Ganda</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Kelola soal pilihan ganda untuk evaluasi pemahaman siswa.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('admin.soal-pilihan-ganda.hasil') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 font-bold px-5 py-2.5 rounded-xl transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Hasil Pengerjaan Siswa
                </a>
                <a href="{{ route('admin.soal-pilihan-ganda.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M12 4v16m8-8H4"/></svg>
                    Tambah Soal
                </a>
            </div>
        </div>

        @if (session('status'))
            <div class="rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('status') }}</div>
        @endif

        <!-- Pengaturan tampil di kartu siswa -->
        <form method="POST" action="{{ route('admin.soal-pilihan-ganda.pengaturan') }}" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5 grid grid-cols-1 sm:grid-cols-[140px_minmax(0,1fr)_auto] gap-4 items-end">
            @csrf
            @method('PUT')
            <div>
                <label for="duration_minutes" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Durasi (menit)</label>
                <input type="number" min="1" max="240" required name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', $durationMinutes) }}"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('duration_minutes')<p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Keterangan soal (tampil di popup siswa)</label>
                <input type="text" name="description" id="description" maxlength="500" value="{{ old('description', $description) }}" placeholder="Contoh: Jawab soal situasi sosial seputar nilai dan norma."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors">Simpan</button>
        </form>

        <!-- Filter kartu soal per level kesulitan -->
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.soal-pilihan-ganda.index') }}"
                class="inline-flex items-center gap-1.5 rounded-full border px-4 py-2 text-xs font-bold transition-all {{ $activeLevel === null ? 'border-blue-600 bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'border-gray-200 bg-white text-gray-600 hover:border-blue-300 hover:text-blue-600' }}">
                Semua
                <span class="{{ $activeLevel === null ? 'text-blue-100' : 'text-gray-400' }}">({{ $totalQuestions }})</span>
            </a>
            @foreach ($levels as $value => $label)
                <a href="{{ route('admin.soal-pilihan-ganda.index', ['level' => $value]) }}"
                    class="inline-flex items-center gap-1.5 rounded-full border px-4 py-2 text-xs font-bold transition-all {{ $activeLevel === $value ? 'border-blue-600 bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'border-gray-200 bg-white text-gray-600 hover:border-blue-300 hover:text-blue-600' }}">
                    {{ $label }}
                    <span class="{{ $activeLevel === $value ? 'text-blue-100' : 'text-gray-400' }}">({{ (int) ($counts[$value] ?? 0) }})</span>
                </a>
            @endforeach
        </div>

        <!-- Questions Table -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-200/80 text-left text-xs font-bold text-gray-500 uppercase tracking-wide">
                            <th class="px-5 py-3.5 text-center">Urutan</th>
                            <th class="px-5 py-3.5">Soal</th>
                            <th class="px-5 py-3.5">Kesulitan</th>
                            <th class="px-5 py-3.5">Jawaban Benar</th>
                            <th class="px-5 py-3.5 text-center">Status</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($questions as $question)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold">{{ $question->sort_order }}</span>
                                </td>
                                <td class="px-5 py-4 text-gray-800 font-medium max-w-[340px]">
                                    <p class="truncate" title="{{ $question->question }}">{{ $question->question }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    <x-difficulty-badge :level="$question->difficulty" />
                                </td>
                                <td class="px-5 py-4 text-gray-600 max-w-[220px]">
                                    <p class="truncate font-semibold text-emerald-700" title="{{ $question->options[$question->correct_index] ?? '' }}">
                                        {{ $question->options[$question->correct_index] ?? '—' }}
                                    </p>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if ($question->is_active)
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 border border-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-50 border border-gray-200 px-3 py-1 text-xs font-bold text-gray-500">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.soal-pilihan-ganda.edit', $question) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-bold text-gray-700 hover:border-blue-300 hover:text-blue-600 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.soal-pilihan-ganda.destroy', $question) }}" onsubmit="return confirm('Hapus data ini?')">
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
                                <td colspan="6" class="px-5 py-12 text-center text-gray-400 font-medium">
                                    @if ($activeLevel !== null)
                                        Belum ada soal level {{ $levels[$activeLevel] }}. Klik "Tambah Soal" untuk menambahkannya.
                                    @else
                                        Belum ada soal. Klik "Tambah Soal" untuk membuat yang pertama.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
