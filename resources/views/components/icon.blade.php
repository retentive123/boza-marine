@props(['name' => 'check'])

<svg {{ $attributes->merge(['class' => 'w-6 h-6', 'fill' => 'none', 'viewBox' => '0 0 24 24', 'stroke' => 'currentColor', 'stroke-width' => '1.5']) }} stroke-linecap="round" stroke-linejoin="round">
    @switch($name)
        @case('ship')
            <path d="M3 18l1.5-6h15L21 18" />
            <path d="M4.5 12L6 4h12l1.5 8" />
            <path d="M12 4V2" />
            <path d="M2.5 18c1.5 2 4 2 5.5 0 1.5 2 4 2 5.5 0 1.5 2 4 2 5.5 0" />
            @break

        @case('briefcase')
            <rect x="3" y="7" width="18" height="12" rx="1.5" />
            <path d="M8 7V5.5A1.5 1.5 0 019.5 4h5A1.5 1.5 0 0116 5.5V7" />
            <path d="M3 12h18" />
            @break

        @case('academic-cap')
            <path d="M12 4L2 9l10 5 10-5-10-5z" />
            <path d="M6 11.5V17c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" />
            <path d="M22 9v6" />
            @break

        @case('truck')
            <rect x="2" y="8" width="12" height="9" rx="1" />
            <path d="M14 11h4l3 3v3h-7z" />
            <circle cx="6.5" cy="18.5" r="1.75" />
            <circle cx="17.5" cy="18.5" r="1.75" />
            @break

        @case('users')
            <circle cx="9" cy="8" r="3.25" />
            <path d="M2.5 20c0-3.5 3-6 6.5-6s6.5 2.5 6.5 6" />
            <circle cx="17.5" cy="8.5" r="2.5" />
            <path d="M16 14.2c2.7.4 4.7 2.4 5 5.8" />
            @break

        @case('building-office')
            <rect x="4" y="3" width="12" height="18" rx="1" />
            <path d="M16 21v-6h4v6" />
            <path d="M7.5 7h1.5M11 7h1.5M7.5 11h1.5M11 11h1.5M7.5 15h1.5M11 15h1.5" />
            @break

        @case('shield-check')
            <path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z" />
            <path d="M9 12l2 2 4-4" />
            @break

        @case('scale')
            <path d="M12 3v18M8 21h8" />
            <path d="M5 7h6M13 7h6" />
            <path d="M5 7l-2.5 5a2.5 2.5 0 005 0L5 7z" />
            <path d="M19 7l-2.5 5a2.5 2.5 0 005 0L19 7z" />
            @break

        @case('bolt')
            <path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z" />
            @break

        @case('globe')
            <circle cx="12" cy="12" r="9" />
            <path d="M3 12h18M12 3c2.5 2.5 4 5.7 4 9s-1.5 6.5-4 9c-2.5-2.5-4-5.7-4-9s1.5-6.5 4-9z" />
            @break

        @case('check')
            <path d="M20 6L9 17l-5-5" />
            @break

        @case('phone')
            <path d="M4 3h3.2l1.6 4.5-2 1.6a12 12 0 006.1 6.1l1.6-2 4.5 1.6V18a2 2 0 01-2.2 2A16.5 16.5 0 014 5.2 2 2 0 016 3z" />
            @break

        @case('mail')
            <rect x="3" y="5" width="18" height="14" rx="1.5" />
            <path d="M3.5 6.5L12 13l8.5-6.5" />
            @break

        @case('map-pin')
            <path d="M12 21s7-6.2 7-11.5A7 7 0 105 9.5C5 14.8 12 21 12 21z" />
            <circle cx="12" cy="9.5" r="2.5" />
            @break

        @case('chevron-down')
            <path d="M6 9l6 6 6-6" />
            @break

        @case('chevron-right')
            <path d="M9 6l6 6-6 6" />
            @break

        @case('clock')
            <circle cx="12" cy="12" r="9" />
            <path d="M12 7v5l3.5 2" />
            @break

        @case('document-text')
            <path d="M7 3h7l4 4v14H7z" />
            <path d="M14 3v4h4" />
            <path d="M9.5 12h5M9.5 15.5h5" />
            @break

        @case('star')
            <path d="M12 3l2.7 5.9 6.3.8-4.6 4.4 1.2 6.4L12 17.6l-5.6 2.9 1.2-6.4L3 9.7l6.3-.8L12 3z" />
            @break

        @case('menu')
            <path d="M4 6h16M4 12h16M4 18h16" />
            @break

        @case('x')
            <path d="M6 6l12 12M18 6L6 18" />
            @break

        @case('arrow-right')
            <path d="M5 12h14M13 6l6 6-6 6" />
            @break

        @case('upload')
            <path d="M12 16V4M7 9l5-5 5 5" />
            <path d="M4 16v3a2 2 0 002 2h12a2 2 0 002-2v-3" />
            @break

        @case('image')
        @case('photo')
            <rect x="3" y="4" width="18" height="16" rx="2" />
            <circle cx="8.5" cy="9.5" r="1.75" />
            <path d="M4 17l5-5 3.5 3.5L17 10l3 3" />
            @break

        @case('external-link')
            <path d="M14 4h6v6M20 4L10 14" />
            <path d="M18 13v5a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h5" />
            @break

        @case('search')
            <circle cx="10.5" cy="10.5" r="6.5" />
            <path d="M20 20l-4.85-4.85" />
            @break

        @case('newspaper')
            <rect x="3" y="5" width="18" height="14" rx="1.5" />
            <path d="M3 9.5h18" />
            <path d="M7 13h3.5M7 16h3.5M13.5 13h3.5M13.5 16h3.5" />
            @break

        @case('inbox')
            <path d="M3 12h4.5l1.5 3h6l1.5-3H21" />
            <path d="M5.5 5h13l2.5 7v7a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 19v-7l2.5-7z" />
            @break

        @case('sparkle')
            <path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3z" />
            <path d="M19 3l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7L19 3z" />
            @break

        @case('stack')
            <rect x="7" y="7" width="13" height="13" rx="1.5" />
            <path d="M4 14V5.5A1.5 1.5 0 015.5 4H14" />
            @break

        @default
            <path d="M20 6L9 17l-5-5" />
    @endswitch
</svg>
