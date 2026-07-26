@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-navy-800']) }}>
    {{ $value ?? $slot }}
</label>
