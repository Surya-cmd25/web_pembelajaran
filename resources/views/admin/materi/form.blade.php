@php($materi = $materi ?? null)

<div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5 space-y-5">
    <div>
        <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Judul Materi *</label>
        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $materi?->title) }}"
            required
            maxlength="255"
            placeholder="Contoh: Pengertian Nilai dan Norma Sosial"
            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-rose-300 @enderror"
        >
        @error('title')
            <p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Slug *</label>
            <input
                type="text"
                name="slug"
                id="slug"
                value="{{ old('slug', $materi?->slug) }}"
                required
                maxlength="255"
                placeholder="pengertian-nilai-dan-norma-sosial"
                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('slug') border-rose-300 @enderror"
            >
            <p class="text-[11px] text-gray-400 mt-1.5">Huruf kecil, gunakan tanda hubung (-) sebagai pemisah.</p>
            @error('slug')
                <p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="sort_order" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Urutan Tampil *</label>
            <input
                type="number"
                name="sort_order"
                id="sort_order"
                value="{{ old('sort_order', $materi?->sort_order ?? 1) }}"
                required
                min="1"
                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-rose-300 @enderror"
            >
            @error('sort_order')
                <p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="summary" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Ringkasan</label>
        <input
            type="text"
            name="summary"
            id="summary"
            value="{{ old('summary', $materi?->summary) }}"
            maxlength="255"
            placeholder="Ringkasan singkat yang tampil di kartu materi"
            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('summary') border-rose-300 @enderror"
        >
        @error('summary')
            <p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="body" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Isi Materi *</label>
        <textarea
            name="body"
            id="body"
            rows="12"
            required
            placeholder="Tulis isi materi di sini..."
            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('body') border-rose-300 @enderror"
        >{{ old('body', $materi?->body) }}</textarea>
        <p class="text-[11px] text-gray-400 mt-1.5">Pisahkan paragraf dengan baris kosong.</p>
        @error('body')
            <p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="quote" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Kutipan</label>
        <input
            type="text"
            name="quote"
            id="quote"
            value="{{ old('quote', $materi?->quote) }}"
            maxlength="255"
            placeholder="Kutipan penutup (opsional)"
            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('quote') border-rose-300 @enderror"
        >
        @error('quote')
            <p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="hidden" name="is_published" value="0">
        <label class="flex items-center gap-3 cursor-pointer">
            <input
                type="checkbox"
                name="is_published"
                id="is_published"
                value="1"
                @checked(old('is_published', $materi?->is_published ?? true))
                class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
            >
            <span class="text-sm font-bold text-gray-700">Terbitkan materi (tampil untuk siswa)</span>
        </label>
        @error('is_published')
            <p class="text-xs font-medium text-rose-600 mt-1.5">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex flex-wrap items-center gap-3">
    <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors shadow-md shadow-blue-500/20">
        {{ $submitLabel ?? 'Simpan Materi' }}
    </button>
    <a href="{{ route('admin.materi.index') }}" class="px-6 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300 font-bold text-sm transition-colors">
        Batal
    </a>
</div>
