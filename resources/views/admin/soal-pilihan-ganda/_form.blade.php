@php
    $question = $question ?? null;
    $nextSortOrder = $nextSortOrder ?? 1;
    $options = old('options', $question->options ?? ['', '', '', '']);
    $oldCorrect = (int) old('correct_index', $question->correct_index ?? 0);

    // Always render exactly 4 option rows.
    $options = array_pad(array_values((array) $options), 4, '');
    $options = array_slice($options, 0, 4);
@endphp

<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 sm:p-8 space-y-5">
        <h3 class="text-base font-extrabold text-[#0F172A] border-b border-gray-100 pb-4">Detail Soal</h3>

        <!-- Soal -->
        <div>
            <label for="question" class="block text-sm font-bold text-gray-700 mb-1.5">Pertanyaan</label>
            <textarea id="question" name="question" rows="3" maxlength="1000" required placeholder="Tulis pertanyaan..."
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('question', $question->question ?? '') }}</textarea>
            @error('question')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Level Kesulitan -->
        <div>
            <span class="block text-sm font-bold text-gray-700 mb-2">Level Kesulitan</span>
            <div class="flex flex-wrap gap-3">
                @foreach ($levels as $value => $label)
                    <label class="cursor-pointer">
                        <input type="radio" name="difficulty" value="{{ $value }}" required
                            @checked(old('difficulty', $question->difficulty ?? $defaultDifficulty) === $value)
                            class="peer sr-only">
                        <span class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-600 transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 peer-checked:ring-2 peer-checked:ring-blue-200">
                            {{ $label }}
                        </span>
                    </label>
                @endforeach
            </div>
            <p class="mt-2 text-xs text-gray-400">Soal dikelompokkan ke dalam kartu level yang dipilih siswa saat mengerjakan.</p>
            @error('difficulty')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pilihan Jawaban -->
        <div>
            <span class="block text-sm font-bold text-gray-700 mb-2">Pilihan Jawaban <span class="text-gray-400 font-medium">(pilih radio pada jawaban yang benar)</span></span>
            <div class="space-y-3">
                @foreach ($options as $index => $option)
                    <div class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-2.5 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-100 transition">
                        <label class="flex items-center shrink-0 cursor-pointer" title="Tandai sebagai jawaban benar">
                            <input type="radio" name="correct_index" value="{{ $index }}" required
                                @checked($oldCorrect === $index)
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                        </label>
                        <span class="text-xs font-bold text-gray-400 shrink-0">{{ chr(65 + $index) }}</span>
                        <input type="text" name="options[{{ $index }}]" maxlength="500" value="{{ $option }}" required placeholder="Pilihan jawaban {{ chr(65 + $index) }}"
                            class="flex-1 border-0 bg-transparent px-0 py-1 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                    </div>
                @endforeach
            </div>
            @error('options')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
            @error('options.*')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
            @error('correct_index')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Penjelasan -->
        <div>
            <label for="explanation" class="block text-sm font-bold text-gray-700 mb-1.5">Penjelasan (Opsional)</label>
            <textarea id="explanation" name="explanation" rows="2" maxlength="1000" placeholder="Jelaskan jawaban yang benar..."
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('explanation', $question->explanation ?? '') }}</textarea>
            @error('explanation')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid sm:grid-cols-3 gap-5">
            <!-- Urutan -->
            <div>
                <label for="sort_order" class="block text-sm font-bold text-gray-700 mb-1.5">Urutan Tampil</label>
                <input type="number" id="sort_order" name="sort_order" min="1" max="100" value="{{ old('sort_order', $question->sort_order ?? $nextSortOrder) }}" required
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                @error('sort_order')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div class="sm:col-span-2 flex items-end pb-1">
                <div class="flex items-center gap-3 rounded-xl bg-gray-50 border border-gray-100 px-4 py-3 w-full">
                    <input type="checkbox" id="is_active" name="is_active" value="1"
                        @checked(old('is_active', $question->is_active ?? true))
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_active" class="text-sm font-bold text-gray-700 cursor-pointer">Tampilkan ke siswa (aktif)</label>
                </div>
            </div>
        </div>
        @error('is_active')
            <p class="text-xs font-semibold text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.soal-pilihan-ganda.index') }}" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all">
            Batal
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
            {{ $question ? 'Simpan Perubahan' : 'Simpan Soal' }}
        </button>
    </div>
</form>
