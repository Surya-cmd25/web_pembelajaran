<x-dashboard-layout title="Ruang Materi" active="materi">

    @php
        $cardStyles = [
            [
                'icon' => 'bg-blue-50 text-blue-600',
                'hover' => 'group-hover:text-blue-600',
                'link' => 'text-blue-600 hover:text-blue-700',
                'badge' => 'bg-blue-50 text-blue-700',
                'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
            ],
            [
                'icon' => 'bg-amber-50 text-amber-600',
                'hover' => 'group-hover:text-amber-600',
                'link' => 'text-amber-600 hover:text-amber-700',
                'badge' => 'bg-amber-50 text-amber-700',
                'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>',
            ],
            [
                'icon' => 'bg-emerald-50 text-emerald-600',
                'hover' => 'group-hover:text-emerald-600',
                'link' => 'text-emerald-600 hover:text-emerald-700',
                'badge' => 'bg-blue-50 text-blue-700',
                'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
            ],
            [
                'icon' => 'bg-orange-50 text-orange-600',
                'hover' => 'group-hover:text-orange-600',
                'link' => 'text-orange-600 hover:text-orange-700',
                'badge' => 'bg-orange-50 text-orange-700',
                'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
            ],
        ];
    @endphp

    <!-- Title & Subtitle -->
    <div>
        <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">
            Ruang Materi
        </h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">
            Baca materi dan dengarkan penjelasan dalam bentuk audio.
        </p>
    </div>

    <!-- Grid Materi Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

        @foreach ($materiList as $index => $materi)
            @php
                $style = $cardStyles[$index % count($cardStyles)];
                $isRead = $readSlugs->contains($materi->slug);
            @endphp

            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs hover:shadow-md p-5 flex flex-col justify-between transition-all duration-200 group">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <!-- Ikon Materi -->
                        <div class="w-11 h-11 rounded-2xl {{ $style['icon'] }} flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $style['svg'] !!}</svg>
                        </div>

                        @if ($isRead)
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold uppercase tracking-wider">
                                SELESAI DIBACA
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-md {{ $style['badge'] }} text-[10px] font-extrabold uppercase tracking-wider">
                                BELUM DIBACA
                            </span>
                        @endif
                    </div>

                    <h3 class="text-base font-extrabold text-gray-900 mt-4 {{ $style['hover'] }} transition-colors">
                        {{ $materi->title }}
                    </h3>
                    <p class="text-xs text-gray-500 leading-relaxed mt-1">
                        {{ $materi->summary }}
                    </p>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">
                        @if ($materi->audio_path)
                            Audio {{ $materi->formattedDuration() }}
                        @else
                            Audio belum tersedia
                        @endif
                    </span>
                    <a href="{{ route('materi.show', $materi->slug) }}" class="font-bold {{ $style['link'] }} flex items-center gap-1 transition-colors">
                        Buka →
                    </a>
                </div>
            </div>
        @endforeach

    </div>

</x-dashboard-layout>
