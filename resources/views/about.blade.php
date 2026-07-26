<x-layouts.public :settings="$settings" title="About Us" metaDescription="Learn about Boza Marine Solutions and Crewing Services — our vision, mission, and commitment to compliant, certified maritime and HR solutions.">

    {{-- Page header --}}
    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_about])
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">About Us</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Certified people. Compliant processes.</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">{{ $settings->about_text }}</p>
        </div>
    </section>

    @if ($settings->about_image)
        <section class="py-16">
            <div class="container-boza">
                <div class="reveal flex h-80 w-full items-center justify-center overflow-hidden rounded-2xl bg-navy-50 shadow-soft sm:h-96">
                    <img src="{{ asset('storage/'.$settings->about_image) }}" alt="{{ $settings->company_name }}" class="h-full w-full object-contain">
                </div>
            </div>
        </section>
    @endif

    {{-- Goal / Vision / Mission --}}
    <section class="py-20 sm:py-24">
        <div class="container-boza grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div class="rounded-xl border border-navy-100 p-8">
                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                    <x-icon name="bolt" class="h-6 w-6" />
                </span>
                <h3 class="mt-5 text-lg font-semibold text-navy-900">Our Goal</h3>
                <p class="mt-2 text-sm leading-relaxed text-navy-600">{{ $settings->goal_text }}</p>
            </div>
            <div class="rounded-xl border border-navy-100 p-8">
                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                    <x-icon name="globe" class="h-6 w-6" />
                </span>
                <h3 class="mt-5 text-lg font-semibold text-navy-900">Our Vision</h3>
                <p class="mt-2 text-sm leading-relaxed text-navy-600">{{ $settings->vision_text }}</p>
            </div>
            <div class="rounded-xl border border-navy-100 p-8">
                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                    <x-icon name="shield-check" class="h-6 w-6" />
                </span>
                <h3 class="mt-5 text-lg font-semibold text-navy-900">Our Mission</h3>
                <p class="mt-2 text-sm leading-relaxed text-navy-600">{{ $settings->mission_text }}</p>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    @if ($stats->count())
        <section class="border-y border-navy-100 bg-navy-50/50">
            <div class="container-boza grid grid-cols-2 gap-8 py-12 sm:grid-cols-4">
                @foreach ($stats as $stat)
                    <div class="text-center">
                        <p class="font-display text-4xl font-semibold text-navy-900">{{ $stat->value }}<span class="text-[var(--color-primary)]">{{ $stat->suffix }}</span></p>
                        <p class="mt-2 text-xs font-semibold uppercase tracking-wider text-navy-400">{{ $stat->label }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Regulatory alignment & industries --}}
    <section class="py-20 sm:py-24">
        <div class="container-boza grid grid-cols-1 gap-14 lg:grid-cols-2">
            <div>
                <p class="section-eyebrow">Regulatory Alignment</p>
                <h2 class="font-display mt-3 text-2xl font-semibold text-navy-900">Compliant by design</h2>
                <ul class="mt-6 space-y-3">
                    @foreach (['Ghana Maritime Authority', 'Ghana Labour Act 2003 [Act 651]', 'MLC 2006', 'STCW'] as $item)
                        <li class="flex items-center gap-3 text-navy-700">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                                <x-icon name="check" class="h-4 w-4" />
                            </span>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="section-eyebrow">Key Client Sectors</p>
                <h2 class="font-display mt-3 text-2xl font-semibold text-navy-900">Who we serve</h2>
                <div class="mt-6 space-y-5">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-navy-900">Offshore</p>
                        <p class="mt-1 text-sm text-navy-600">Oil &amp; Gas Operators, Marine Contractors, FPSO Companies</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-navy-900">Maritime</p>
                        <p class="mt-1 text-sm text-navy-600">Ship Owners, Ship Managers, Port Terminals</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-navy-900">Land-Based</p>
                        <p class="mt-1 text-sm text-navy-600">Logistics Firms, Construction Companies, Facility Management Contractors, Cleaning &amp; Transport Contractors</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Leadership teaser --}}
    @if ($settings->nav_leadership_visible ?? true)
        <section class="bg-navy-50/50 py-16">
            <div class="container-boza flex flex-col items-center gap-5 text-center">
                <p class="section-eyebrow">Leadership</p>
                <h2 class="font-display text-2xl font-semibold text-navy-900 sm:text-3xl">Meet our Directors &amp; Management</h2>
                <p class="max-w-xl text-navy-600">The people steering Boza Marine Solutions' commitment to compliance, safety, and service.</p>
                <a href="{{ route('leadership') }}" class="btn-primary">
                    Meet the Team <x-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        </section>
    @endif

    {{-- Differentiators --}}
    <section class="bg-brand-dark py-20 text-white sm:py-24">
        <div class="container-boza">
            <div class="mx-auto max-w-2xl text-center">
                <p class="section-eyebrow text-brand-accent">Our Differentiators</p>
                <h2 class="font-display mt-3 text-3xl font-semibold">What sets us apart</h2>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($differentiators as $item)
                    <div class="text-center">
                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-white/10 text-[var(--color-accent)]">
                            <x-icon :name="$item->icon" class="h-7 w-7" />
                        </span>
                        <h3 class="mt-5 text-base font-semibold">{{ $item->title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-white/60">{{ $item->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Commitment --}}
    <section class="py-20 sm:py-24">
        <div class="container-boza">
            <div class="mx-auto max-w-2xl text-center">
                <p class="section-eyebrow">Commitment</p>
                <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900">Quality, safety &amp; people</h2>
            </div>

            <div class="mx-auto mt-12 grid max-w-4xl grid-cols-1 gap-5 sm:grid-cols-2">
                @foreach ([
                    'All seafarers are STCW and medically certified with MLC 2006',
                    'All HR processes audited for Labour Act 2003 [Act 651] and tax compliance',
                    'HSE is embedded in all field and vessel operations',
                    'Priority on Ghanaian talent development and local content',
                ] as $item)
                    <div class="flex items-start gap-3 rounded-lg border border-navy-100 p-5">
                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-accent-soft text-[var(--color-accent)]">
                            <x-icon name="check" class="h-4 w-4" />
                        </span>
                        <p class="text-sm text-navy-700">{{ $item }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-brand-cta">
        <div class="container-boza flex flex-col items-center gap-6 py-16 text-center text-white">
            <h2 class="font-display text-3xl font-semibold sm:text-4xl">Let's build a compliant, reliable workforce together</h2>
            <a href="{{ route('contact') }}" class="btn-gold">Talk to Our Team</a>
        </div>
    </section>

</x-layouts.public>
