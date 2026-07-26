<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-md border border-transparent bg-[var(--color-primary)] px-4 py-2.5 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-[color-mix(in_srgb,var(--color-primary)_85%,black)] focus:bg-[color-mix(in_srgb,var(--color-primary)_85%,black)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:ring-offset-2 active:bg-[color-mix(in_srgb,var(--color-primary)_70%,black)]']) }}>
    {{ $slot }}
</button>
