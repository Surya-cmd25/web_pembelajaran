@props(['review' => [], 'who' => 'Jawabanmu'])

<div class="space-y-4">
    @forelse ($review as $i => $item)
        @php
            $chosen = $item['chosen_index'] ?? null;
            $ok = (bool) ($item['is_correct'] ?? false);
        @endphp
        <article class="bg-white rounded-3xl border {{ $ok ? 'border-emerald-200/80' : 'border-rose-200/80' }} shadow-2xs p-5 sm:p-6">
            <div class="flex items-start gap-3.5">
                <span class="w-8 h-8 rounded-xl {{ $ok ? 'bg-emerald-500' : 'bg-rose-500' }} text-white text-sm font-extrabold flex items-center justify-center shrink-0">
                    {{ $i + 1 }}
                </span>
                <div class="min-w-0 flex-1">
                    <span class="inline-block px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider {{ $ok ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                        {{ $ok ? 'Benar' : ($chosen === null ? 'Tidak dijawab' : 'Salah') }}
                    </span>
                    <p class="mt-2 text-sm sm:text-[15px] font-semibold text-gray-900 leading-relaxed">{{ $item['question'] }}</p>

                    <div class="mt-4 space-y-2">
                        @foreach ($item['options'] as $optionIndex => $option)
                            @php
                                $isCorrect = $optionIndex === $item['correct_index'];
                                $isChosen = $optionIndex === $chosen;
                                $cls = $isCorrect
                                    ? 'border-emerald-300 bg-emerald-50/70 text-emerald-800'
                                    : ($isChosen ? 'border-rose-300 bg-rose-50/70 text-rose-800' : 'border-gray-100 bg-slate-50/50 text-gray-500');
                            @endphp
                            <div class="flex items-start gap-3 rounded-2xl border px-4 py-3 text-sm {{ $cls }}">
                                <span class="font-bold shrink-0">{{ chr(65 + $optionIndex) }}.</span>
                                <span class="flex-1 leading-snug">{{ $option }}</span>
                                @if ($isCorrect)
                                    <span class="shrink-0 text-[10px] font-extrabold uppercase tracking-wider text-emerald-600">✓ Jawaban benar</span>
                                @elseif ($isChosen)
                                    <span class="shrink-0 text-[10px] font-extrabold uppercase tracking-wider text-rose-600">✗ {{ $who }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if (! empty($item['explanation']))
                        <p class="mt-3 text-xs text-gray-600 bg-slate-50 border border-slate-100 rounded-xl p-3">
                            <span class="font-bold text-gray-800">Pembahasan:</span> {{ $item['explanation'] }}
                        </p>
                    @endif
                </div>
            </div>
        </article>
    @empty
        <div class="bg-white rounded-3xl border border-gray-200/80 p-8 text-center text-sm text-gray-500">
            Rincian soal untuk pengerjaan ini tidak tersedia.
        </div>
    @endforelse
</div>
