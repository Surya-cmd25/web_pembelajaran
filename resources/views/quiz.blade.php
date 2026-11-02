<x-dashboard-layout title="Quiz Mencocokkan" active="quiz">
    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Game Interaktif
            </span>
            <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight mt-1">Quiz Mencocokkan</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                Cocokkan situasi sehari-hari dengan jenis norma yang sesuai. Tarik garis antarkartu atau klik kedua kartu.
            </p>
        </div>
        <div class="flex items-center gap-2.5 self-start sm:self-auto">
            @if ($latestScore)
                <span class="px-3.5 py-1.5 rounded-full border border-gray-200 bg-white text-gray-700 text-xs font-bold shadow-2xs">
                    Skor terakhir: {{ $latestScore->score }}/{{ $latestScore->total }}
                </span>
            @endif
            <span class="px-3.5 py-1.5 rounded-full border border-blue-100 bg-blue-50 text-blue-700 text-xs font-bold shadow-2xs">
                {{ $pairCount }} pasangan tersedia
            </span>
        </div>
    </div>

    {{-- How to play --}}
    <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center gap-4 justify-between">
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-gray-900">Cara Bermain</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-0.5">
                        3 situasi per ronde. Klik situasi lalu klik norma (atau tarik garis dengan mouse) untuk menghubungkannya. Tekan
                        <span class="font-semibold text-gray-700">Periksa Jawaban</span> setelah ketiganya terpasang.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2.5">
                <button id="checkBtn" type="button" disabled
                    class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-lg shadow-blue-500/25 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none">
                    Periksa Jawaban
                </button>
                <button id="shuffleBtn" type="button"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-xs font-bold transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 4v5h5M20 20v-5h-5M5.6 15A8 8 0 0018.4 17M18.4 9A8 8 0 005.6 7"/>
                    </svg>
                    Acak Contoh Baru
                </button>
            </div>
        </div>
    </section>

    {{-- Board --}}
    <section id="board" class="relative bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
        <svg id="lineLayer" class="hidden lg:block absolute inset-0 w-full h-full pointer-events-none z-10" aria-hidden="true"></svg>

        <div id="boardLoading" class="text-center text-sm text-gray-400 py-10">Memuat ronde baru…</div>

        <div id="boardGrid" class="hidden grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-x-28 items-start">
            {{-- Situations --}}
            <div class="space-y-3">
                <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Situasi Sehari-hari</h3>
                <div id="situationList" class="space-y-4"></div>
            </div>

            {{-- Norm options --}}
            <div class="space-y-3">
                <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Jenis Norma</h3>
                <div id="normList" class="space-y-4"></div>
            </div>
        </div>
    </section>

    {{-- Result summary --}}
    <section id="resultBox" class="hidden bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
            <div class="flex items-center gap-4">
                <div id="resultRing" class="w-16 h-16 rounded-2xl flex items-center justify-center text-lg font-extrabold"></div>
                <div>
                    <h3 class="text-base font-extrabold text-gray-900">Hasil Ronde Ini</h3>
                    <p id="resultText" class="text-xs text-gray-500 mt-0.5"></p>
                </div>
            </div>
            <button id="playAgainBtn" type="button"
                class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-lg shadow-blue-500/25 transition-all">
                Main Lagi
            </button>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const NORM_LABELS = {
                    agama: 'Norma Agama',
                    kesusilaan: 'Norma Kesusilaan',
                    kesopanan: 'Norma Kesopanan',
                    hukum: 'Norma Hukum',
                };
                const ICON = {
                    user: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    ban: 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636',
                    trash: 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
                    book: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    chat: 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                    home: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    mosque: 'M3 21h18M5 21V10l7-6 7 6v11M9 21v-6h6v6',
                    heart: 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    thumb: 'M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5',
                    scale: 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3',
                };
                const NORM_META = {
                    agama: { icon: 'mosque', tile: 'bg-blue-50 text-blue-600', desc: 'Bersumber dari ajaran & wahyu Tuhan' },
                    kesusilaan: { icon: 'heart', tile: 'bg-amber-50 text-amber-500', desc: 'Bersumber dari bisikan hati sanubari' },
                    kesopanan: { icon: 'thumb', tile: 'bg-violet-50 text-violet-600', desc: 'Tata krama & pergaulan antar sesama' },
                    hukum: { icon: 'scale', tile: 'bg-emerald-50 text-emerald-600', desc: 'Aturan resmi mengikat bersanksi tegas' },
                };
                const SITUATION_TILES = [
                    { icon: 'user', tile: 'bg-amber-50 text-amber-600' },
                    { icon: 'ban', tile: 'bg-rose-50 text-rose-500' },
                    { icon: 'trash', tile: 'bg-teal-50 text-teal-600' },
                    { icon: 'book', tile: 'bg-indigo-50 text-indigo-600' },
                    { icon: 'chat', tile: 'bg-sky-50 text-sky-600' },
                    { icon: 'home', tile: 'bg-orange-50 text-orange-600' },
                ];
                const svgIcon = (name, cls = 'w-6 h-6') => `<svg class="${cls}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="${ICON[name]}"/></svg>`;

                const board = document.getElementById('board');
                const lineLayer = document.getElementById('lineLayer');
                const situationList = document.getElementById('situationList');
                const normList = document.getElementById('normList');
                const boardGrid = document.getElementById('boardGrid');
                const boardLoading = document.getElementById('boardLoading');
                const checkBtn = document.getElementById('checkBtn');
                const shuffleBtn = document.getElementById('shuffleBtn');
                const playAgainBtn = document.getElementById('playAgainBtn');
                const resultBox = document.getElementById('resultBox');
                const resultRing = document.getElementById('resultRing');
                const resultText = document.getElementById('resultText');

                // @type Array<{id: number, situation: string}>
                let pairs = [];
                /** @type {string[]} */
                let norms = [];
                /** @type {Map<number, string>} pairId => normKey */
                let connections = new Map();
                let selected = null; // {type:'situation'|'norm', id: number|string}
                let results = null; // Map pairId => result
                let submitting = false;

                const svgEl = (name) => document.createElementNS('http://www.w3.org/2000/svg', name);

                const anchor = (element, side) => {
                    const r = element.getBoundingClientRect();
                    const b = board.getBoundingClientRect();
                    return {
                        x: (side === 'right' ? r.right : r.left) - b.left,
                        y: r.top + r.height / 2 - b.top,
                    };
                };

                const drawLine = (x1, y1, x2, y2, color, width) => {
                    const path = svgEl('path');
                    const midX = (x1 + x2) / 2;
                    path.setAttribute('d', `M ${x1} ${y1} C ${midX} ${y1}, ${midX} ${y2}, ${x2} ${y2}`);
                    path.setAttribute('fill', 'none');
                    path.setAttribute('stroke', color);
                    path.setAttribute('stroke-width', width);
                    path.setAttribute('stroke-linecap', 'round');
                    lineLayer.appendChild(path);
                };

                const redraw = () => {
                    lineLayer.innerHTML = '';
                    if (results === null && selected) {
                        const el = selected.type === 'situation'
                            ? situationList.querySelector(`[data-pair-id="${selected.id}"]`)
                            : normList.querySelector(`[data-norm="${selected.id}"]`);
                        if (el) {
                            const from = selected.type === 'situation' ? anchor(el, 'right') : anchor(el, 'left');
                            drawLine(from.x, from.y, from.x + (selected.type === 'situation' ? 28 : -28), from.y, '#93C5FD', 3);
                        }
                    }

                    connections.forEach((normKey, pairId) => {
                        const situationEl = situationList.querySelector(`[data-pair-id="${pairId}"]`);
                        const normEl = normList.querySelector(`[data-norm="${normKey}"]`);
                        if (!situationEl || !normEl) return;

                        const result = results ? results.get(pairId) : null;
                        const color = result && !result.is_correct ? '#F43F5E' : '#10B981';

                        drawLine(anchor(situationEl, 'right').x, anchor(situationEl, 'right').y,
                            anchor(normEl, 'left').x, anchor(normEl, 'left').y, color, 2.5);
                    });
                };

                const updateCheckState = () => {
                    checkBtn.disabled = results !== null || submitting || connections.size < pairs.length || pairs.length === 0;
                };

                const cardState = (selectedNow, connected, result) => {
                    if (result) {
                        return result.is_correct
                            ? { border: 'border-emerald-400', dot: 'border-emerald-500' }
                            : { border: 'border-rose-300', dot: 'border-rose-400' };
                    }
                    if (selectedNow) return { border: 'border-blue-400 ring-2 ring-blue-100', dot: 'border-blue-500' };
                    if (connected) return { border: 'border-emerald-400', dot: 'border-emerald-500' };
                    return { border: 'border-gray-200 hover:border-emerald-300', dot: 'border-gray-300' };
                };

                const CHECK_PATH = 'M5 13l4 4L19 7';
                const CROSS_PATH = 'M6 18L18 6M6 6l12 12';
                const badge = (cls, path) => `<span class="w-6 h-6 rounded-full ${cls} flex items-center justify-center shrink-0"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="${path}"/></svg></span>`;

                const renderSituations = () => {
                    situationList.innerHTML = '';
                    pairs.forEach((pair) => {
                        const chosenNorm = connections.get(pair.id);
                        const result = results ? results.get(pair.id) : null;
                        const isSelected = selected?.type === 'situation' && selected.id === pair.id;
                        const state = cardState(isSelected, !!chosenNorm, result);
                        const tile = SITUATION_TILES[pair.id % SITUATION_TILES.length];

                        let status = '<span class="text-[11px] text-gray-400">Belum dihubungkan</span>';
                        if (result) {
                            status = result.is_correct
                                ? '<span class="text-[11px] font-semibold text-emerald-600">Terhubung secara tepat</span>'
                                : '<span class="text-[11px] font-semibold text-rose-600">Kurang tepat</span>';
                        } else if (chosenNorm) {
                            status = `<span class="text-[11px] font-semibold text-emerald-600">Terhubung: ${NORM_LABELS[chosenNorm]}</span>`;
                        }

                        const card = document.createElement('div');
                        card.dataset.pairId = pair.id;
                        card.className = `relative rounded-2xl border-[1.5px] bg-white p-3.5 sm:p-4 cursor-pointer shadow-2xs transition-all duration-150 select-none ${state.border}`;
                        card.innerHTML = `
                            <div class="flex items-center gap-3.5">
                                <span class="w-12 h-12 rounded-xl ${tile.tile} flex items-center justify-center shrink-0">${svgIcon(tile.icon)}</span>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-gray-900 leading-snug">${escapeHtml(pair.situation)}</p>
                                    <p class="mt-1.5">${status}</p>
                                    ${result && !result.is_correct ? `<p class="mt-2 text-[11px] text-gray-600 bg-rose-50/60 border border-rose-100 rounded-lg p-2"><span class="font-bold text-emerald-600">Jawaban benar:</span> ${NORM_LABELS[result.correct]} — ${escapeHtml(result.explanation || '')}</p>` : ''}
                                    ${result && result.is_correct && result.explanation ? `<p class="mt-1.5 text-[11px] text-gray-500">${escapeHtml(result.explanation)}</p>` : ''}
                                </div>
                            </div>
                            <span class="hidden lg:block absolute top-1/2 -right-2 -translate-y-1/2 w-4 h-4 rounded-full bg-white border-[4px] z-20 ${state.dot}"></span>`;
                        situationList.appendChild(card);
                    });
                };

                const renderNorms = () => {
                    normList.innerHTML = '';
                    norms.forEach((normKey) => {
                        const meta = NORM_META[normKey];
                        const owner = [...connections.entries()].find(([, v]) => v === normKey);
                        const ownerResult = owner && results ? results.get(owner[0]) : null;
                        const isSelected = selected?.type === 'norm' && selected.id === normKey;
                        const state = cardState(isSelected, !!owner, ownerResult);

                        let check = badge('bg-gray-100 text-gray-300', CHECK_PATH);
                        if (ownerResult && !ownerResult.is_correct) {
                            check = badge('bg-rose-100 text-rose-500', CROSS_PATH);
                        } else if (owner) {
                            check = badge('bg-emerald-100 text-emerald-600', CHECK_PATH);
                        }

                        const card = document.createElement('div');
                        card.dataset.norm = normKey;
                        card.className = `relative rounded-2xl border-[1.5px] bg-white p-3.5 sm:p-4 flex items-center gap-3.5 cursor-pointer shadow-2xs transition-all duration-150 select-none ${state.border}`;
                        card.innerHTML = `
                            <span class="hidden lg:block absolute top-1/2 -left-2 -translate-y-1/2 w-4 h-4 rounded-full bg-white border-[4px] z-20 ${state.dot}"></span>
                            <span class="w-12 h-12 rounded-xl ${meta.tile} flex items-center justify-center shrink-0">${svgIcon(meta.icon)}</span>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-extrabold text-gray-900">${NORM_LABELS[normKey]}</p>
                                <p class="text-[11px] text-gray-500 leading-snug mt-0.5">${meta.desc}</p>
                            </div>
                            ${check}`;
                        normList.appendChild(card);
                    });
                };

                const escapeHtml = (value) => String(value)
                    .replaceAll('&', '&amp;')
                    .replaceAll('<', '&lt;')
                    .replaceAll('>', '&gt;')
                    .replaceAll('"', '&quot;')
                    .replaceAll("'", '&#039;');

                const render = () => {
                    renderSituations();
                    renderNorms();
                    updateCheckState();
                    requestAnimationFrame(redraw);
                };

                // pairId (number|string) => normKey
                const connect = (pairId, normKey) => {
                    if (results !== null) return;
                    [...connections.entries()].forEach(([pid, norm]) => {
                        if (norm === normKey || pid === pairId) connections.delete(pid);
                    });
                    connections.set(Number(pairId), normKey);
                    selected = null;
                    render();
                };

                const disconnect = (pairId) => {
                    connections.delete(Number(pairId));
                    selected = null;
                    render();
                };

                const clearSelection = () => {
                    selected = null;
                    render();
                };

                const handleTap = (type, id) => {
                    if (results !== null) return;

                    if (type === 'situation') {
                        if (selected?.type === 'situation' && selected.id === id) return clearSelection();
                        if (connections.has(Number(id))) return disconnect(id);
                        selected = { type: 'situation', id: Number(id) };
                        render();
                        return;
                    }

                    if (selected?.type === 'norm' && selected.id === id) return clearSelection();

                    if (selected?.type === 'situation') {
                        connect(selected.id, id);
                    } else {
                        const owner = [...connections.entries()].find(([, v]) => v === id);
                        if (owner) return disconnect(owner[0]);
                        selected = { type: 'norm', id };
                        render();
                    }
                };

                // Pointer interactions: mouse drag draws a line; tap selects
                let dragState = null;

                board.addEventListener('pointerdown', (e) => {
                    if (results !== null || e.button !== 0) return;
                    const situationEl = e.target.closest('[data-pair-id]');
                    const normEl = e.target.closest('[data-norm]');
                    if (!situationEl && !normEl) return;

                    dragState = {
                        type: situationEl ? 'situation' : 'norm',
                        id: situationEl ? Number(situationEl.dataset.pairId) : normEl.dataset.norm,
                        startX: e.clientX,
                        startY: e.clientY,
                        moved: false,
                        pointerType: e.pointerType,
                    };
                });

                window.addEventListener('pointermove', (e) => {
                    if (!dragState) return;
                    const dist = Math.hypot(e.clientX - dragState.startX, e.clientY - dragState.startY);
                    if (dist > 8) dragState.moved = true;

                    if (dragState.moved && dragState.pointerType === 'mouse') {
                        const sourceEl = dragState.type === 'situation'
                            ? situationList.querySelector(`[data-pair-id="${dragState.id}"]`)
                            : normList.querySelector(`[data-norm="${dragState.id}"]`);
                        if (!sourceEl) return;

                        const from = dragState.type === 'situation' ? anchor(sourceEl, 'right') : anchor(sourceEl, 'left');
                        const b = board.getBoundingClientRect();
                        redraw();
                        drawLine(from.x, from.y, e.clientX - b.left, e.clientY - b.top, '#10B981', 2.5);
                    }
                });

                window.addEventListener('pointerup', (e) => {
                    if (!dragState) return;
                    const state = dragState;
                    dragState = null;

                    const target = document.elementFromPoint(e.clientX, e.clientY);
                    const situationEl = target ? target.closest('[data-pair-id]') : null;
                    const normEl = target ? target.closest('[data-norm]') : null;

                    if (state.moved && state.pointerType === 'mouse') {
                        if (state.type === 'situation' && normEl) connect(state.id, normEl.dataset.norm);
                        else if (state.type === 'norm' && situationEl) connect(situationEl.dataset.pairId, state.id);
                        else redraw();
                        return;
                    }

                    if (!state.moved) handleTap(state.type, state.id);
                });

                window.addEventListener('resize', () => redraw());

                const loadRound = async () => {
                    boardLoading.classList.remove('hidden');
                    boardGrid.classList.add('hidden');
                    resultBox.classList.add('hidden');

                    try {
                        const res = await fetch('{{ route('quiz.round') }}', { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) throw new Error('round failed');
                        const data = await res.json();

                        pairs = data.pairs;
                        norms = data.norms;
                        connections = new Map();
                        selected = null;
                        results = null;

                        renderSituations();
                        renderNorms();
                        updateCheckState();

                        boardLoading.classList.add('hidden');
                        boardGrid.classList.remove('hidden');
                        requestAnimationFrame(redraw);
                    } catch (err) {
                        boardLoading.textContent = 'Gagal memuat ronde. Muat ulang halaman untuk mencoba lagi.';
                    }
                };

                checkBtn.addEventListener('click', async () => {
                    if (connections.size < pairs.length || submitting) return;
                    submitting = true;
                    checkBtn.disabled = true;
                    checkBtn.textContent = 'Memeriksa…';

                    try {
                        const fd = new FormData();
                        fd.append('_token', '{{ csrf_token() }}');
                        connections.forEach((normKey, pairId) => fd.append(`answers[${pairId}]`, normKey));

                        const res = await fetch('{{ route('quiz.store') }}', {
                            method: 'POST',
                            headers: { 'Accept': 'application/json' },
                            body: fd,
                        });
                        const data = await res.json();

                        if (!res.ok) throw new Error(data.message || 'Gagal memeriksa jawaban');

                        results = new Map(data.results.map((item) => [item.pair_id, item]));
                        selected = null;
                        render();

                        const wrong = data.total - data.score;
                        resultRing.className = `w-16 h-16 rounded-2xl flex items-center justify-center text-lg font-extrabold ${wrong === 0 ? 'bg-emerald-100 text-emerald-700' : (data.score >= 2 ? 'bg-blue-100 text-blue-700' : 'bg-rose-100 text-rose-700')}`;
                        resultRing.textContent = `${data.score}/${data.total}`;
                        resultText.textContent = wrong === 0
                            ? 'Sempurna! Semua situasi cocok dengan norma yang tepat. 🎉'
                            : (data.score >= 2 ? 'Bagus! Pelajari kembali penjelasan yang merah ya.' : 'Ayo pelajari lagi materi Galeri Empat Norma lalu ulangi.');
                        resultBox.classList.remove('hidden');
                        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } catch (err) {
                        resultRing.className = 'w-16 h-16 rounded-2xl flex items-center justify-center text-lg font-extrabold bg-rose-100 text-rose-700';
                        resultRing.textContent = '!';
                        resultText.textContent = err.message || 'Terjadi kesalahan. Coba lagi.';
                        resultBox.classList.remove('hidden');
                    } finally {
                        submitting = false;
                        checkBtn.textContent = 'Periksa Jawaban';
                        updateCheckState();
                    }
                });

                shuffleBtn.addEventListener('click', loadRound);
                playAgainBtn.addEventListener('click', () => {
                    loadRound();
                    board.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });

                loadRound();
            });
        </script>
    @endpush
</x-dashboard-layout>
