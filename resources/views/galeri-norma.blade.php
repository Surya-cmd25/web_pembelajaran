<x-dashboard-layout title="Galeri Empat Norma" active="galeri">
    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
            <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight mt-1">
                Galeri Empat Norma
            </h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                Pelajari contoh penerapan nyata norma dalam kehidupan sehari-hari. Sentuh salah satu kartu untuk membaca penjelasannya.
            </p>
        </div>
        <span class="self-start px-3.5 py-1 rounded-full border border-gray-200 bg-white text-gray-600 text-xs font-semibold shadow-2xs">
            {{ $norms->count() }} Jenis Norma
        </span>
    </div>

    {{-- Norm cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach ($norms as $index => $norm)
            @php
                $palette = match ($norm->color) {
                    'blue' => ['card' => 'bg-blue-50/70 border-blue-200/70', 'chip' => 'bg-blue-100 text-blue-700', 'text' => 'text-blue-600', 'ring' => 'ring-blue-400'],
                    'rose' => ['card' => 'bg-rose-50/70 border-rose-200/70', 'chip' => 'bg-rose-100 text-rose-700', 'text' => 'text-rose-600', 'ring' => 'ring-rose-400'],
                    'emerald' => ['card' => 'bg-emerald-50/70 border-emerald-200/70', 'chip' => 'bg-emerald-100 text-emerald-700', 'text' => 'text-emerald-600', 'ring' => 'ring-emerald-400'],
                    default => ['card' => 'bg-amber-50/70 border-amber-200/70', 'chip' => 'bg-amber-100 text-amber-700', 'text' => 'text-amber-600', 'ring' => 'ring-amber-400'],
                };
            @endphp

            <button type="button" data-norm-index="{{ $index }}"
                class="norm-card group text-left bg-white rounded-3xl border border-gray-200/80 shadow-2xs hover:shadow-md overflow-hidden transition-all duration-200 focus:outline-none focus-visible:ring-2 {{ $palette['ring'] }}">
                {{-- Illustration area --}}
                <div class="{{ $norm->illustration_path ? 'h-52' : 'h-44' }} shrink-0 {{ $palette['card'] }} flex flex-col items-center justify-center gap-2 border-b border-white/60 relative overflow-hidden">
                    <div class="pointer-events-none absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white/50"></div>
                    <span data-illustration class="{{ $norm->illustration_path ? 'absolute inset-0' : 'relative drop-shadow-sm' }}">
                        @if ($norm->illustration_path)
                            <img src="{{ asset('storage/'.$norm->illustration_path) }}" alt="{{ $norm->name }}" class="w-full h-full object-cover">
                        @else
                            <x-norm-illustration :slug="$norm->slug" class="w-28 h-28" />
                        @endif
                    </span>
                    <span class="relative text-[11px] font-bold uppercase tracking-wider {{ $palette['text'] }} {{ $norm->illustration_path ? 'mt-auto mb-3 px-3 py-1 rounded-full bg-white/90 shadow-sm' : '' }}">
                        {{ \Illuminate\Support\Str::of($norm->name)->afterLast(' ')->upper() }} Pilar Norma
                    </span>
                </div>

                <div class="p-5 flex flex-col gap-2.5">
                    <div class="flex items-center justify-between gap-2">
                        <h3 class="text-base font-extrabold text-gray-900 group-hover:text-blue-600 transition-colors">
                            {{ $norm->name }}
                        </h3>
                        <span class="w-7 h-7 rounded-lg {{ $palette['chip'] }} flex items-center justify-center text-xs font-bold shrink-0">
                            {{ $index + 1 }}
                        </span>
                    </div>

                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                        {{ $norm->description }}
                    </p>

                    <div class="mt-auto pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="font-bold text-blue-600 group-hover:text-blue-700">Detail →</span>
                    </div>
                </div>
            </button>
        @endforeach
    </div>

    {{-- Detail modal --}}
    <div id="normModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div id="normModalBackdrop" class="absolute inset-0 bg-slate-900/50 backdrop-blur-xs"></div>
        <div id="normModalPanel" class="relative w-full max-w-lg bg-white rounded-3xl border border-gray-200 shadow-2xl overflow-hidden transform transition-all max-h-[90vh] overflow-y-auto">
            <div id="normModalHeader" class="p-6 pb-4 relative">
                <button id="normModalClose" type="button" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 border border-gray-200 text-gray-500 hover:text-gray-800 hover:bg-white flex items-center justify-center transition-colors">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <span id="normModalEmoji" class="block"></span>
                <h3 id="normModalTitle" class="text-xl font-extrabold text-gray-900 mt-3"></h3>
                <p id="normModalDesc" class="text-sm text-gray-600 leading-relaxed mt-2"></p>
            </div>

            <div class="px-6 pb-6 space-y-4">
                <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                    <h4 class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600 mb-2">Contoh Perilaku</h4>
                    <ul id="normModalExamples" class="space-y-1.5 text-sm text-gray-700"></ul>
                </div>

                <div class="rounded-2xl bg-rose-50/70 border border-rose-100 p-4">
                    <h4 class="text-[11px] font-extrabold uppercase tracking-wider text-rose-600 mb-2">Sanksi Pelanggaran</h4>
                    <ul id="normModalSanctions" class="space-y-1.5 text-sm text-gray-700"></ul>
                </div>

                <button id="normModalOk" type="button" class="w-full px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold transition-colors">
                    Mengerti, Tutup
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const norms = @json($norms);
                const headerPalette = {
                    'blue': 'bg-blue-50',
                    'rose': 'bg-rose-50',
                    'emerald': 'bg-emerald-50',
                    'amber': 'bg-amber-50',
                };

                const modal = document.getElementById('normModal');
                const panel = document.getElementById('normModalPanel');
                const header = document.getElementById('normModalHeader');
                const title = document.getElementById('normModalTitle');
                const desc = document.getElementById('normModalDesc');
                const emoji = document.getElementById('normModalEmoji');
                const examples = document.getElementById('normModalExamples');
                const sanctions = document.getElementById('normModalSanctions');

                const fillList = (element, items) => {
                    element.innerHTML = '';
                    (items || []).forEach((item) => {
                        const li = document.createElement('li');
                        li.className = 'flex items-start gap-2';
                        li.innerHTML = '<span class="text-blue-600 font-bold mt-0.5">•</span><span></span>';
                        li.lastElementChild.textContent = item;
                        element.appendChild(li);
                    });
                };

                const openModal = (norm, card) => {
                    emoji.innerHTML = card.querySelector('[data-illustration]').innerHTML;
                    emoji.firstElementChild.setAttribute('class', emoji.firstElementChild.tagName === 'IMG'
                        ? 'w-full h-64 sm:h-72 rounded-2xl object-cover border-2 border-white shadow-sm'
                        : 'w-40 h-40 mx-auto');
                    title.textContent = norm.name;
                    desc.textContent = norm.description;
                    header.className = 'p-6 pb-4 relative ' + (headerPalette[norm.color] ?? 'bg-slate-50');
                    fillList(examples, norm.examples);
                    fillList(sanctions, norm.sanctions);
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    panel.classList.add('scale-95', 'opacity-0');
                    requestAnimationFrame(() => panel.classList.remove('scale-95', 'opacity-0'));
                };

                const closeModal = () => {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                };

                document.querySelectorAll('.norm-card').forEach((card) => {
                    card.addEventListener('click', () => {
                        const norm = norms[parseInt(card.dataset.normIndex, 10)];
                        if (norm) openModal(norm, card);
                    });
                });

                document.getElementById('normModalClose').addEventListener('click', closeModal);
                document.getElementById('normModalOk').addEventListener('click', closeModal);
                document.getElementById('normModalBackdrop').addEventListener('click', closeModal);
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
                });
            });
        </script>
    @endpush
</x-dashboard-layout>
