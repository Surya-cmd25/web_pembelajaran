<x-dashboard-layout title="Soal Pilihan Ganda" active="soal">
    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Uji Pemahaman
            </span>
            <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight mt-1">Soal Pilihan Ganda</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                Jawab {{ $questions->count() }} soal situasi sosial di bawah ini, lalu lihat hasil dan pembahasannya.
            </p>
        </div>
        <div class="flex items-center gap-2.5 self-start sm:self-auto">
            @if ($latestAttempt)
                <span class="px-3.5 py-1.5 rounded-full border border-gray-200 bg-white text-gray-700 text-xs font-bold shadow-2xs">
                    Skor terakhir: {{ $latestAttempt->score }}/{{ $latestAttempt->total }}
                </span>
            @endif
            <span class="px-3.5 py-1.5 rounded-full border border-blue-100 bg-blue-50 text-blue-700 text-xs font-bold shadow-2xs">
                {{ $questions->count() }} Soal
            </span>
        </div>
    </div>

    {{-- Progress / result summary --}}
    <section id="scoreBox" class="{{ $latestAttempt ? '' : 'hidden' }} bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
            <div class="flex items-center gap-4">
                <div id="scoreRing" class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg font-extrabold">
                    @if ($latestAttempt){{ $latestAttempt->score }}/{{ $latestAttempt->total }}@endif
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-gray-900">Hasil Terakhir</h3>
                    <p id="scoreText" class="text-xs text-gray-500 mt-0.5">
                        @if ($latestAttempt)
                            Kamu menjawab benar {{ $latestAttempt->score }} dari {{ $latestAttempt->total }} soal. Ayo coba lagi untuk skor lebih tinggi!
                        @else
                            Belum ada hasil.
                        @endif
                    </p>
                </div>
            </div>
            <button id="retryBtn" type="button"
                class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-xs font-bold transition-colors">
                Ulangi Dari Awal
            </button>
        </div>
    </section>

    {{-- Question form --}}
    <form id="soalForm" class="space-y-5">
        @forelse ($questions as $index => $item)
            <fieldset data-question-id="{{ $item['id'] }}"
                class="question-card bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
                <legend class="sr-only">Soal {{ $index + 1 }}</legend>

                <div class="flex items-start gap-3.5">
                    <span class="w-8 h-8 rounded-xl bg-slate-900 text-white text-sm font-extrabold flex items-center justify-center shrink-0">
                        {{ $index + 1 }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm sm:text-[15px] font-semibold text-gray-900 leading-relaxed">
                            {{ $item['question'] }}
                        </p>

                        <div class="option-list mt-4 space-y-2.5">
                            @foreach ($item['options'] as $optionIndex => $option)
                                <label class="option-item flex items-start gap-3 rounded-2xl border border-gray-200 bg-white px-4 py-3 cursor-pointer transition-all hover:border-blue-300 hover:bg-blue-50/40">
                                    <input type="radio" name="answers[{{ $item['id'] }}]" value="{{ $optionIndex }}"
                                        class="mt-0.5 w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 shrink-0">
                                    <span class="text-sm text-gray-700 leading-snug option-label">
                                        <span class="font-bold text-gray-500 mr-1.5">{{ chr(65 + $optionIndex) }}.</span>{{ $option }}
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        <p class="explanation hidden mt-3 text-xs text-gray-600 bg-slate-50 border border-slate-100 rounded-xl p-3"></p>
                    </div>
                </div>
            </fieldset>
        @empty
            <div class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-10 text-center">
                <p class="text-sm font-semibold text-gray-500">Belum ada soal tersedia. Guru sedang menyiapkan soalnya.</p>
            </div>
        @endforelse

        @if ($questions->isNotEmpty())
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 justify-end">
                <span id="answeredHint" class="text-xs font-semibold text-gray-400 sm:mr-auto">0 dari {{ $questions->count() }} soal terjawab</span>
                <button id="submitBtn" type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/25 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none">
                    Kumpulkan Jawaban
                </button>
            </div>
        @endif
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('soalForm');
                const submitBtn = document.getElementById('submitBtn');
                const answeredHint = document.getElementById('answeredHint');
                const scoreBox = document.getElementById('scoreBox');
                const scoreRing = document.getElementById('scoreRing');
                const scoreText = document.getElementById('scoreText');
                const retryBtn = document.getElementById('retryBtn');
                const totalQuestions = {{ $questions->count() }};
                let submitting = false;

                const countAnswered = () => {
                    const ids = new Set();
                    form.querySelectorAll('input[type=radio]:checked').forEach((input) => ids.add(input.name));
                    const answered = ids.size;
                    if (answeredHint) answeredHint.textContent = `${answered} dari ${totalQuestions} soal terjawab`;
                    if (submitBtn) submitBtn.disabled = submitting || answered < totalQuestions;
                    return answered;
                };

                form.addEventListener('change', countAnswered);

                const markCard = (card, isCorrect, chosenIndex, correctIndex, explanation) => {
                    const options = card.querySelectorAll('.option-item');
                    options.forEach((option, index) => {
                        const label = option.querySelector('.option-label');
                        option.classList.remove('border-gray-200', 'bg-white', 'hover:border-blue-300', 'hover:bg-blue-50/40');
                        if (index === correctIndex) {
                            option.classList.add('border-emerald-300', 'bg-emerald-50/70');
                            label.classList.add('text-emerald-800');
                        } else if (index === chosenIndex) {
                            option.classList.add('border-rose-300', 'bg-rose-50/70');
                            label.classList.add('text-rose-800');
                        } else {
                            option.classList.add('border-gray-100', 'bg-slate-50/50', 'opacity-70');
                        }
                        option.querySelector('input').disabled = true;
                        option.classList.add('cursor-default');
                    });

                    const explanationEl = card.querySelector('.explanation');
                    if (explanationEl) {
                        const prefix = isCorrect
                            ? '<span class="font-bold text-emerald-600">Benar! ✓</span>'
                            : `<span class="font-bold text-rose-600">Belum tepat ✗</span> Jawaban benar: <span class="font-bold text-emerald-600">${chr(correctIndex)}.</span>`;
                        explanationEl.innerHTML = `${prefix} ${escapeHtml(explanation || '')}`;
                        explanationEl.classList.remove('hidden');
                    }
                };

                const chr = (index) => String.fromCharCode(65 + index);

                const escapeHtml = (value) => String(value)
                    .replaceAll('&', '&amp;')
                    .replaceAll('<', '&lt;')
                    .replaceAll('>', '&gt;')
                    .replaceAll('"', '&quot;')
                    .replaceAll("'", '&#039;');

                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    if (submitting || countAnswered() < totalQuestions) return;

                    submitting = true;
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Memeriksa…';

                    try {
                        const fd = new FormData(form);
                        fd.append('_token', '{{ csrf_token() }}');

                        const res = await fetch('{{ route('soal.submit') }}', {
                            method: 'POST',
                            headers: { 'Accept': 'application/json' },
                            body: fd,
                        });
                        const data = await res.json();

                        if (!res.ok) throw new Error(data.message || 'Gagal memeriksa jawaban');

                        data.results.forEach((result) => {
                            const card = form.querySelector(`[data-question-id="${result.question_id}"]`);
                            if (card) markCard(card, result.is_correct, result.chosen_index, result.correct_index, result.explanation);
                        });

                        const wrong = data.total - data.score;
                        scoreRing.className = `w-16 h-16 rounded-2xl flex items-center justify-center text-lg font-extrabold ${wrong === 0 ? 'bg-emerald-100 text-emerald-700' : (data.score >= 7 ? 'bg-blue-100 text-blue-700' : 'bg-rose-100 text-rose-700')}`;
                        scoreRing.textContent = `${data.score}/${data.total}`;
                        scoreText.textContent = wrong === 0
                            ? 'Sempurna! Semua jawabanmu benar. 🎉'
                            : (data.score >= 7
                                ? 'Bagus! Tinjau kembali soal yang ditandai merah ya.'
                                : 'Ayo baca ulang Ruang Materi dan Galeri Empat Norma, lalu coba lagi.');
                        scoreBox.classList.remove('hidden');
                        scoreBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } catch (err) {
                        scoreRing.className = 'w-16 h-16 rounded-2xl flex items-center justify-center text-lg font-extrabold bg-rose-100 text-rose-700';
                        scoreRing.textContent = '!';
                        scoreText.textContent = err.message || 'Terjadi kesalahan. Coba lagi.';
                        scoreBox.classList.remove('hidden');
                    } finally {
                        submitting = false;
                        submitBtn.textContent = 'Kumpulkan Jawaban';
                        countAnswered();
                    }
                });

                retryBtn.addEventListener('click', () => window.location.reload());

                countAnswered();
            });
        </script>
    @endpush
</x-dashboard-layout>
