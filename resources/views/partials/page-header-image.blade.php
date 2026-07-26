@php $image ??= null; @endphp

@if ($image)
    <div
        class="pointer-events-none absolute inset-y-0 right-0 hidden w-1/2 sm:block lg:w-2/5"
        style="
            mask-image: linear-gradient(to right, transparent 0%, black 50%);
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 50%);
        "
    >
        <img
            src="{{ asset('storage/'.$image) }}"
            alt=""
            class="h-full w-full object-cover opacity-40 mix-blend-luminosity"
        >
        <div class="absolute inset-0 bg-brand-hero opacity-70"></div>
    </div>
@endif
