<x-dashboard-layout title="Setor Hafalan" active="hafalan">

    <div>
        <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">Setor Hafalan</h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">Uji pemahamanmu dengan 8 kartu konsep dan rekam penjelasanmu.</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1.55fr)_minmax(0,1fr)] gap-6 items-start">

        {{-- Pilihan Kartu Konsep --}}
        <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
            <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-4">Pilihan Kartu Konsep</h3>

            @php
                $colorStyles = [
                    'amber' => ['card' => 'bg-amber-50/70 border-amber-200/70', 'icon' => 'bg-amber-100 text-amber-500', 'ring' => 'ring-amber-400'],
                    'blue' => ['card' => 'bg-blue-50/70 border-blue-200/70', 'icon' => 'bg-blue-100 text-blue-600', 'ring' => 'ring-blue-400'],
                    'cyan' => ['card' => 'bg-cyan-50/70 border-cyan-200/70', 'icon' => 'bg-cyan-100 text-cyan-600', 'ring' => 'ring-cyan-400'],
                    'orange' => ['card' => 'bg-orange-50/70 border-orange-200/70', 'icon' => 'bg-orange-100 text-orange-500', 'ring' => 'ring-orange-400'],
                    'rose' => ['card' => 'bg-rose-50/70 border-rose-200/70', 'icon' => 'bg-rose-100 text-rose-500', 'ring' => 'ring-rose-400'],
                    'emerald' => ['card' => 'bg-emerald-50/70 border-emerald-200/70', 'icon' => 'bg-emerald-100 text-emerald-600', 'ring' => 'ring-emerald-400'],
                    'yellow' => ['card' => 'bg-yellow-50/70 border-yellow-200/70', 'icon' => 'bg-yellow-100 text-orange-600', 'ring' => 'ring-yellow-400'],
                    'indigo' => ['card' => 'bg-indigo-50/70 border-indigo-200/70', 'icon' => 'bg-indigo-100 text-indigo-600', 'ring' => 'ring-indigo-400'],
                ];

                $iconSvgs = [
                    'star' => '<path fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" d="M12 3.5l2.6 5.3 5.9.85-4.25 4.15 1 5.85L12 16.9l-5.25 2.75 1-5.85L3.5 9.65l5.9-.85L12 3.5z"/>',
                    'document' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 3h7l4 4v13a1 1 0 01-1 1H7a1 1 0 01-1-1V4a1 1 0 011-1zM14 3v4h4M9 13h6M9 17h4"/>',
                    'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                    'home' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M5 21V10l7-6 7 6v11M9 21v-6h6v6"/>',
                    'heart' => '<path fill="currentColor" d="M12 21s-7.5-4.6-9.3-9.2C1.5 8.6 3.3 5 6.8 5c2 0 3.5 1.1 5.2 3 1.7-1.9 3.2-3 5.2-3 3.5 0 5.3 3.6 4.1 6.8C19.5 16.4 12 21 12 21z"/>',
                    'smile' => '<circle cx="12" cy="12" r="8.5" fill="none" stroke="currentColor" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" fill="none" stroke="currentColor" d="M8.5 14c1.8 2 5.2 2 7 0M9 9.5h.01M15 9.5h.01"/>',
                    'scale' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>',
                    'user-group' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
                ];
            @endphp

            <div id="conceptGrid" class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach ($cards as $card)
                    @php
                        $color = $colorStyles[$card->color] ?? $colorStyles['blue'];
                        $iconSvg = $iconSvgs[$card->icon] ?? $iconSvgs['document'];
                    @endphp

                    <button type="button" class="concept-card group flex flex-col items-center justify-center gap-2.5 h-28 rounded-2xl border {{ $color['card'] }} hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus-visible:ring-2 {{ $color['ring'] }} transition-all duration-200"
                        data-id="{{ $card->id }}" data-name="{{ $card->name }}" data-ring="{{ $color['ring'] }}">
                        <span class="w-12 h-12 rounded-xl {{ $color['icon'] }} flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $iconSvg !!}</svg>
                        </span>
                        <span class="text-sm font-bold text-gray-900">{{ $card->name }}</span>
                    </button>
                @endforeach
            </div>

            {{-- Kartu terpilih: pertanyaan (depan) & jawaban (belakang) --}}
            <div id="cardPrompt" class="hidden mt-6 pt-5 border-t border-gray-100">
                <div class="flex items-center justify-between gap-2 mb-3">
                    <h4 class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                        Kartu Terpilih: <span id="promptName" class="text-blue-600"></span>
                    </h4>
                    <button id="flipBtn" type="button" class="px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 text-[11px] font-bold transition-colors">
                        Lihat Jawaban / Balik Kartu
                    </button>
                </div>

                <div class="perspective-1000">
                    <div id="flipCard" class="relative transition-transform duration-500 transform-style-3d">
                        <div class="backface-hidden rounded-2xl border border-blue-200/70 bg-blue-50/70 p-5">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-500">Pertanyaan</span>
                            <p id="flipFrontText" class="mt-2 text-sm font-semibold text-gray-800 leading-relaxed"></p>
                        </div>
                        <div class="backface-hidden rotate-y-180 absolute inset-0 rounded-2xl border border-emerald-200/70 bg-emerald-50/70 p-5 overflow-y-auto">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-600">Jawaban</span>
                            <p id="flipBackText" class="mt-2 text-sm font-semibold text-gray-800 leading-relaxed"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-9 pt-5 border-t border-gray-100">
                <button id="submitBtn" type="button" disabled
                    class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/25 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none">
                    Kirim Rekaman
                </button>
                <p id="submitMessage" class="hidden mt-3 text-xs font-medium"></p>
            </div>
        </section>

        {{-- Rekaman Penjelasan --}}
        <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6 flex flex-col min-h-[438px]">
            <h3 class="text-base font-bold text-gray-900">Rekaman Penjelasan</h3>
            <p class="text-[11px] text-gray-400 mt-0.5">Jelaskan makna norma sesuai pemahamanmu sendiri</p>

            <div class="flex-1 flex flex-col items-center justify-center py-8">
                <div id="micHalo" class="w-36 h-36 rounded-full bg-blue-50 flex items-center justify-center transition-all">
                    <div class="w-28 h-28 rounded-full bg-blue-100/70 flex items-center justify-center">
                        <div id="micButton" class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/40">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <p class="mt-3 font-mono text-[28px] font-bold tracking-widest text-gray-900">
                    <span id="timerText">00:00</span><span class="text-xs font-medium tracking-normal text-gray-400"> / 03:00</span>
                </p>
                <p id="recordStatus" class="mt-2 text-xs text-gray-400 text-center min-h-4"></p>
            </div>

            <div class="flex items-center justify-center gap-3">
                <button id="startBtn" type="button" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M6 4l14 8-14 8V4z"/></svg>
                    Mulai
                </button>
                <button id="stopBtn" type="button" disabled class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><rect x="5" y="5" width="14" height="14" rx="2"/></svg>
                    Stop
                </button>
                <button id="resetBtn" type="button" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M4 4v5h5M20 20v-5h-5M5.6 15A8 8 0 0018.4 17M18.4 9A8 8 0 005.6 7"/></svg>
                    Ulangi
                </button>
            </div>

            <audio id="playback" controls class="hidden mt-5 w-full"></audio>
        </section>
    </div>

    {{-- Rekaman saya / terakhir --}}
    <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
        <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">Rekaman saya / terakhir</h3>

        <div id="myRecordingsList">
            @forelse ($myRecordings as $recording)
                @php
                    $statusClass = match ($recording->status) {
                        'diterima' => 'bg-emerald-50 text-emerald-700',
                        'perlu_percobaan' => 'bg-rose-50 text-rose-700',
                        default => 'bg-amber-50 text-amber-700',
                    };
                @endphp
                <div class="flex items-center justify-between gap-3 py-2.5 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $recording->conceptCard->name ?? '—' }}</p>
                        <p class="text-[11px] text-gray-400">{{ $recording->created_at->translatedFormat('d F Y') }}</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-md {{ $statusClass }} text-[10px] font-extrabold uppercase tracking-wider">
                        {{ $recording->statusLabel() }}
                    </span>
                </div>
            @empty
                <p id="recordingEmpty" class="text-xs text-gray-400 py-2">
                    Belum ada rekaman. Pilih kartu konsep, rekam suaramu, lalu kirim.
                </p>
            @endforelse
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const MAX_SECONDS = 180;

                // Concept selection & flip card
                const cards = [...document.querySelectorAll('.concept-card')];
                const cardData = @json($cards->mapWithKeys(fn ($c) => [$c->id => ['name' => $c->name, 'front' => $c->front_text, 'back' => $c->back_text]]));
                const cardPrompt = document.getElementById('cardPrompt');
                const promptName = document.getElementById('promptName');
                const flipBtn = document.getElementById('flipBtn');
                const flipCard = document.getElementById('flipCard');
                const flipFrontText = document.getElementById('flipFrontText');
                const flipBackText = document.getElementById('flipBackText');

                let selectedId = null;
                let selectedName = null;

                cards.forEach((btn) => {
                    btn.addEventListener('click', () => {
                        cards.forEach((c) => c.classList.remove('ring-2', 'ring-offset-2', c.dataset.ring));
                        btn.classList.add('ring-2', 'ring-offset-2', btn.dataset.ring);

                        selectedId = btn.dataset.id;
                        selectedName = btn.dataset.name;

                        const data = cardData[selectedId];
                        promptName.textContent = selectedName;
                        flipFrontText.textContent = data ? data.front : '';
                        flipBackText.textContent = data ? data.back : '';
                        flipCard.classList.remove('rotate-y-180');
                        cardPrompt.classList.remove('hidden');
                        updateSubmitState();
                    });
                });

                flipBtn.addEventListener('click', () => flipCard.classList.toggle('rotate-y-180'));

                // Recording
                const startBtn = document.getElementById('startBtn');
                const stopBtn = document.getElementById('stopBtn');
                const resetBtn = document.getElementById('resetBtn');
                const submitBtn = document.getElementById('submitBtn');
                const submitMessage = document.getElementById('submitMessage');
                const timerText = document.getElementById('timerText');
                const statusText = document.getElementById('recordStatus');
                const micHalo = document.getElementById('micHalo');
                const playback = document.getElementById('playback');

                let mediaRecorder = null;
                let stream = null;
                let chunks = [];
                let recordedBlob = null;
                let seconds = 0;
                let timerId = null;

                const pad = (n) => String(n).padStart(2, '0');
                const renderTimer = () => { timerText.textContent = `${pad(Math.floor(seconds / 60))}:${pad(seconds % 60)}`; };
                const updateSubmitState = () => { submitBtn.disabled = !(selectedId && recordedBlob); };

                const stopTimer = () => { clearInterval(timerId); timerId = null; };
                const releaseStream = () => { if (stream) { stream.getTracks().forEach((t) => t.stop()); stream = null; } };

                function finishRecording() {
                    stopTimer();
                    micHalo.classList.remove('animate-pulse');
                    startBtn.disabled = false;
                    stopBtn.disabled = true;
                }

                function resetRecordingState() {
                    chunks = [];
                    recordedBlob = null;
                    seconds = 0;
                    renderTimer();
                    playback.removeAttribute('src');
                    playback.classList.add('hidden');
                    statusText.textContent = '';
                    updateSubmitState();
                }

                function prependRecordingItem(conceptName, statusLabel, statusClass) {
                    const list = document.getElementById('myRecordingsList');
                    const empty = document.getElementById('recordingEmpty');
                    if (empty) empty.remove();

                    const row = document.createElement('div');
                    row.className = 'flex items-center justify-between gap-3 py-2.5 border-b border-gray-100 last:border-0';

                    const left = document.createElement('div');
                    const nameEl = document.createElement('p');
                    nameEl.className = 'text-sm font-bold text-gray-900';
                    nameEl.textContent = conceptName;
                    const dateEl = document.createElement('p');
                    dateEl.className = 'text-[11px] text-gray-400';
                    dateEl.textContent = new Intl.DateTimeFormat('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }).format(new Date());
                    left.appendChild(nameEl);
                    left.appendChild(dateEl);

                    const badge = document.createElement('span');
                    badge.className = `px-2 py-0.5 rounded-md ${statusClass} text-[10px] font-extrabold uppercase tracking-wider`;
                    badge.textContent = statusLabel;

                    row.appendChild(left);
                    row.appendChild(badge);
                    list.prepend(row);
                }

                startBtn.addEventListener('click', async () => {
                    if (!navigator.mediaDevices || !window.MediaRecorder) {
                        statusText.textContent = 'Peramban kamu belum mendukung perekaman suara.';
                        return;
                    }
                    try {
                        stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                    } catch (e) {
                        statusText.textContent = 'Izin mikrofon ditolak. Aktifkan akses mikrofon lalu coba lagi.';
                        return;
                    }

                    chunks = [];
                    recordedBlob = null;
                    seconds = 0;
                    renderTimer();
                    playback.classList.add('hidden');
                    submitMessage.classList.add('hidden');
                    updateSubmitState();

                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.ondataavailable = (e) => { if (e.data.size) chunks.push(e.data); };
                    mediaRecorder.onstop = () => {
                        recordedBlob = new Blob(chunks, { type: mediaRecorder.mimeType || 'audio/webm' });
                        playback.src = URL.createObjectURL(recordedBlob);
                        playback.classList.remove('hidden');
                        statusText.textContent = 'Rekaman siap. Pilih kartu konsep lalu kirim.';
                        releaseStream();
                        updateSubmitState();
                    };
                    mediaRecorder.start();

                    startBtn.disabled = true;
                    stopBtn.disabled = false;
                    micHalo.classList.add('animate-pulse');
                    statusText.textContent = 'Sedang merekam…';

                    timerId = setInterval(() => {
                        seconds += 1;
                        renderTimer();
                        if (seconds >= MAX_SECONDS) {
                            mediaRecorder.stop();
                            finishRecording();
                        }
                    }, 1000);
                });

                stopBtn.addEventListener('click', () => {
                    if (mediaRecorder && mediaRecorder.state === 'recording') {
                        mediaRecorder.stop();
                    }
                    finishRecording();
                });

                resetBtn.addEventListener('click', () => {
                    if (mediaRecorder && mediaRecorder.state === 'recording') {
                        mediaRecorder.onstop = null;
                        mediaRecorder.stop();
                    }
                    releaseStream();
                    finishRecording();
                    resetRecordingState();
                    submitMessage.classList.add('hidden');
                });

                submitBtn.addEventListener('click', async () => {
                    if (!selectedId || !recordedBlob) {
                        return;
                    }

                    const submittedName = selectedName;
                    submitBtn.disabled = true;
                    submitMessage.textContent = 'Mengirim rekaman…';
                    submitMessage.className = 'mt-3 text-xs font-medium text-blue-600';

                    try {
                        const fd = new FormData();
                        fd.append('_token', document.querySelector('meta[name=csrf-token]')?.content ?? '{{ csrf_token() }}');
                        fd.append('concept_card_id', selectedId);
                        fd.append('duration', String(seconds));
                        fd.append('audio', new File([recordedBlob], 'rekaman.webm', { type: recordedBlob.type || 'audio/webm' }));

                        const res = await fetch('{{ route('setor-hafalan.store') }}', { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd });
                        const data = await res.json().catch(() => ({}));

                        if (res.ok) {
                            submitMessage.textContent = data.message ?? 'Rekaman berhasil dikirim.';
                            submitMessage.className = 'mt-3 text-xs font-medium text-emerald-600';
                            prependRecordingItem(
                                data.recording?.concept ?? submittedName,
                                data.recording?.status ?? 'Menunggu Review',
                                'bg-amber-50 text-amber-700'
                            );
                            releaseStream();
                            finishRecording();
                            resetRecordingState();
                        } else {
                            const firstError = data.errors ? Object.values(data.errors).flat()[0] : null;
                            submitMessage.textContent = data.message || firstError || 'Gagal mengirim rekaman.';
                            submitMessage.className = 'mt-3 text-xs font-medium text-rose-600';
                            updateSubmitState();
                        }
                    } catch (e) {
                        submitMessage.textContent = 'Gagal mengirim rekaman. Periksa koneksi internetmu lalu coba lagi.';
                        submitMessage.className = 'mt-3 text-xs font-medium text-rose-600';
                        updateSubmitState();
                    }
                });
            });
        </script>
    @endpush

</x-dashboard-layout>
