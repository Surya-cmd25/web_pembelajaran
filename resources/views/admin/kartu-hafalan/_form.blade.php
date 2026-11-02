@php
    $card = $card ?? null;
    $nextSortOrder = $nextSortOrder ?? 1;

    $colorDot = [
        'amber' => 'bg-amber-500',
        'blue' => 'bg-blue-500',
        'cyan' => 'bg-cyan-500',
        'orange' => 'bg-orange-500',
        'rose' => 'bg-rose-500',
        'emerald' => 'bg-emerald-500',
        'yellow' => 'bg-yellow-500',
        'indigo' => 'bg-indigo-500',
    ];
@endphp

<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 sm:p-8 space-y-5">
        <h3 class="text-base font-extrabold text-[#0F172A] border-b border-gray-100 pb-4">Informasi Kartu</h3>

        <!-- Nama Kartu -->
        <div>
            <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">Nama Kartu</label>
            <input type="text" id="name" name="name" maxlength="100" value="{{ old('name', $card->name ?? '') }}" required
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
            @error('name')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Teks Depan -->
        <div>
            <label for="front_text" class="block text-sm font-bold text-gray-700 mb-1.5">Teks Depan Kartu</label>
            <textarea id="front_text" name="front_text" rows="3" maxlength="1000" required
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('front_text', $card->front_text ?? '') }}</textarea>
            @error('front_text')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Teks Belakang -->
        <div>
            <label for="back_text" class="block text-sm font-bold text-gray-700 mb-1.5">Teks Belakang Kartu</label>
            <textarea id="back_text" name="back_text" rows="4" maxlength="2000" required
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('back_text', $card->back_text ?? '') }}</textarea>
            @error('back_text')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid sm:grid-cols-3 gap-5">
            <!-- Ikon -->
            <div>
                <label for="icon" class="block text-sm font-bold text-gray-700 mb-1.5">Ikon</label>
                <select id="icon" name="icon" required
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                    @foreach ($icons as $icon)
                        <option value="{{ $icon }}" @selected(old('icon', $card->icon ?? 'star') === $icon)>{{ $icon }}</option>
                    @endforeach
                </select>
                @error('icon')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Warna -->
            <div>
                <label for="color" class="block text-sm font-bold text-gray-700 mb-1.5">Warna</label>
                <select id="color" name="color" required
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                    @foreach ($colors as $colorOption)
                        <option value="{{ $colorOption }}" @selected(old('color', $card->color ?? 'blue') === $colorOption)>{{ $colorOption }}</option>
                    @endforeach
                </select>
                @error('color')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan -->
            <div>
                <label for="sort_order" class="block text-sm font-bold text-gray-700 mb-1.5">Urutan Tampil</label>
                <input type="number" id="sort_order" name="sort_order" min="1" max="100" value="{{ old('sort_order', $card->sort_order ?? $nextSortOrder) }}" required
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                @error('sort_order')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Preview Warna -->
        <div id="colorPreview" class="flex items-center gap-2 text-xs font-bold text-gray-500">
            <span>Pratinjau warna:</span>
            <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1 bg-blue-50 text-blue-700 border-blue-200">
                <span id="colorDot" class="w-2 h-2 rounded-full bg-blue-500"></span>
                <span id="colorName">blue</span>
            </span>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.kartu-hafalan.index') }}" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all">
            Batal
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
            {{ $card ? 'Simpan Perubahan' : 'Simpan Kartu' }}
        </button>
    </div>
</form>

@push('scripts')
<script>
    (function () {
        const colorMap = @json($colorDot);
        const select = document.getElementById('color');
        const dot = document.getElementById('colorDot');
        const name = document.getElementById('colorName');

        function refresh() {
            const color = select.value;
            dot.className = 'w-2 h-2 rounded-full ' + (colorMap[color] || colorMap.blue);
            name.textContent = color;

            const chip = dot.parentElement;
            chip.className = 'inline-flex items-center gap-2 rounded-full border px-3 py-1 bg-' + color + '-50 text-' + color + '-700 border-' + color + '-200';
        }

        select.addEventListener('change', refresh);
        refresh();
    })();
</script>
@endpush
