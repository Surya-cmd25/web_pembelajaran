@props(['slug' => ''])

<svg {{ $attributes->merge(['class' => 'w-24 h-24']) }} viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
    @switch($slug)
        @case('norma-agama')
            {{-- Kubah masjid, bulan sabit, dan cahaya --}}
            <circle cx="60" cy="60" r="52" fill="#DBEAFE"/>
            <path d="M28 96V70h64v26H28z" fill="#93C5FD"/>
            <path d="M34 70c0-16 11-28 26-28s26 12 26 28H34z" fill="#2563EB"/>
            <rect x="57.5" y="26" width="5" height="16" rx="2.5" fill="#1D4ED8"/>
            <path d="M66 18a8 8 0 11-9.5-7.8A6.5 6.5 0 0066 18z" fill="#FBBF24"/>
            <path d="M54 96V84a6 6 0 0112 0v12H54z" fill="#EFF6FF"/>
            <rect x="20" y="52" width="8" height="44" rx="2" fill="#60A5FA"/>
            <path d="M24 42l5 10h-10l5-10z" fill="#2563EB"/>
            <rect x="92" y="52" width="8" height="44" rx="2" fill="#60A5FA"/>
            <path d="M96 42l5 10H91l5-10z" fill="#2563EB"/>
            @break

        @case('norma-kesusilaan')
            {{-- Hati nurani --}}
            <circle cx="60" cy="60" r="52" fill="#FFE4E6"/>
            <path d="M60 92S26 72 26 48c0-12 9-20 20-20 6 0 11 3 14 8 3-5 8-8 14-8 11 0 20 8 20 20 0 24-34 44-34 44z" fill="#F43F5E"/>
            <path d="M42 40c-6 1-10 6-10 12" stroke="#FDA4AF" stroke-width="4" stroke-linecap="round"/>
            <circle cx="46" cy="52" r="3" fill="#FFF1F2"/>
            <circle cx="74" cy="52" r="3" fill="#FFF1F2"/>
            <path d="M48 64c6 7 18 7 24 0" stroke="#FFF1F2" stroke-width="4" stroke-linecap="round"/>
            <path d="M92 22l2.5 6 6 2.5-6 2.5L92 39l-2.5-6-6-2.5 6-2.5L92 22z" fill="#FBBF24"/>
            @break

        @case('norma-kesopanan')
            {{-- Dua orang berjabat tangan / membungkuk sopan --}}
            <circle cx="60" cy="60" r="52" fill="#D1FAE5"/>
            <circle cx="40" cy="38" r="9" fill="#FBBF24"/>
            <path d="M24 90c0-14 7-24 16-24s16 10 16 24H24z" fill="#10B981"/>
            <circle cx="80" cy="38" r="9" fill="#FCD34D"/>
            <path d="M64 90c0-14 7-24 16-24s16 10 16 24H64z" fill="#059669"/>
            <path d="M48 74l12-6 12 6-12 8-12-8z" fill="#ECFDF5"/>
            <path d="M54 76l6 3 6-3" stroke="#10B981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M52 16c2 4 6 4 8 0 2 4 6 4 8 0" stroke="#34D399" stroke-width="3" stroke-linecap="round"/>
            @break

        @default
            {{-- Timbangan keadilan (hukum) --}}
            <circle cx="60" cy="60" r="52" fill="#FEF3C7"/>
            <rect x="57" y="24" width="6" height="62" rx="3" fill="#B45309"/>
            <rect x="38" y="86" width="44" height="8" rx="4" fill="#92400E"/>
            <rect x="24" y="32" width="72" height="5" rx="2.5" fill="#D97706"/>
            <circle cx="60" cy="24" r="6" fill="#F59E0B"/>
            <path d="M28 37l-12 26h24L28 37z" fill="#FDE68A" stroke="#D97706" stroke-width="2.5" stroke-linejoin="round"/>
            <path d="M12 63a16 8 0 0032 0H12z" fill="#F59E0B"/>
            <path d="M92 37L80 63h24L92 37z" fill="#FDE68A" stroke="#D97706" stroke-width="2.5" stroke-linejoin="round"/>
            <path d="M76 63a16 8 0 0032 0H76z" fill="#F59E0B"/>
    @endswitch
</svg>
