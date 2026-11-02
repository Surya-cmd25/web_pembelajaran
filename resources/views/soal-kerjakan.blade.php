<x-dashboard-layout title="Mengerjakan Soal" active="soal">
    <div class="sticky top-0 z-30 -mx-1 px-1 pt-1 pb-2">
        <div class="bg-white/95 backdrop-blur rounded-2xl border border-gray-200/80 shadow-sm px-4 py-3 flex items-center justify-between gap-3">
            <div>
                <p class="text-sm font-extrabold text-gray-900">Soal Pilihan Ganda</p>
                <p id="answeredHint" class="text-[11px] font-semibold text-gray-400">0 dari {{ $questions->count() }} soal terjawab</p>
            </div>
            <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900 text-white">
                <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span id="countdown" class="font-mono text-base font-bold tracking-widest">--:--</span>
            </div>
        </div>
    </div>

    <form id="soalForm" class="space-y-5">
        @foreach ($questions as $index => $item)
            <fieldset data-question-id="{{ $item['id'] }}" class="question-card bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
                <legend class="sr-only">Soal {{ $index + 1 }}</legend>
                <div class="flex items-start gap-3.5">
                    <span class="w-8 h-8 rounded-xl bg-slate-900 text-white text-sm font-extrabold flex items-center justify-center shrink-0">{{ $index + 1 }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm sm:text-[15px] font-semibold text-gray-900 leading-relaxed">{{ $item['question'] }}</p>
                        <div class="mt-4 space-y-2.5">
                            @foreach ($item['options'] as $optionIndex => $option)
                                <label class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-white px-4 py-3 cursor-pointer transition-all hover:border-blue-300 hover:bg-blue-50/40 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                                    <input type="radio" name="answers[{{ $item['id'] }}]" value="{{ $optionIndex }}" class="mt-0.5 w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 shrink-0">
                                    <span class="text-sm text-gray-700 leading-snug"><span class="font-bold text-gray-500 mr-1.5">{{ chr(65 + $optionIndex) }}.</span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </fieldset>
        @endforeach

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 justify-end">
            <p id="submitError" class="hidden text-xs font-semibold text-rose-600 sm:mr-auto"></p>
            <button id="submitBtn" type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/25 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                Selesai &amp; Kumpulkan
            </button>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('soalForm');
                const submitBtn = document.getElementById('submitBtn');
                const submitError = document.getElementById('submitError');
                const answeredHint = document.getElementById('answeredHint');
                const countdown = document.getElementById('countdown');
                const total = {{ $questions->count() }};
                let remaining = {{ $durationMinutes * 60 }};
                let submitting = false;
                let timer = null;

                const answered = () => new Set([...form.querySelectorAll('input[type=radio]:checked')].map((i) => i.name)).size;
                const pad = (n) => String(n).padStart(2, '0');
                const renderTime = () => {
                    countdown.textContent = `${pad(Math.floor(remaining / 60))}:${pad(remaining % 60)}`;
                    countdown.classList.toggle('text-rose-300', remaining <= 60);
                };

                form.addEventListener('change', () => { answeredHint.textContent = `${answered()} dari ${total} soal terjawab`; });

                const submit = async (auto = false) => {
                    if (submitting) return;
                    const left = total - answered();
                    if (!auto && left > 0 && !confirm(`Masih ada ${left} soal belum dijawab. Kumpulkan sekarang?`)) return;

                    submitting = true;
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Mengirim…';
                    clearInterval(timer);

                    try {
                        const fd = new FormData(form);
                        fd.append('_token', '{{ csrf_token() }}');
                        const res = await fetch('{{ route('soal.submit') }}', { method: 'POST', headers: { 'Accept': 'application/json' }, body: fd });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Gagal mengirim jawaban.');
                        window.location.href = data.redirect;
                    } catch (err) {
                        submitting = false;
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Selesai & Kumpulkan';
                        submitError.textContent = err.message || 'Terjadi kesalahan. Coba lagi.';
                        submitError.classList.remove('hidden');
                    }
                };

                form.addEventListener('submit', (e) => { e.preventDefault(); submit(false); });

                renderTime();
                timer = setInterval(() => {
                    remaining -= 1;
                    renderTime();
                    if (remaining <= 0) { clearInterval(timer); submit(true); }
                }, 1000);
            });
        </script>
    @endpush
</x-dashboard-layout>
