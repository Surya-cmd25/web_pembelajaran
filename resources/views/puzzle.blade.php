<x-dashboard-layout title="Puzzle Durkheim" active="puzzle">
    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Tantangan Penutup
            </span>
            <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight mt-1">Puzzle Durkheim</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                Susun 10 keping potret Émile Durkheim ke tempatnya. Selesaikan level untuk membuka rahasia di balik sang bapak sosiologi.
            </p>
        </div>
        <span class="self-start px-3.5 py-1.5 rounded-full border border-blue-100 bg-blue-50 text-blue-700 text-xs font-bold shadow-2xs">
            {{ count($levels) }} Level
        </span>
    </div>

    {{-- Level selector --}}
    <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-gray-900">Pilih Level</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-0.5">
                        Seret keping ke kotak yang sesuai, atau klik keping lalu klik kotaknya. Keping yang salah akan kembali ke baki.
                    </p>
                </div>
            </div>

            <div id="levelTabs" class="flex items-center gap-2">
                @foreach ($levels as $level)
                    @php
                        $levelProgress = $progress->get($level);
                        $isDone = $levelProgress && $levelProgress->is_completed;
                    @endphp
                    <button type="button" data-level="{{ $level }}"
                        class="level-tab px-4 py-2.5 rounded-xl text-xs font-bold border transition-all {{ $level === 1 ? 'border-blue-600 bg-blue-600 text-white shadow-lg shadow-blue-500/25' : 'border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
                        Level {{ $level }}
                        <span class="ml-1 {{ $isDone ? 'text-emerald-400' : ($level === 1 ? 'text-blue-200' : 'text-gray-400') }}">{{ $isDone ? '✓' : '•' }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Board --}}
    <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
        <div class="flex items-center justify-between gap-3 mb-4">
            <div class="flex items-center gap-2.5">
                <span id="levelBadge" class="px-3 py-1 rounded-lg bg-slate-900 text-white text-[11px] font-extrabold uppercase tracking-wider">Level 1</span>
                <span id="placedCounter" class="text-xs font-bold text-gray-500">0/10 keping terpasang</span>
            </div>
            <div class="flex items-center gap-2">
                <button id="resetBtn" type="button"
                    class="px-4 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-600 text-xs font-bold transition-colors">
                    Ulangi
                </button>
                <button id="shuffleTrayBtn" type="button"
                    class="px-4 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-600 text-xs font-bold transition-colors">
                    Acak Baki
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)] gap-6 items-start">
            {{-- Puzzle grid (5 x 2) --}}
            <div>
                <div id="slotGrid" class="grid grid-cols-5 gap-1.5 sm:gap-2 rounded-2xl bg-slate-100 p-1.5 sm:p-2 border border-slate-200">
                    @for ($i = 0; $i < 10; $i++)
                        <div data-slot="{{ $i }}"
                            class="slot relative aspect-[2/3] rounded-lg border-2 border-dashed border-slate-300 bg-white/70 transition-all hover:border-blue-400 hover:bg-blue-50/50 cursor-pointer">
                            <span class="absolute inset-0 flex items-center justify-center text-[11px] sm:text-xs font-extrabold text-slate-300 pointer-events-none">
                                {{ $i + 1 }}
                            </span>
                        </div>
                    @endfor
                </div>
                <p class="text-[11px] text-gray-400 mt-2 text-center">Nomor kotak menunjukkan urutan keping yang benar (1–10, membaca baris atas lalu baris bawah).</p>
            </div>

            {{-- Tray --}}
            <div>
                <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">Baki Keping</h3>
                <div id="tray" class="grid grid-cols-5 gap-1.5 sm:gap-2 rounded-2xl bg-slate-50 border border-slate-200 p-1.5 sm:p-2 min-h-[120px]"></div>

                <div class="mt-4 rounded-2xl bg-blue-50/70 border border-blue-100 p-4">
                    <h4 class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600 mb-1.5">Tujuan Level</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Semua 10 keping harus berada di kotak dengan nomor yang sama. Begitu lengkap, potret Durkheim akan terbuka beserta penjelasannya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Completion panel --}}
    <section id="revealPanel" class="hidden bg-white rounded-3xl border border-blue-200 shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="relative bg-slate-100 min-h-[260px]">
                <img src="{{ asset('images/durkheim.svg') }}" alt="Potret Émile Durkheim"
                    class="absolute inset-0 w-full h-full object-cover" id="revealPortrait">
                <span class="absolute top-4 left-4 px-3 py-1 rounded-lg bg-emerald-500 text-white text-[11px] font-extrabold uppercase tracking-wider shadow-lg">
                    Puzzle Selesai ✓
                </span>
            </div>
            <div class="p-6 sm:p-7">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Tokoh di Balik Puzzle</span>
                <h3 class="text-xl font-extrabold text-gray-900 mt-1">Émile Durkheim (1858–1917)</h3>
                <div class="mt-3 space-y-3 text-sm text-gray-600 leading-relaxed">
                    <p>
                        Émile Durkheim adalah sosiolog Prancis yang diakui sebagai <strong class="text-gray-900">bapak sosiologi modern</strong>.
                        Ia menjadikan sosiologi ilmu yang berdiri sendiri dengan metode ilmiah, bukan cabang filsafat.
                    </p>
                    <p>
                        Dalam karyanya <em class="font-semibold text-gray-900">The Division of Labour in Society</em> (1893), Durkheim memperkenalkan
                        konsep <strong class="text-gray-900">solidaritas sosial</strong>: solidaritas mekanis pada masyarakat tradisional dan
                        solidaritas organik pada masyarakat modern yang saling bergantung.
                    </p>
                    <p>
                        Ia juga pelopor konsep <strong class="text-gray-900">anomie</strong> — keadaan masyarakat kehilangan arah dan pegangan norma —
                        serta menekankan bahwa norma sosial adalah kenyataan nyata yang mengikat individu. Karena itu, memahami norma
                        adalah pintu masuk utama memahami masyarakat.
                    </p>
                </div>
                <div class="mt-5 flex flex-wrap gap-2.5">
                    <span class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-[11px] font-bold border border-blue-100">Solidaritas Sosial</span>
                    <span class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 text-[11px] font-bold border border-amber-100">Anomie</span>
                    <span class="px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-100">Fakta Sosial</span>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const PIECES = 10;
                const LEVELS = @json($levels);
                const progress = @json(
                    $progress->mapWithKeys(fn ($p) => [$p->level => [
                        'placed' => $p->placed,
                        'is_completed' => $p->is_completed,
                    ]])
                );

                const slotGrid = document.getElementById('slotGrid');
                const tray = document.getElementById('tray');
                const levelTabs = document.querySelectorAll('.level-tab');
                const levelBadge = document.getElementById('levelBadge');
                const placedCounter = document.getElementById('placedCounter');
                const resetBtn = document.getElementById('resetBtn');
                const shuffleTrayBtn = document.getElementById('shuffleTrayBtn');
                const revealPanel = document.getElementById('revealPanel');

                /** @type {number} */
                let currentLevel = LEVELS[0];
                /** @type {(number|null)[]} slotIndex => pieceIndex */
                let slots = new Array(PIECES).fill(null);
                /** @type {number[]} piece indices still in the tray */
                let trayPieces = [];
                /** @type {number|null} selected piece (click fallback) */
                let selectedPiece = null;

                const pieceStyle = (pieceIndex) => {
                    const col = pieceIndex % 5;
                    const row = Math.floor(pieceIndex / 5);
                    return `background-image:url('{{ asset('images/durkheim.svg') }}');background-size:500% 200%;background-position:${(col / 4) * 100}% ${(row / 1) * 100}%;`;
                };

                const shuffle = (array) => {
                    const copy = [...array];
                    for (let i = copy.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [copy[i], copy[j]] = [copy[j], copy[i]];
                    }
                    return copy;
                };

                const buildTrayOrder = () => {
                    const all = Array.from({ length: PIECES }, (_, i) => i);
                    if (currentLevel === 1) {
                        // Level 1: mostly ordered with a light shuffle (easier).
                        const reordered = [...all].sort(() => Math.random() - 0.35);
                        return reordered;
                    }
                    return shuffle(all);
                };

                const updateCounter = () => {
                    const placed = slots.filter((piece) => piece !== null).length;
                    placedCounter.textContent = `${placed}/${PIECES} keping terpasang`;
                };

                const showReveal = (show) => {
                    revealPanel.classList.toggle('hidden', !show);
                };

        const saveProgress = async (isCompleted) => {
            const placedEntries = slots.filter((piece) => piece !== null);
            if (placedEntries.length === 0 && !isCompleted) return;

            try {
                const fd = new FormData();
                fd.append('_token', '{{ csrf_token() }}');
                fd.append('level', String(currentLevel));
                fd.append('is_completed', isCompleted ? '1' : '0');
                slots.forEach((piece, index) => {
                    if (piece !== null) fd.append(`placed[${index}]`, String(piece));
                });
                await fetch('{{ route('puzzle.save') }}', {
                            method: 'POST',
                            headers: { 'Accept': 'application/json' },
                            body: fd,
                        });
                    } catch (err) {
                        // Progress save is best-effort; gameplay continues.
                    }
                };

                const markTabDone = (level) => {
                    const tab = document.querySelector(`.level-tab[data-level="${level}"]`);
                    if (!tab) return;
                    const mark = tab.querySelector('span');
                    if (mark) {
                        mark.textContent = '✓';
                        mark.className = 'text-emerald-400';
                    }
                };

                const checkCompletion = () => {
                    const complete = slots.every((piece, index) => piece === index);
                    updateCounter();
                    showReveal(complete);
                    if (complete) {
                        markTabDone(currentLevel);
                        saveProgress(true);
                    }
                    return complete;
                };

                const renderSlots = () => {
                    slotGrid.querySelectorAll('.slot').forEach((slot) => {
                        const index = Number(slot.dataset.slot);
                        const piece = slots[index];
                        const number = slot.querySelector('span');

                        slot.querySelectorAll('.piece').forEach((el) => el.remove());
                        slot.classList.remove('border-blue-500', 'bg-blue-50', 'ring-2', 'ring-blue-300', 'border-emerald-400', 'bg-emerald-50');

                        if (piece !== null) {
                            const el = document.createElement('div');
                            el.className = 'piece absolute inset-0 rounded-md shadow-md cursor-pointer bg-cover bg-center';
                            el.setAttribute('style', pieceStyle(piece));
                            el.dataset.piece = String(piece);
                            el.draggable = true;
                            attachPieceEvents(el);
                            slot.appendChild(el);
                            slot.classList.add('border-emerald-400', 'bg-emerald-50');
                            if (number) number.classList.add('hidden');
                        } else if (number) {
                            number.classList.remove('hidden');
                        }
                    });
                };

                const renderTray = () => {
                    tray.innerHTML = '';
                    trayPieces.forEach((piece) => {
                        const el = document.createElement('div');
                        el.className = 'piece relative aspect-[2/3] rounded-lg shadow-sm cursor-grab active:cursor-grabbing bg-cover bg-center transition-transform hover:scale-105';
                        el.setAttribute('style', pieceStyle(piece));
                        el.dataset.piece = String(piece);
                        el.draggable = true;
                        if (selectedPiece === piece) {
                            el.classList.add('ring-2', 'ring-blue-500', 'scale-105');
                        }
                        attachPieceEvents(el);
                        tray.appendChild(el);
                    });
                };

                const returnPieceToTray = (piece) => {
                    if (!trayPieces.includes(piece)) trayPieces.push(piece);
                };

                const placePiece = (piece, slotIndex) => {
                    const current = slots[slotIndex];
                    if (current === piece) return;

                    // Piece must match the slot number; otherwise it goes back.
                    if (piece !== slotIndex) {
                        const slot = slotGrid.querySelector(`[data-slot="${slotIndex}"]`);
                        if (slot) {
                            slot.classList.add('border-rose-400', 'bg-rose-50');
                            setTimeout(() => slot.classList.remove('border-rose-400', 'bg-rose-50'), 450);
                        }
                        returnPieceToTray(piece);
                        renderTray();
                        return;
                    }

                    // If the target slot already holds another piece, send it back.
                    if (current !== null && current !== piece) returnPieceToTray(current);

                    const trayIndex = trayPieces.indexOf(piece);
                    if (trayIndex !== -1) trayPieces.splice(trayIndex, 1);

                    // If this piece sits in another slot, clear that slot.
                    const previousSlot = slots.indexOf(piece);
                    if (previousSlot !== -1 && previousSlot !== slotIndex) slots[previousSlot] = null;

                    slots[slotIndex] = piece;
                    selectedPiece = null;
                    renderSlots();
                    renderTray();

                    if (!checkCompletion()) saveProgress(false);
                };

                const pickUpFromSlot = (slotIndex) => {
                    const piece = slots[slotIndex];
                    if (piece === null) return;
                    slots[slotIndex] = null;
                    trayPieces.push(piece);
                    selectedPiece = null;
                    renderSlots();
                    renderTray();
                    updateCounter();
                };

                const attachPieceEvents = (el) => {
                    el.addEventListener('dragstart', (e) => {
                        e.dataTransfer.setData('text/plain', el.dataset.piece);
                        e.dataTransfer.effectAllowed = 'move';
                    });

                    el.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const piece = Number(el.dataset.piece);
                        const inTray = tray.contains(el);

                        if (inTray) {
                            selectedPiece = selectedPiece === piece ? null : piece;
                            renderTray();
                            return;
                        }

                        // Click a placed piece to take it back to the tray.
                        const slot = el.closest('.slot');
                        if (slot) pickUpFromSlot(Number(slot.dataset.slot));
                    });
                };

                slotGrid.querySelectorAll('.slot').forEach((slot) => {
                    slot.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        e.dataTransfer.dropEffect = 'move';
                        slot.classList.add('border-blue-500', 'bg-blue-50', 'ring-2', 'ring-blue-300');
                    });
                    slot.addEventListener('dragleave', () => {
                        slot.classList.remove('border-blue-500', 'bg-blue-50', 'ring-2', 'ring-blue-300');
                    });
                    slot.addEventListener('drop', (e) => {
                        e.preventDefault();
                        slot.classList.remove('border-blue-500', 'bg-blue-50', 'ring-2', 'ring-blue-300');
                        const piece = Number(e.dataTransfer.getData('text/plain'));
                        if (!Number.isNaN(piece)) placePiece(piece, Number(slot.dataset.slot));
                    });
                    slot.addEventListener('click', () => {
                        if (selectedPiece !== null) placePiece(selectedPiece, Number(slot.dataset.slot));
                    });
                });

                tray.addEventListener('click', () => {
                    if (selectedPiece !== null) {
                        selectedPiece = null;
                        renderTray();
                    }
                });

                resetBtn.addEventListener('click', () => loadLevel(currentLevel, false));
                shuffleTrayBtn.addEventListener('click', () => {
                    trayPieces = shuffle(trayPieces);
                    renderTray();
                });

                levelTabs.forEach((tab) => {
                    tab.addEventListener('click', () => loadLevel(Number(tab.dataset.level), true));
                });

                const setActiveTab = (level) => {
                    levelTabs.forEach((tab) => {
                        const isActive = Number(tab.dataset.level) === level;
                        tab.className = `level-tab px-4 py-2.5 rounded-xl text-xs font-bold border transition-all ${isActive
                            ? 'border-blue-600 bg-blue-600 text-white shadow-lg shadow-blue-500/25'
                            : 'border-gray-200 bg-white text-gray-600 hover:bg-gray-50'}`;
                        const mark = tab.querySelector('span');
                        const isDone = progress[level] && progress[level].is_completed;
                        if (mark) {
                            mark.textContent = isDone ? '✓' : '•';
                            mark.className = isDone ? 'text-emerald-400' : (isActive ? 'text-blue-200' : 'text-gray-400');
                        }
                    });
                };

                function loadLevel(level, resetIfSame) {
                    currentLevel = level;
                    slots = new Array(PIECES).fill(null);
                    trayPieces = buildTrayOrder();
                    selectedPiece = null;

                    levelBadge.textContent = `Level ${level}`;
                    setActiveTab(level);

                    // Restore saved progress if it exists and is not just a fresh start.
                    const saved = progress[level];
                    if (saved && Array.isArray(saved.placed) && saved.placed.length > 0) {
                        saved.placed.forEach((piece, slotIndex) => {
                            if (piece >= 0 && piece < PIECES && slots[slotIndex] === null) {
                                slots[slotIndex] = piece;
                                const trayIndex = trayPieces.indexOf(piece);
                                if (trayIndex !== -1) trayPieces.splice(trayIndex, 1);
                            }
                        });
                    }

                    renderSlots();
                    renderTray();
                    updateCounter();
                    showReveal(slots.every((piece, index) => piece === index));
                }

                loadLevel(LEVELS[0], true);
            });
        </script>
    @endpush
</x-dashboard-layout>
