@php
    $norm = $norm ?? null;
    $nextSortOrder = $nextSortOrder ?? 1;
    $examples = old('examples', $norm->examples ?? ['', '']);
    $sanctions = old('sanctions', $norm->sanctions ?? ['', '']);

    // Ensure at least 2 rows are shown, plus 2 empty spare rows.
    while (count($examples) < 2) {
        $examples[] = '';
    }
    while (count($sanctions) < 2) {
        $sanctions[] = '';
    }
    $examples[] = '';
    $examples[] = '';
    $sanctions[] = '';
    $sanctions[] = '';

    $colorDot = [
        'blue' => 'bg-blue-500',
        'rose' => 'bg-rose-500',
        'emerald' => 'bg-emerald-500',
        'amber' => 'bg-amber-500',
    ];
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 sm:p-8 space-y-5">
        <h3 class="text-base font-extrabold text-[#0F172A] border-b border-gray-100 pb-4">Informasi Norma</h3>

        <div class="grid sm:grid-cols-2 gap-5">
            <!-- Slug -->
            <div>
                <label for="slug" class="block text-sm font-bold text-gray-700 mb-1.5">Slug</label>
                <input type="text" id="slug" name="slug" maxlength="100" value="{{ old('slug', $norm->slug ?? '') }}" required placeholder="norma-agama"
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                @error('slug')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">Nama Norma</label>
                <input type="text" id="name" name="name" maxlength="100" value="{{ old('name', $norm->name ?? '') }}" required placeholder="Norma Agama"
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                @error('name')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="description" class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi</label>
            <textarea id="description" name="description" rows="3" maxlength="2000" required
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('description', $norm->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <!-- Warna -->
            <div>
                <label for="color" class="block text-sm font-bold text-gray-700 mb-1.5">Warna</label>
                <select id="color" name="color" required
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                    @foreach ($colors as $colorOption)
                        <option value="{{ $colorOption }}" @selected(old('color', $norm->color ?? 'blue') === $colorOption)>{{ $colorOption }}</option>
                    @endforeach
                </select>
                @error('color')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan -->
            <div>
                <label for="sort_order" class="block text-sm font-bold text-gray-700 mb-1.5">Urutan Tampil</label>
                <input type="number" id="sort_order" name="sort_order" min="1" max="100" value="{{ old('sort_order', $norm->sort_order ?? $nextSortOrder) }}" required
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                @error('sort_order')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Ilustrasi -->
        <div>
            <label for="illustration_path" class="block text-sm font-bold text-gray-700 mb-1.5">Ilustrasi (Opsional)</label>
            <div class="flex items-center gap-4">
                @if ($norm?->illustration_path)
                    <img src="{{ Storage::url($norm->illustration_path) }}" alt="{{ $norm->name ?? 'Ilustrasi' }}" class="w-16 h-16 rounded-xl object-cover border border-gray-200 shrink-0">
                @endif
                <input type="file" id="illustration_path" name="illustration_path" accept="image/jpeg,image/png,image/webp"
                    class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-blue-50 file:px-4 file:py-2.5 file:text-xs file:font-bold file:text-blue-700 hover:file:bg-blue-100 file:cursor-pointer">
            </div>
            <p class="mt-1.5 text-xs text-gray-400 font-medium">Format: JPG, JPEG, PNG, atau WebP. Maksimal 2 MB.</p>
            @error('illustration_path')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Contoh & Sanksi -->
    <div class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 sm:p-8 space-y-4">
            <h3 class="text-base font-extrabold text-[#0F172A] border-b border-gray-100 pb-4">Contoh Perilaku</h3>
            @foreach ($examples as $index => $example)
                <div>
                    <input type="text" name="examples[]" maxlength="300" value="{{ $example }}" placeholder="Contoh perilaku {{ $index + 1 }}"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                </div>
            @endforeach
            @error('examples')
                <p class="text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
            @error('examples.*')
                <p class="text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 sm:p-8 space-y-4">
            <h3 class="text-base font-extrabold text-[#0F172A] border-b border-gray-100 pb-4">Sanksi</h3>
            @foreach ($sanctions as $index => $sanction)
                <div>
                    <input type="text" name="sanctions[]" maxlength="300" value="{{ $sanction }}" placeholder="Sanksi {{ $index + 1 }}"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                </div>
            @endforeach
            @error('sanctions')
                <p class="text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
            @error('sanctions.*')
                <p class="text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.norma.index') }}" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all">
            Batal
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
            {{ $norm ? 'Simpan Perubahan' : 'Simpan Norma' }}
        </button>
    </div>
</form>
