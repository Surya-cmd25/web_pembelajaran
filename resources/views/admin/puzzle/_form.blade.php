@php
    $level = $level ?? null;
    $inputCls = 'w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
    $labelCls = 'block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5';
@endphp

<div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5 space-y-5">
    <div class="grid grid-cols-1 sm:grid-cols-[160px_minmax(0,1fr)] gap-5">
        <div>
            <label for="level" class="{{ $labelCls }}">Level *</label>
            @if ($level)
                <input type="number" name="level" id="level" value="{{ old('level', $level->level) }}" min="1" max="5" required class="{{ $inputCls }}">
            @else
                <select name="level" id="level" required class="{{ $inputCls }}">
                    @foreach ($freeLevels as $free)
                        <option value="{{ $free }}" @selected((int) old('level', $freeLevels[0]) === $free)>Level {{ $free }}</option>
                    @endforeach
                </select>
            @endif
            @error('level')<p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="title" class="{{ $labelCls }}">Judul / Nama Gambar *</label>
            <input type="text" name="title" id="title" required maxlength="150" value="{{ old('title', $level?->title) }}" placeholder="Contoh: Émile Durkheim (1858–1917)" class="{{ $inputCls }}">
            @error('title')<p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="description" class="{{ $labelCls }}">Penjelasan (tampil setelah puzzle selesai)</label>
        <textarea name="description" id="description" rows="4" maxlength="2000" placeholder="Penjelasan singkat tentang gambar ini…" class="{{ $inputCls }}">{{ old('description', $level?->description) }}</textarea>
        @error('description')<p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="image" class="{{ $labelCls }}">Gambar Puzzle</label>
        @if ($level)
            <div class="flex items-center gap-4 mb-3">
                <img src="{{ $level->imageUrl() }}" alt="Gambar level" class="w-28 h-20 rounded-xl object-cover border border-gray-200">
                @if ($level->image_path)
                    <label class="flex items-center gap-2 text-xs font-bold text-rose-600 cursor-pointer">
                        <input type="checkbox" name="remove_image" value="1" class="w-4 h-4 rounded border-gray-300 text-rose-600 focus:ring-rose-500">
                        Hapus gambar (pakai gambar bawaan)
                    </label>
                @else
                    <span class="text-xs text-gray-400 font-medium">Memakai gambar bawaan.</span>
                @endif
            </div>
        @endif
        <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/webp"
            class="block w-full text-sm text-gray-500 file:mr-3 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 file:text-xs file:font-bold file:cursor-pointer">
        <p class="text-[11px] text-gray-400 mt-1.5">JPG/PNG/WEBP, maksimal 3 MB. Kosongkan jika tidak ingin mengganti gambar.</p>
        @error('image')<p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div>
            <label for="cols" class="{{ $labelCls }}">Kolom (kotak mendatar) *</label>
            <input type="number" name="cols" id="cols" min="2" max="6" required value="{{ old('cols', $level?->cols ?? 3) }}" class="{{ $inputCls }}">
            @error('cols')<p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="rows" class="{{ $labelCls }}">Baris (kotak menurun) *</label>
            <input type="number" name="rows" id="rows" min="2" max="6" required value="{{ old('rows', $level?->rows ?? 2) }}" class="{{ $inputCls }}">
            @error('rows')<p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="time_minutes" class="{{ $labelCls }}">Waktu (menit) *</label>
            <input type="number" name="time_minutes" id="time_minutes" min="1" max="60" required value="{{ old('time_minutes', $level ? intdiv($level->time_limit, 60) : 5) }}" class="{{ $inputCls }}">
            @error('time_minutes')<p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>@enderror
        </div>
    </div>
    <p id="pieceInfo" class="text-xs font-semibold text-blue-600"></p>

    <div>
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $level?->is_active ?? true)) class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm font-bold text-gray-700">Aktifkan level (tampil untuk siswa)</span>
        </label>
    </div>
</div>

<div class="flex flex-wrap items-center gap-3 mt-6">
    <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors shadow-md shadow-blue-500/20">
        {{ $submitLabel ?? 'Simpan Level' }}
    </button>
    <a href="{{ route('admin.puzzle.index') }}" class="px-6 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300 font-bold text-sm transition-colors">Batal</a>
</div>

<script>
    (() => {
        const cols = document.getElementById('cols');
        const rows = document.getElementById('rows');
        const info = document.getElementById('pieceInfo');
        const update = () => { info.textContent = `Total ${(+cols.value || 0) * (+rows.value || 0)} keping puzzle.`; };
        cols.addEventListener('input', update);
        rows.addEventListener('input', update);
        update();
    })();
</script>
