@props(['level' => null])

@php
    $level = is_string($level) ? $level : null;
    $label = $level !== null ? (\App\Models\McqQuestion::DIFFICULTIES[$level] ?? null) : null;
    $styles = [
        'mudah' => 'bg-emerald-50 border-emerald-100 text-emerald-700',
        'sedang' => 'bg-amber-50 border-amber-100 text-amber-700',
        'sulit' => 'bg-rose-50 border-rose-100 text-rose-700',
    ];
@endphp

@if ($label !== null)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full border px-2.5 py-0.5 text-[11px] font-extrabold uppercase tracking-wider '.($styles[$level] ?? 'bg-gray-50 border-gray-200 text-gray-500')]) }}>{{ $label }}</span>
@endif
