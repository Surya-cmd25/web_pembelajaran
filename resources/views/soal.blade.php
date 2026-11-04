<x-dashboard-layout title="Soal Pilihan Ganda" active="soal">
    @php
        $levelStyles = [
            'mudah' => [
                'gradient' => 'from-emerald-600 to-emerald-800',
                'icon' => 'bg-emerald-50 text-emerald-600',
                'hover' => 'group-hover:text-emerald-600',
                'desc' => 'Soal dasar untuk mengenal pengertian nilai dan norma.',
            ],
            'sedang' => [
                'gradient' => 'from-amber-500 to-amber-700',
                'icon' => 'bg-amber-50 text-amber-600',
                'hover' => 'group-hover:text-amber-600',
                'desc' => 'Soal penerapan norma pada situasi sehari-hari.',
            ],
            'sulit' => [
                'gradient' => 'from-rose-600 to-rose-800',
                'icon' => 'bg-rose-50 text-rose-600',
                'hover' => 'group-hover:text-rose-600',
                'desc' => 'Soal analisis kasus yang menuntut pemahaman mendalam.',
            ],
        ];
    @endphp

    <div>
        <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight mt-1">Soal Pilihan Ganda</h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">Pilih kartu level kesulitan untuk melihat keterangan soal, lalu mulai mengerjakan.</p>
    </div>

    @if (session('status'))
        <div class="rounded-2xl bg-amber-50 text-amber-700 border border-amber-200/80 px-4 py-3 text-sm font-bold">{{ session('status') }}</div>
    @endif

    {{-- Kartu soal per level kesulitan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach ($levels as $value => $label)
            @php
                $style = $levelStyles[$value] ?? [
                    'gradient' => 'from-blue-600 to-blue-800',
                    'icon' => 'bg-blue-50 text-blue-600',
                    'hover' => 'group-hover:text-blue-600',
                    'desc' => 'Pilih kartu ini untuk mengerjakan soal.',
                ];
                $count = (int) ($counts[$value] ?? 0);
            @endphp
            <button type="button"
                class="levelCard group text-left bg-white rounded-3xl border border-gray-200/80 shadow-2xs hover:shadow-md hover:-translate-y-0.5 overflow-hidden transition-all duration-200 focus:outline-none focus-visible:ring-2 ring-blue-400 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:translate-y-0"
                data-level="{{ $value }}"
                data-label="{{ $label }}"
                data-count="{{ $count }}"
                data-duration="{{ $durationMinutes }}"
                data-description="{{ $description }}"
                data-url="{{ route('soal.kerjakan', ['level' => $value]) }}"
                @disabled($count === 0)>
                <div class="h-32 bg-gradient-to-br {{ $style['gradient'] }} relative overflow-hidden flex items-center justify-center">
                    <div class="pointer-events-none absolute -right-8 -top-8 w-32 h-32 rounded-full bg-white/10"></div>
                    <div class="pointer-events-none absolute -left-6 -bottom-10 w-28 h-28 rounded-full bg-white/10"></div>
                    <svg class="relative w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-white/20 backdrop-blur text-white text-[10px] font-extrabold uppercase tracking-wider">
                        {{ $label }}
                    </span>
                </div>
                <div class="p-5">
                    <h3 class="text-base font-extrabold text-gray-900 mt-1 {{ $style['hover'] }} transition-colors">Soal {{ $label }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1.5 line-clamp-2">{{ $style['desc'] }}</p>
                    <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                        @if ($count > 0)
                            <span class="font-semibold text-gray-500">{{ $count }} soal · {{ $durationMinutes }} menit</span>
                            <span class="font-bold text-blue-600">Buka →</span>
                        @else
                            <span class="font-semibold text-gray-400">Belum ada soal</span>
                            <span class="font-bold text-gray-300">—</span>
                        @endif
                    </div>
                </div>
            </button>
        @endforeach
    </div>

    {{-- Riwayat --}}
    @if ($attempts->isNotEmpty())
        <section class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-5 sm:p-6">
            <h3 class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">Riwayat pengerjaan</h3>
            @foreach ($attempts as $attempt)
                @php($pct = $attempt->total > 0 ? round($attempt->score / $attempt->total * 100) : 0)
                <div class="flex items-center justify-between gap-3 py-3 border-b border-gray-100 last:border-0">
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-bold text-gray-900">Nilai {{ $pct }} <span class="text-xs font-semibold text-gray-400">({{ $attempt->score }}/{{ $attempt->total }} benar)</span></p>
                            <x-difficulty-badge :level="$attempt->difficulty" />
                        </div>
                        <p class="text-[11px] text-gray-400">{{ $attempt->created_at->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                    <a href="{{ route('soal.hasil', $attempt) }}" class="px-3.5 py-1.5 rounded-lg border border-gray-200 text-xs font-bold text-gray-700 hover:border-blue-300 hover:text-blue-600 transition-all">
                        Lihat Pembahasan
                    </a>
                </div>
            @endforeach
        </section>
    @endif

    {{-- Popup keterangan --}}
    <div id="soalModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div id="soalModalBackdrop" class="absolute inset-0 bg-slate-900/50 backdrop-blur-xs"></div>
        <div class="relative w-full max-w-md bg-white rounded-3xl border border-gray-200 shadow-2xl p-6">
            <button id="soalModalClose" type="button" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white border border-gray-200 text-gray-500 hover:text-gray-800 flex items-center justify-center" aria-label="Tutup">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600">Keterangan Soal</span>
            <h3 id="modalTitle" class="text-xl font-extrabold text-gray-900 mt-1">Soal</h3>
            <p id="modalDesc" class="text-sm text-gray-600 leading-relaxed mt-2">{{ $description }}</p>

            <div class="grid grid-cols-2 gap-3 mt-5">
                <div class="rounded-2xl bg-blue-50/70 border border-blue-100 p-4">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Jumlah Soal</p>
                    <p id="modalCount" class="text-2xl font-extrabold text-gray-900 mt-1">0</p>
                </div>
                <div class="rounded-2xl bg-amber-50/70 border border-amber-100 p-4">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Durasi</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1"><span id="modalDuration">0</span> <span class="text-sm font-bold text-gray-500">menit</span></p>
                </div>
            </div>

            <ul class="mt-4 space-y-1.5 text-xs text-gray-600">
                <li>• Waktu berjalan begitu kamu menekan tombol mulai.</li>
                <li>• Saat waktu habis, jawaban otomatis dikumpulkan.</li>
                <li>• Soal pada kartu ini hanya berasal dari level kesulitan yang kamu pilih.</li>
                <li>• Setelah selesai, nilai dikirim ke guru dan kamu bisa memeriksa jawaban yang salah dan yang benar.</li>
            </ul>

            <a id="modalStart" href="{{ route('soal.kerjakan') }}" class="mt-6 flex justify-center w-full px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/25 transition-colors">
                Mulai Mengerjakan
            </a>
            <p id="modalEmpty" class="hidden mt-6 text-center text-sm font-semibold text-gray-500">Belum ada soal pada level ini. Guru sedang menyiapkannya.</p>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('soalModal');
                const modalTitle = document.getElementById('modalTitle');
                const modalDesc = document.getElementById('modalDesc');
                const modalCount = document.getElementById('modalCount');
                const modalDuration = document.getElementById('modalDuration');
                const modalStart = document.getElementById('modalStart');
                const modalEmpty = document.getElementById('modalEmpty');

                const open = () => { modal.classList.remove('hidden'); document.body.classList.add('overflow-hidden'); };
                const close = () => { modal.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); };

                document.querySelectorAll('.levelCard').forEach((card) => {
                    card.addEventListener('click', () => {
                        const count = Number(card.dataset.count);
                        modalTitle.textContent = `Soal ${card.dataset.label}`;
                        modalDesc.textContent = card.dataset.description;
                        modalCount.textContent = String(count);
                        modalDuration.textContent = card.dataset.duration;
                        modalStart.href = card.dataset.url;
                        modalStart.classList.toggle('hidden', count === 0);
                        modalEmpty.classList.toggle('hidden', count > 0);
                        open();
                    });
                });

                document.getElementById('soalModalClose').addEventListener('click', close);
                document.getElementById('soalModalBackdrop').addEventListener('click', close);
                document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
            });
        </script>
    @endpush
</x-dashboard-layout>
