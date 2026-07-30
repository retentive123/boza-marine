<x-layouts.public :settings="$settings" title="Our Services" metaDescription="Offshore crewing, landbase recruitment, consultancy, logistics, and HR outsourcing services from Boza Marine Solutions.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_services])
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">What We Do</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Our Services</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                One-stop crewing, HR, logistics, and consultancy solutions — for offshore vessels and land-based operations alike.
            </p>
        </div>
    </section>

    <div class="border-b border-navy-100 bg-navy-50/50">
        <div class="container-boza flex flex-wrap items-center justify-center gap-x-10 gap-y-3 py-6 text-xs font-semibold uppercase tracking-wider text-navy-400">
            <span class="flex items-center gap-2"><x-icon name="shield-check" class="h-4 w-4 text-[var(--color-primary)]" /> Ghana Maritime Authority</span>
            <span class="flex items-center gap-2"><x-icon name="scale" class="h-4 w-4 text-[var(--color-primary)]" /> Labour Act 2003 [Act 651]</span>
            <span class="flex items-center gap-2"><x-icon name="globe" class="h-4 w-4 text-[var(--color-primary)]" /> MLC 2006</span>
            <span class="flex items-center gap-2"><x-icon name="academic-cap" class="h-4 w-4 text-[var(--color-primary)]" /> STCW</span>
        </div>
    </div>

    <section class="py-20 sm:py-24">
        <div class="container-boza" x-data="{ category: 'All' }">
            @php $categories = $services->pluck('category')->unique()->values(); @endphp

            @if ($categories->count() > 1)
                <div class="reveal flex flex-wrap justify-center gap-3 rounded-full bg-navy-50/60 p-2 sm:inline-flex sm:mx-auto sm:block">
                    <button
                        @click="category = 'All'"
                        :class="category === 'All' ? 'text-white shadow-soft' : 'text-navy-600 hover:text-[var(--color-primary)]'"
                        :style="category === 'All' ? 'background-color: var(--color-primary)' : ''"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition active:scale-95"
                    >All Services</button>
                    @foreach ($categories as $cat)
                        <button
                            @click="category = '{{ $cat }}'"
                            :class="category === '{{ $cat }}' ? 'text-white shadow-soft' : 'text-navy-600 hover:text-[var(--color-primary)]'"
                            :style="category === '{{ $cat }}' ? 'background-color: var(--color-primary)' : ''"
                            class="rounded-full px-4 py-2 text-sm font-semibold transition active:scale-95"
                        >{{ $cat }}</button>
                    @endforeach
                </div>
            @endif

            <div class="mt-12 grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $service)
                    <a href="{{ route('services.show', $service) }}"
                       x-show="category === 'All' || category === '{{ $service->category }}'"
                       x-transition:enter="transition ease-out duration-300"
                       x-transition:enter-start="opacity-0 scale-95"
                       x-transition:enter-end="opacity-100 scale-100"
                       class="reveal group flex flex-col overflow-hidden rounded-2xl border border-navy-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-transparent hover:shadow-soft"
                       style="transition-delay: {{ $loop->index * 80 }}ms">
                        @if ($service->image_path)
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/'.$service->image_path) }}" alt="{{ $service->title }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                                <span class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-[var(--color-primary)] backdrop-blur">
                                    {{ $service->category }}
                                </span>
                                <span class="absolute bottom-4 left-4 flex h-11 w-11 items-center justify-center rounded-full text-white shadow-soft transition duration-300 group-hover:scale-110" style="background-color: var(--color-primary)">
                                    <x-icon :name="$service->icon" class="h-5 w-5" />
                                </span>
                            </div>
                        @endif
                        <div class="flex flex-1 flex-col p-7">
                            @unless ($service->image_path)
                                <div class="flex items-center justify-between">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)] transition duration-300 group-hover:bg-[var(--color-primary)] group-hover:text-white">
                                        <x-icon :name="$service->icon" class="h-6 w-6" />
                                    </span>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--color-primary)]">{{ $service->category }}</span>
                                </div>
                            @endunless
                            <h2 class="{{ $service->image_path ? '' : 'mt-5' }} text-lg font-semibold text-navy-900">{{ $service->title }}</h2>
                            <p class="mt-2 flex-1 text-sm leading-relaxed text-navy-600">{{ $service->summary }}</p>
                            <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)]">
                                View details <x-icon name="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1" />
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-brand-cta">
        <div class="reveal container-boza flex flex-col items-center gap-6 py-16 text-center text-white">
            <h2 class="font-display text-3xl font-semibold sm:text-4xl">Not sure which service you need?</h2>
            <p class="max-w-xl text-white/85">Tell us about your vessel, project, or workforce needs and our team will recommend the right solution.</p>
            <a href="{{ route('contact') }}" class="btn-gold">Talk to Our Team</a>
        </div>
    </section>

</x-layouts.public>
