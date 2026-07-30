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

    {{-- Goal / Vision / Mission --}}
    <section class="py-20 sm:py-24">
        <div class="container-boza grid grid-cols-1 gap-10 {{ $settings->about_image ? 'lg:grid-cols-2 lg:items-center lg:gap-14' : '' }}">
            @if ($settings->about_image)
                <div class="reveal order-1">
                    <div class="flex h-80 w-full items-center justify-center overflow-hidden rounded-2xl bg-navy-50 shadow-soft sm:h-[26rem]">
                        <img src="{{ asset('storage/'.$settings->about_image) }}" alt="{{ $settings->company_name }}" loading="lazy" class="h-full w-full object-contain">
                    </div>
                </div>
            @endif

            <div class="order-2 grid grid-cols-1 gap-6 {{ $settings->about_image ? '' : 'sm:grid-cols-3' }}">
                @foreach ([
                    ['icon' => 'bolt', 'title' => 'Our Goal', 'text' => $settings->goal_text],
                    ['icon' => 'globe', 'title' => 'Our Vision', 'text' => $settings->vision_text],
                    ['icon' => 'shield-check', 'title' => 'Our Mission', 'text' => $settings->mission_text],
                ] as $card)
                    <div class="reveal group rounded-xl border border-navy-100 bg-navy-50/60 p-8 transition duration-300 hover:-translate-y-1.5 hover:border-transparent hover:bg-white hover:shadow-soft" style="transition-delay: {{ $loop->index * 100 }}ms">
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)] transition duration-300 group-hover:bg-[var(--color-primary)] group-hover:text-white">
                            <x-icon :name="$card['icon']" class="h-6 w-6" />
                        </span>
                        <h3 class="mt-5 text-lg font-semibold text-navy-900">{{ $card['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-navy-600">{{ $card['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Stats --}}
    @if ($stats->count())
        <section class="border-y border-navy-100 bg-navy-50/50">
            <div class="container-boza grid grid-cols-2 gap-8 py-12 sm:grid-cols-4">
                @foreach ($stats as $stat)
                    <div class="reveal text-center" style="transition-delay: {{ $loop->index * 80 }}ms">
                        <p class="font-display text-4xl font-semibold text-navy-900">{{ $stat->value }}<span class="text-[var(--color-primary)]">{{ $stat->suffix }}</span></p>
                        <p class="mt-2 text-xs font-semibold uppercase tracking-wider text-navy-400">{{ $stat->label }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Regulatory alignment & industries --}}
    <section class="bg-navy-50/50 py-20 sm:py-24">
        <div class="container-boza grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-stretch">
            <div class="reveal rounded-2xl border border-navy-100 bg-white p-8 shadow-sm sm:p-10">
                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                    <x-icon name="scale" class="h-6 w-6" />
                </span>
                <p class="section-eyebrow mt-5">Regulatory Alignment</p>
                <h2 class="font-display mt-2 text-2xl font-semibold text-navy-900">Compliant by design</h2>
                <ul class="mt-6 space-y-2">
                    @foreach (['Ghana Maritime Authority', 'Ghana Labour Act 2003 [Act 651]', 'MLC 2006', 'STCW'] as $item)
                        <li class="group -mx-3 flex items-center gap-3 rounded-lg px-3 py-2.5 text-navy-700 transition duration-200 hover:bg-navy-50">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)] transition duration-200 group-hover:bg-[var(--color-primary)] group-hover:text-white">
                                <x-icon name="check" class="h-4 w-4" />
                            </span>
                            <span class="font-medium">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="reveal rounded-2xl border border-navy-100 bg-white p-8 shadow-sm sm:p-10" style="transition-delay: 100ms">
                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                    <x-icon name="briefcase" class="h-6 w-6" />
                </span>
                <p class="section-eyebrow mt-5">Key Client Sectors</p>
                <h2 class="font-display mt-2 text-2xl font-semibold text-navy-900">Who we serve</h2>
                <div class="mt-6 space-y-2">
                    @foreach ([
                        ['icon' => 'globe', 'label' => 'Offshore', 'text' => 'Oil & Gas Operators, Marine Contractors, FPSO Companies'],
                        ['icon' => 'ship', 'label' => 'Maritime', 'text' => 'Ship Owners, Ship Managers, Port Terminals'],
                        ['icon' => 'truck', 'label' => 'Land-Based', 'text' => 'Logistics Firms, Construction Companies, Facility Management Contractors, Cleaning & Transport Contractors'],
                    ] as $sector)
                        <div class="group -mx-3 flex items-start gap-3 rounded-lg px-3 py-2.5 transition duration-200 hover:bg-navy-50">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)] transition duration-200 group-hover:bg-[var(--color-primary)] group-hover:text-white">
                                <x-icon :name="$sector['icon']" class="h-4 w-4" />
                            </span>
                            <div>
                                <p class="text-sm font-bold uppercase tracking-wider text-navy-900">{{ $sector['label'] }}</p>
                                <p class="mt-0.5 text-sm text-navy-600">{{ $sector['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Leadership teaser --}}
    @if ($settings->nav_leadership_visible ?? true)
        <section class="bg-navy-50/50 py-16">
            <div class="reveal container-boza flex flex-col items-center gap-5 text-center">
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
            <div class="reveal mx-auto max-w-2xl text-center">
                <p class="section-eyebrow text-brand-accent">Our Differentiators</p>
                <h2 class="font-display mt-3 text-3xl font-semibold">What sets us apart</h2>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($differentiators as $item)
                    <div class="reveal text-center" style="transition-delay: {{ $loop->index * 90 }}ms">
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
            <div class="reveal mx-auto max-w-2xl text-center">
                <p class="section-eyebrow">Commitment</p>
                <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900">Quality, safety &amp; people</h2>
            </div>

            <div class="mx-auto mt-12 grid max-w-5xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['icon' => 'academic-cap', 'title' => 'Certified Crew', 'text' => 'All seafarers are STCW and medically certified with MLC 2006.'],
                    ['icon' => 'scale', 'title' => 'Full Compliance', 'text' => 'All HR processes audited for Labour Act 2003 [Act 651] and tax compliance.'],
                    ['icon' => 'shield-check', 'title' => 'HSE Embedded', 'text' => 'Health, safety, and environment is embedded in all field and vessel operations.'],
                    ['icon' => 'users', 'title' => 'Local Talent', 'text' => 'Priority on Ghanaian talent development and local content.'],
                ] as $item)
                    <div class="reveal group rounded-xl border border-navy-100 bg-brand-secondary-soft p-6 text-center transition duration-300 hover:-translate-y-1.5 hover:border-transparent hover:bg-white hover:shadow-soft" style="transition-delay: {{ $loop->index * 90 }}ms">
                        <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-brand-accent-soft text-[var(--color-accent)] transition duration-300 group-hover:bg-[var(--color-accent)] group-hover:text-white">
                            <x-icon :name="$item['icon']" class="h-6 w-6" />
                        </span>
                        <h3 class="mt-4 text-sm font-semibold text-navy-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-navy-600">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.clients-strip')

    {{-- CTA --}}
    <section class="bg-brand-cta">
        <div class="reveal container-boza flex flex-col items-center gap-6 py-16 text-center text-white">
            <h2 class="font-display text-3xl font-semibold sm:text-4xl">Let's build a compliant, reliable workforce together</h2>
            <a href="{{ route('contact') }}" class="btn-gold">Talk to Our Team</a>
        </div>
    </section>

</x-layouts.public>
