@props(['light' => false])

@php $siteSettings = \App\Models\SiteSetting::current(); @endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5']) }}>
    @if ($siteSettings->logo_path)
        <img src="{{ asset('storage/'.$siteSettings->logo_path) }}" alt="{{ $siteSettings->company_name }}" class="h-10 w-10 shrink-0 rounded-full object-cover {{ $light ? 'ring-1 ring-white/25' : '' }}">
    @else
        <span class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $light ? 'bg-white/10 ring-1 ring-white/25' : 'bg-navy-900' }}">
            <svg viewBox="0 0 40 40" class="h-6 w-6" fill="none" style="stroke: {{ $light ? '#ffffff' : 'var(--color-accent)' }}" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="20" cy="20" r="15" />
                <circle cx="20" cy="20" r="2.4" style="fill: {{ $light ? '#ffffff' : 'var(--color-accent)' }}" stroke="none" />
                <path d="M20 5v6M20 29v6M5 20h6M29 20h6M9.4 9.4l4.2 4.2M26.4 26.4l4.2 4.2M9.4 30.6l4.2-4.2M26.4 13.6l4.2-4.2" />
            </svg>
        </span>
    @endif
    <span class="flex flex-col leading-none">
        <span class="font-display text-xl font-semibold tracking-tight {{ $light ? 'text-white' : 'text-navy-900' }}">{{ strtoupper(str($siteSettings->company_name)->explode(' ')->first() ?: 'Boza') }}</span>
        <span class="text-[10px] font-semibold uppercase tracking-[0.18em] {{ $light ? 'text-white/70' : '' }}" @unless($light) style="color: var(--color-primary)" @endunless>Marine Solutions</span>
    </span>
</span>
