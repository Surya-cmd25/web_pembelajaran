@php
    $pair = $pair ?? null;
@endphp

<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 sm:p-8 space-y-5">
        <h3 class="text-base font-extrabold text-[#0F172A] border-b border-gray-100 pb-4">Detail Pasangan Quiz</h3>

        <!-- Situasi -->
        <div>
            <label for="situation" class="block text-sm font-bold text-gray-700 mb-1.5">Situasi</label>
            <textarea id="situation" name="situation" rows="3" maxlength="255" required placeholder="Tulis situasi yang dialami siswa..."
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('situation', $pair->situation ?? '') }}</textarea>
            @error('situation')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Norma Benar -->
        <div>
            <span class="block text-sm font-bold text-gray-700 mb-2">Norma yang Tepat</span>
            <div class="grid sm:grid-cols-2 gap-3">
                @foreach ($normLabels as $value => $label)
                    <label class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 cursor-pointer hover:border-blue-300 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50 transition-all">
                        <input type="radio" name="correct_norm" value="{{ $value }}" required
                            @checked(old('correct_norm', $pair->correct_norm ?? '') === $value)
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <span class="text-sm font-bold text-gray-800">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            @error('correct_norm')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Penjelasan -->
        <div>
            <label for="explanation" class="block text-sm font-bold text-gray-700 mb-1.5">Penjelasan (Opsional)</label>
            <textarea id="explanation" name="explanation" rows="3" maxlength="1000" placeholder="Jelaskan mengapa norma tersebut tepat..."
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('explanation', $pair->explanation ?? '') }}</textarea>
            @error('explanation')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status Aktif -->
        <div class="flex items-center gap-3 rounded-xl bg-gray-50 border border-gray-100 px-4 py-3">
            <input type="checkbox" id="is_active" name="is_active" value="1"
                @checked(old('is_active', $pair->is_active ?? true))
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <label for="is_active" class="text-sm font-bold text-gray-700 cursor-pointer">Tampilkan ke siswa (aktif)</label>
        </div>
        @error('is_active')
            <p class="text-xs font-semibold text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.pasangan-quiz.index') }}" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all">
            Batal
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
            {{ $pair ? 'Simpan Perubahan' : 'Simpan Pasangan' }}
        </button>
    </div>
</form>
