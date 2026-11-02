<x-dashboard-layout title="Puzzle" active="puzzle">
    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
            <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight mt-1">Puzzle</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                Susun keping gambar ke tempatnya sebelum waktu habis. Makin tinggi levelnya, makin banyak keping dan makin sedikit petunjuknya.
            </p>
        </div>
        <span class="self-start px-3.5 py-1.5 rounded-full border border-blue-100 bg-blue-50 text-blue-700 text-xs font-bold shadow-2xs">
            {{ $levels->count() }} Level
        </span>
    </div>

    @if ($levels->isEmpty())
        <div class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-10 text-center">
            <p class="text-sm font-semibold text-gray-500">Belum ada level puzzle. Guru sedang menyiapkannya.</p>
        </div>
    @else
        {{-- Level selector --}}
        <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
            <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-3">Pilih Level</h3>
            <div id="levelTabs" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3"></div>
        </section>

        {{-- Board --}}
        <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                <div class="flex flex-wrap items-center gap-2.5">
                    <span id="levelBadge" class="px-3 py-1 rounded-lg bg-slate-900 text-white text-[11px] font-extrabold uppercase tracking-wider"></span>
                    <span id="difficultyBadge" class="px-3 py-1 rounded-lg text-[11px] font-extrabold uppercase tracking-wider"></span>
                    <span id="placedCounter" class="text-xs font-bold text-gray-500"></span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900 text-white">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span id="timerText" class="font-mono text-sm font-bold tracking-widest">00:00</span>
                    </div>
                    <button id="resetBtn" type="button" class="px-4 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-600 text-xs font-bold transition-colors">Ulangi</button>
                    <button id="shuffleTrayBtn" type="button" class="px-4 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-600 text-xs font-bold transition-colors">Acak Baki</button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)] gap-6 items-start">
                <div>
                    <div class="relative">
                        <div id="slotGrid" class="grid gap-1 rounded-2xl bg-slate-100 p-1.5 border border-slate-200 w-full"></div>

                        {{-- Overlay mulai / waktu habis --}}
                        <div id="boardOverlay" class="absolute inset-0 rounded-2xl bg-slate-900/80 backdrop-blur-sm flex flex-col items-center justify-center text-center p-6 z-10">
                            <p id="overlayTitle" class="text-lg font-extrabold text-white"></p>
                            <p id="overlayText" class="text-xs text-slate-300 mt-1.5 max-w-xs leading-relaxed"></p>
                            <button id="startBtn" type="button" class="mt-5 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold shadow-lg shadow-blue-500/30 transition-colors">Mulai</button>
                        </div>
                    </div>
                    <p id="slotHint" class="text-[11px] text-gray-400 mt-2 text-center"></p>
                </div>

                <div>
                    <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">Baki Keping</h3>
                    <div id="tray" class="grid gap-1.5 sm:gap-2 rounded-2xl bg-slate-50 border border-slate-200 p-1.5 sm:p-2 min-h-[120px]"></div>

                    <div id="previewBox" class="mt-4 rounded-2xl bg-blue-50/70 border border-blue-100 p-4">
                        <h4 class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600 mb-2">Gambar Acuan</h4>
                        <img id="previewImg" src="" alt="Gambar acuan puzzle" class="w-full max-h-40 object-contain rounded-xl bg-white border border-blue-100">
                    </div>
                    <div class="mt-3 rounded-2xl bg-slate-50 border border-slate-200 p-4">
                        <h4 class="text-[11px] font-extrabold uppercase tracking-wider text-gray-500 mb-1.5">Aturan Level</h4>
                        <ul id="levelRules" class="space-y-1 text-xs text-gray-600 leading-relaxed"></ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Completion panel --}}
        <section id="revealPanel" class="hidden bg-white rounded-3xl border border-blue-200 shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="relative bg-slate-100 min-h-[260px]">
                    <img id="revealPortrait" src="" alt="Gambar puzzle selesai" class="absolute inset-0 w-full h-full object-cover">
                    <span class="absolute top-4 left-4 px-3 py-1 rounded-lg bg-emerald-500 text-white text-[11px] font-extrabold uppercase tracking-wider shadow-lg">
                        Puzzle Selesai ✓
                    </span>
                </div>
                <div class="p-6 sm:p-7">
                    <span id="revealTime" class="text-xs font-bold text-blue-600 uppercase tracking-wider"></span>
                    <h3 id="revealTitle" class="text-xl font-extrabold text-gray-900 mt-1"></h3>
                    <p id="revealDesc" class="mt-3 text-sm text-gray-600 leading-relaxed whitespace-pre-line"></p>
                    <button id="nextLevelBtn" type="button" class="hidden mt-5 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold transition-colors">Lanjut ke Level Berikutnya →</button>
                </div>
            </div>
        </section>
    @endif

    @if ($levels->isNotEmpty())
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const LEVELS = @json($levels);
                    const progress = @json($progress->mapWithKeys(fn ($p) => [$p->level => ['is_completed' => $p->is_completed, 'best_seconds' => $p->best_seconds]]));
                    const DIFFICULTY = {
                        1: ['Pemula', 'bg-emerald-50 text-emerald-700'],
                        2: ['Mudah', 'bg-teal-50 text-teal-700'],
                        3: ['Sedang', 'bg-amber-50 text-amber-700'],
                        4: ['Sulit', 'bg-orange-50 text-orange-700'],
                        5: ['Pakar', 'bg-rose-50 text-rose-700'],
                    };

                    const slotGrid = document.getElementById('slotGrid');
                    const tray = document.getElementById('tray');
                    const levelTabs = document.getElementById('levelTabs');
                    const levelBadge = document.getElementById('levelBadge');
                    const difficultyBadge = document.getElementById('difficultyBadge');
                    const placedCounter = document.getElementById('placedCounter');
                    const timerText = document.getElementById('timerText');
                    const resetBtn = document.getElementById('resetBtn');
                    const shuffleTrayBtn = document.getElementById('shuffleTrayBtn');
                    const boardOverlay = document.getElementById('boardOverlay');
                    const overlayTitle = document.getElementById('overlayTitle');
                    const overlayText = document.getElementById('overlayText');
                    const startBtn = document.getElementById('startBtn');
                    const slotHint = document.getElementById('slotHint');
                    const previewBox = document.getElementById('previewBox');
                    const previewImg = document.getElementById('previewImg');
                    const levelRules = document.getElementById('levelRules');
                    const revealPanel = document.getElementById('revealPanel');
                    const revealPortrait = document.getElementById('revealPortrait');
                    const revealTitle = document.getElementById('revealTitle');
                    const revealDesc = document.getElementById('revealDesc');
                    const revealTime = document.getElementById('revealTime');
                    const nextLevelBtn = document.getElementById('nextLevelBtn');

                    let cfg = LEVELS[0];
                    let total = 0;
                    let strict = true;
                    let showNumbers = true;
                    let aspect = 1.5;
                    let slots = [];
                    let trayPieces = [];
                    let selectedPiece = null;
                    let running = false;
                    let remaining = 0;
                    let elapsed = 0;
                    let timer = null;

                    const pad = (n) => String(n).padStart(2, '0');
                    const fmt = (s) => `${pad(Math.floor(s / 60))}:${pad(s % 60)}`;
                    const shuffle = (array) => {
                        const copy = [...array];
                        for (let i = copy.length - 1; i > 0; i--) {
                            const j = Math.floor(Math.random() * (i + 1));
                            [copy[i], copy[j]] = [copy[j], copy[i]];
                        }
                        return copy;
                    };

                    const pieceStyle = (index) => {
                        const col = index % cfg.cols;
                        const row = Math.floor(index / cfg.cols);
                        const x = cfg.cols > 1 ? (col / (cfg.cols - 1)) * 100 : 0;
                        const y = cfg.rows > 1 ? (row / (cfg.rows - 1)) * 100 : 0;
                        return `background-image:url('${cfg.image}');background-size:${cfg.cols * 100}% ${cfg.rows * 100}%;background-position:${x}% ${y}%;`;
                    };

                    const pieceAspect = () => (aspect * cfg.rows) / cfg.cols;

                    /* ---------- Timer ---------- */
                    const renderTimer = () => { timerText.textContent = fmt(remaining); timerText.classList.toggle('text-rose-300', running && remaining <= 15); };
                    const stopTimer = () => { clearInterval(timer); timer = null; running = false; };
                    const startTimer = () => {
                        stopTimer();
                        running = true;
                        remaining = cfg.time_limit;
                        elapsed = 0;
                        renderTimer();
                        timer = setInterval(() => {
                            remaining -= 1;
                            elapsed += 1;
                            renderTimer();
                            if (remaining <= 0) timeUp();
                        }, 1000);
                    };

                    const showOverlay = (title, text, button) => {
                        overlayTitle.textContent = title;
                        overlayText.textContent = text;
                        startBtn.textContent = button;
                        boardOverlay.classList.remove('hidden');
                    };

                    const timeUp = () => {
                        stopTimer();
                        remaining = 0;
                        renderTimer();
                        showOverlay('Waktu habis ⏰', `Kamu baru memasang ${slots.filter((p) => p === slots.indexOf(p)).length} keping dengan benar. Coba lagi untuk memecahkan rekormu.`, 'Coba Lagi');
                    };

                    /* ---------- Rendering ---------- */
                    const updateCounter = () => {
                        const placed = slots.filter((piece) => piece !== null).length;
                        placedCounter.textContent = `${placed}/${total} keping terpasang`;
                    };

                    const renderSlots = () => {
                        slotGrid.querySelectorAll('.slot').forEach((slot) => {
                            const index = Number(slot.dataset.slot);
                            const piece = slots[index];
                            slot.querySelectorAll('.piece').forEach((el) => el.remove());
                            const number = slot.querySelector('span');
                            slot.classList.remove('border-emerald-400', 'bg-emerald-50');
                            if (piece !== null) {
                                const el = document.createElement('div');
                                el.className = 'piece absolute inset-0 rounded-md shadow-md cursor-pointer';
                                el.setAttribute('style', pieceStyle(piece));
                                el.dataset.piece = String(piece);
                                el.draggable = true;
                                attachPieceEvents(el);
                                slot.appendChild(el);
                                if (strict) slot.classList.add('border-emerald-400', 'bg-emerald-50');
                                if (number) number.classList.add('hidden');
                            } else if (number) {
                                number.classList.toggle('hidden', !showNumbers);
                            }
                        });
                    };

                    const renderTray = () => {
                        tray.innerHTML = '';
                        trayPieces.forEach((piece) => {
                            const el = document.createElement('div');
                            el.className = 'piece relative rounded-lg shadow-sm cursor-grab active:cursor-grabbing transition-transform hover:scale-105';
                            el.setAttribute('style', pieceStyle(piece) + `aspect-ratio:${pieceAspect()};`);
                            el.dataset.piece = String(piece);
                            el.draggable = true;
                            if (selectedPiece === piece) el.classList.add('ring-2', 'ring-blue-500', 'scale-105');
                            attachPieceEvents(el);
                            tray.appendChild(el);
                        });
                    };

                    const buildGrid = () => {
                        slotGrid.style.gridTemplateColumns = `repeat(${cfg.cols}, minmax(0, 1fr))`;
                        slotGrid.style.gridTemplateRows = `repeat(${cfg.rows}, minmax(0, 1fr))`;
                        slotGrid.style.aspectRatio = String(aspect);
                        slotGrid.innerHTML = '';
                        for (let i = 0; i < total; i++) {
                            const slot = document.createElement('div');
                            slot.dataset.slot = String(i);
                            slot.className = 'slot relative rounded-lg border-2 border-dashed border-slate-300 bg-white/70 transition-all hover:border-blue-400 hover:bg-blue-50/50 cursor-pointer';
                            slot.innerHTML = `<span class="absolute inset-0 flex items-center justify-center text-[11px] sm:text-sm font-extrabold text-slate-300 pointer-events-none">${i + 1}</span>`;
                            attachSlotEvents(slot);
                            slotGrid.appendChild(slot);
                        }
                        tray.style.gridTemplateColumns = `repeat(auto-fill, minmax(${total > 12 ? 56 : 72}px, 1fr))`;
                    };

                    /* ---------- Game logic ---------- */
                    const isComplete = () => slots.every((piece, index) => piece === index);

                    const save = async (completed) => {
                        try {
                            const fd = new FormData();
                            fd.append('_token', '{{ csrf_token() }}');
                            fd.append('level', String(cfg.level));
                            fd.append('is_completed', completed ? '1' : '0');
                            fd.append('seconds', String(elapsed));
                            slots.forEach((piece, index) => { if (piece !== null) fd.append(`placed[${index}]`, String(piece)); });
                            const res = await fetch('{{ route('puzzle.save') }}', { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd });
                            return res.ok ? await res.json() : null;
                        } catch (err) {
                            return null;
                        }
                    };

                    const finish = async () => {
                        stopTimer();
                        const used = elapsed;
                        const data = await save(true);
                        const best = data && data.best_seconds != null ? data.best_seconds : used;
                        progress[cfg.level] = { is_completed: true, best_seconds: best };
                        renderTabs();
                        revealPortrait.src = cfg.image;
                        revealTitle.textContent = cfg.title;
                        revealDesc.textContent = cfg.description || 'Hebat! Kamu berhasil menyusun puzzle ini.';
                        revealTime.textContent = `Selesai dalam ${fmt(used)} · rekor terbaik ${fmt(best)}`;
                        const idx = LEVELS.findIndex((l) => l.level === cfg.level);
                        nextLevelBtn.classList.toggle('hidden', idx === LEVELS.length - 1);
                        revealPanel.classList.remove('hidden');
                        revealPanel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    };

                    const checkCompletion = () => {
                        updateCounter();
                        if (isComplete()) finish();
                    };

                    const rejectSlot = (slotIndex) => {
                        const slot = slotGrid.querySelector(`[data-slot="${slotIndex}"]`);
                        if (!slot) return;
                        slot.classList.add('border-rose-400', 'bg-rose-50');
                        setTimeout(() => slot.classList.remove('border-rose-400', 'bg-rose-50'), 450);
                    };

                    const placePiece = (piece, slotIndex) => {
                        if (!running) return;
                        const current = slots[slotIndex];
                        if (current === piece) return;

                        if (strict && piece !== slotIndex) {
                            rejectSlot(slotIndex);
                            if (!trayPieces.includes(piece) && slots.indexOf(piece) === -1) trayPieces.push(piece);
                            renderTray();
                            return;
                        }

                        if (current !== null) trayPieces.push(current);
                        const trayIndex = trayPieces.indexOf(piece);
                        if (trayIndex !== -1) trayPieces.splice(trayIndex, 1);
                        const previousSlot = slots.indexOf(piece);
                        if (previousSlot !== -1) slots[previousSlot] = null;

                        slots[slotIndex] = piece;
                        selectedPiece = null;
                        renderSlots();
                        renderTray();
                        checkCompletion();
                    };

                    const pickUpFromSlot = (slotIndex) => {
                        if (!running) return;
                        const piece = slots[slotIndex];
                        if (piece === null) return;
                        slots[slotIndex] = null;
                        trayPieces.push(piece);
                        selectedPiece = null;
                        renderSlots();
                        renderTray();
                        updateCounter();
                    };

                    function attachPieceEvents(el) {
                        el.addEventListener('dragstart', (e) => {
                            if (!running) { e.preventDefault(); return; }
                            e.dataTransfer.setData('text/plain', el.dataset.piece);
                            e.dataTransfer.effectAllowed = 'move';
                        });
                        el.addEventListener('click', (e) => {
                            e.stopPropagation();
                            if (!running) return;
                            const piece = Number(el.dataset.piece);
                            if (tray.contains(el)) {
                                selectedPiece = selectedPiece === piece ? null : piece;
                                renderTray();
                                return;
                            }
                            const slot = el.closest('.slot');
                            if (slot) pickUpFromSlot(Number(slot.dataset.slot));
                        });
                    }

                    function attachSlotEvents(slot) {
                        const on = 'border-blue-500 bg-blue-50 ring-2 ring-blue-300'.split(' ');
                        slot.addEventListener('dragover', (e) => { e.preventDefault(); slot.classList.add(...on); });
                        slot.addEventListener('dragleave', () => slot.classList.remove(...on));
                        slot.addEventListener('drop', (e) => {
                            e.preventDefault();
                            slot.classList.remove(...on);
                            const piece = Number(e.dataTransfer.getData('text/plain'));
                            if (!Number.isNaN(piece)) placePiece(piece, Number(slot.dataset.slot));
                        });
                        slot.addEventListener('click', () => {
                            if (selectedPiece !== null) placePiece(selectedPiece, Number(slot.dataset.slot));
                        });
                    }

                    tray.addEventListener('click', () => {
                        if (selectedPiece !== null) { selectedPiece = null; renderTray(); }
                    });

                    /* ---------- Level handling ---------- */
                    function renderTabs() {
                        levelTabs.innerHTML = '';
                        LEVELS.forEach((l) => {
                            const active = l.level === cfg.level;
                            const done = progress[l.level] && progress[l.level].is_completed;
                            const best = progress[l.level] && progress[l.level].best_seconds != null ? ` · ${fmt(progress[l.level].best_seconds)}` : '';
                            const [name] = DIFFICULTY[l.level] || ['Level', ''];
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.className = `text-left px-4 py-3 rounded-2xl border transition-all ${active ? 'border-blue-600 bg-blue-600 text-white shadow-lg shadow-blue-500/25' : 'border-gray-200 bg-white text-gray-700 hover:bg-gray-50'}`;
                            btn.innerHTML = `
                                <span class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-extrabold uppercase tracking-wider">Level ${l.level}</span>
                                    <span class="${done ? (active ? 'text-emerald-300' : 'text-emerald-500') : 'opacity-0'} text-sm font-extrabold">✓</span>
                                </span>
                                <span class="block text-sm font-bold mt-1">${name}</span>
                                <span class="block text-[11px] mt-0.5 ${active ? 'text-blue-100' : 'text-gray-400'}">${l.cols}×${l.rows} · ${l.cols * l.rows} keping · ${fmt(l.time_limit)}${best}</span>`;
                            btn.addEventListener('click', () => loadLevel(l.level));
                            levelTabs.appendChild(btn);
                        });
                    }

                    const measureImage = (src) => new Promise((resolve) => {
                        const img = new Image();
                        img.onload = () => resolve(img.naturalWidth && img.naturalHeight ? img.naturalWidth / img.naturalHeight : 1.5);
                        img.onerror = () => resolve(1.5);
                        img.src = src;
                    });

                    async function loadLevel(level) {
                        stopTimer();
                        cfg = LEVELS.find((l) => l.level === level) || LEVELS[0];
                        total = cfg.rows * cfg.cols;
                        strict = cfg.level <= 2;
                        showNumbers = cfg.level <= 3;
                        aspect = Math.min(Math.max(await measureImage(cfg.image), 0.6), 2.2);
                        slots = new Array(total).fill(null);
                        trayPieces = shuffle(Array.from({ length: total }, (_, i) => i));
                        selectedPiece = null;

                        const [dName, dClass] = DIFFICULTY[cfg.level] || ['Level', 'bg-slate-100 text-slate-700'];
                        levelBadge.textContent = `Level ${cfg.level}`;
                        difficultyBadge.textContent = dName;
                        difficultyBadge.className = `px-3 py-1 rounded-lg text-[11px] font-extrabold uppercase tracking-wider ${dClass}`;

                        previewBox.classList.toggle('hidden', cfg.level > 2);
                        previewImg.src = cfg.image;
                        levelRules.innerHTML = [
                            `Susun ${total} keping (${cfg.cols} kolom × ${cfg.rows} baris).`,
                            `Batas waktu ${fmt(cfg.time_limit)}.`,
                            strict ? 'Keping yang salah tempat otomatis kembali ke baki.' : 'Keping boleh ditaruh di mana saja — kamu harus menilai sendiri letak yang benar.',
                            showNumbers ? 'Nomor kotak ditampilkan sebagai petunjuk.' : 'Tidak ada nomor petunjuk di kotak.',
                            cfg.level <= 2 ? 'Gambar acuan ditampilkan.' : 'Gambar acuan disembunyikan.',
                        ].map((t) => `<li>• ${t}</li>`).join('');
                        slotHint.textContent = showNumbers
                            ? 'Nomor kotak menunjukkan urutan keping yang benar (membaca baris demi baris).'
                            : 'Level ini tanpa nomor petunjuk. Ingat gambarnya baik-baik!';

                        revealPanel.classList.add('hidden');
                        buildGrid();
                        renderSlots();
                        renderTray();
                        updateCounter();
                        remaining = cfg.time_limit;
                        renderTimer();
                        renderTabs();
                        showOverlay(`Level ${cfg.level} · ${dName}`, `${total} keping, waktu ${fmt(cfg.time_limit)}. Waktu mulai berjalan setelah kamu menekan tombol.`, 'Mulai');
                    }

                    startBtn.addEventListener('click', () => {
                        boardOverlay.classList.add('hidden');
                        slots = new Array(total).fill(null);
                        trayPieces = shuffle(Array.from({ length: total }, (_, i) => i));
                        selectedPiece = null;
                        revealPanel.classList.add('hidden');
                        renderSlots();
                        renderTray();
                        updateCounter();
                        startTimer();
                    });

                    resetBtn.addEventListener('click', () => loadLevel(cfg.level));
                    shuffleTrayBtn.addEventListener('click', () => { trayPieces = shuffle(trayPieces); renderTray(); });
                    nextLevelBtn.addEventListener('click', () => {
                        const idx = LEVELS.findIndex((l) => l.level === cfg.level);
                        if (LEVELS[idx + 1]) { loadLevel(LEVELS[idx + 1].level); window.scrollTo({ top: 0, behavior: 'smooth' }); }
                    });

                    loadLevel(LEVELS[0].level);
                });
            </script>
        @endpush
    @endif
</x-dashboard-layout>
