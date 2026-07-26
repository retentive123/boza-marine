@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]']) }}>
