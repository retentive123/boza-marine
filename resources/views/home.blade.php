<x-layouts.public :settings="$settings" title="Home" metaDescription="Ghanaian-owned maritime crewing, HR outsourcing, consultancy, and logistics for offshore and land-based operations across West Africa.">

    {{-- Hero --}}
    @php
        $heroSlideData = $heroSlides->map(fn ($s) => [
            'image' => asset('storage/'.$s->image_path),
            'eyebrow' => $s->eyebrow,
            'title' => $s->title,
            'subtitle' => $s->subtitle,
            'buttonText' => $s->button_text,
            'buttonUrl' => $s->button_url,
        ]);
        $headlineWords = collect(preg_split('/\r?\n/', trim($settings->hero_headline_words ?? '')))
            ->map(fn ($w) => trim($w))
            ->filter()
            ->values();
        $headlineAnimationType = $settings->hero_headline_animation_type ?: 'rotate';
        [$enterStart, $enterEnd, $leaveStart, $leaveEnd] = \App\Support\HeadlineAnimationCatalog::transitionClasses($settings->hero_headline_animation_style ?: 'slide-up');
        $showcaseSlideData = $showcaseImages->map(fn ($s) => [
            'image' => asset('storage/'.$s->image_path),
            'caption' => $s->caption,
        ]);
        $heroBgSlideData = $heroBackgroundImages->isNotEmpty()
            ? $heroBackgroundImages->map(fn ($img) => ['image' => asset('storage/'.$img->image_path)])
            : ($settings->hero_background_image ? collect([['image' => asset('storage/'.$settings->hero_background_image)]]) : collect());
        $heroHasPhoto = $heroSlideData->isEmpty() && $heroBgSlideData->isNotEmpty();
    @endphp
    @if ($heroSlideData->isNotEmpty())
        <section x-data="heroCarousel(@js($heroSlideData))" class="relative overflow-hidden text-white">
            <div class="absolute inset-0">
                <template x-for="(slide, index) in slides" :key="index">
                    <div
                        x-show="current === index"
                        x-transition:enter="transition ease-out duration-[1200ms]"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-700"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 bg-cover bg-center"
                        :style="`background-image: url(${slide.image})`"
                    ></div>
                </template>
                <div class="absolute inset-0 bg-brand-hero opacity-80"></div>
            </div>

            <div class="container-boza relative grid grid-cols-1 items-center gap-12 py-20 lg:min-h-[560px] lg:grid-cols-2 lg:py-28">
                <div>
                    <p class="section-eyebrow text-brand-accent" x-show="active.eyebrow" x-text="active.eyebrow" x-cloak></p>
                    <h1 class="font-display mt-4 text-4xl font-semibold leading-tight sm:text-5xl" x-text="active.title"></h1>
                    <p class="mt-6 max-w-xl text-lg leading-relaxed text-white/85" x-show="active.subtitle" x-text="active.subtitle" x-cloak></p>
                    <div class="mt-9 flex flex-wrap gap-4">
                        <a :href="active.buttonUrl || '{{ route('contact') }}'" class="btn-gold" x-text="active.buttonText || 'Request Crew / Get a Quote'"></a>
                        <a href="{{ route('services.index') }}" class="btn-outline">Explore Our Services</a>
                    </div>

                    <div class="mt-8 flex items-center gap-2" x-show="slides.length > 1">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="goTo(index)" :class="current === index ? 'w-8 bg-white' : 'w-2 bg-white/40'" class="h-2 rounded-full transition-all" :aria-label="'Go to slide ' + (index + 1)"></button>
                        </template>
                    </div>
                </div>

                <div class="relative">
                    <div class="rounded-2xl border border-white/15 bg-white/5 p-8 shadow-soft backdrop-blur">
                        <p class="section-eyebrow text-brand-accent">Scope of Work</p>
                        <ul class="mt-5 space-y-4">
                            @foreach ($services->take(6) as $service)
                                <li class="flex items-center gap-3.5 rounded-lg bg-white/5 px-4 py-3">
                                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[var(--color-accent)]/15 text-[var(--color-accent)]">
                                        <x-icon :name="$service->icon" class="h-5 w-5" />
                                    </span>
                                    <span class="font-semibold">{{ $service->title }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="relative flex flex-wrap items-center justify-center gap-x-8 gap-y-3 pb-8 text-xs font-semibold uppercase tracking-wider text-white/50">
                <span>Ghana Maritime Authority</span>
                <span class="h-1 w-1 rounded-full bg-white/30"></span>
                <span>MLC 2006</span>
                <span class="h-1 w-1 rounded-full bg-white/30"></span>
                <span>STCW</span>
                <span class="h-1 w-1 rounded-full bg-white/30"></span>
                <span>Labour Act 2003 [Act 651]</span>
            </div>

            <svg class="relative block h-10 w-full text-white sm:h-16" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="currentColor">
                <path d="M0 40C240 80 480 0 720 20C960 40 1200 80 1440 40V80H0V40Z" />
            </svg>
        </section>
    @else
        {{-- Default hero: full-bleed photo (rotating, if multiple) on the right, headline + CTAs on the left --}}
        <section class="relative overflow-hidden" @if ($heroHasPhoto) x-data="heroCarousel(@js($heroBgSlideData))" @endif>
            <div class="absolute inset-0">
                @if ($heroHasPhoto)
                    <template x-for="(slide, index) in slides" :key="index">
                        <div
                            x-show="current === index"
                            x-transition:enter="transition ease-out duration-[1200ms]"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-700"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute inset-0 bg-cover bg-center"
                            :style="`background-image: url(${slide.image})`"
                        ></div>
                    </template>
                    <div class="absolute inset-0 bg-white/10 bg-gradient-to-t from-white/35 via-transparent to-transparent sm:bg-gradient-to-r sm:from-white/55 sm:via-white/30 sm:to-transparent"></div>
                    <div class="absolute inset-0 hidden sm:block bg-gradient-to-t from-white/25 via-transparent to-transparent"></div>
                @else
                    <div class="absolute inset-0 bg-brand-hero"></div>
                    <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 20%, white 1px, transparent 1px); background-size: 28px 28px;"></div>
                @endif
            </div>

            <div class="container-boza relative flex min-h-[440px] items-center py-14 sm:min-h-0 sm:py-20 lg:py-28">
                <div class="max-w-xl {{ $heroHasPhoto ? 'rounded-2xl bg-white/90 p-6 backdrop-blur-sm sm:rounded-none sm:bg-transparent sm:p-0 sm:backdrop-blur-none' : '' }}">
                    <p class="section-eyebrow {{ $heroHasPhoto ? '' : 'text-brand-accent' }}">Ghanaian-Owned · Maritime &amp; HR Solutions</p>
                    <h1 class="font-display mt-4 text-4xl font-bold leading-tight sm:text-5xl lg:text-[3.25rem] {{ $heroHasPhoto ? 'text-navy-900' : 'text-white' }}">
                        @if ($headlineWords->isNotEmpty() && $headlineAnimationType === 'typing')
                            @if ($settings->hero_headline_prefix)
                                <span class="block">{{ $settings->hero_headline_prefix }}</span>
                            @endif
                            <span x-data="headlineTyper(@js($headlineWords))" class="mt-1 block" style="color: var(--color-primary)">
                                <span x-text="display"></span><span class="animate-pulse">|</span>
                            </span>
                            @if ($settings->hero_headline_suffix)
                                <span class="mt-1 block">{{ $settings->hero_headline_suffix }}</span>
                            @endif
                        @elseif ($headlineWords->count() > 1)
                            @if ($settings->hero_headline_prefix)
                                <span class="block">{{ $settings->hero_headline_prefix }}</span>
                            @endif
                            <span x-data="headlineRotator(@js($headlineWords))" class="relative mt-1 inline-grid" style="perspective: 400px">
                                @foreach ($headlineWords as $index => $word)
                                    <span
                                        x-show="current === {{ $index }}"
                                        x-transition:enter="transition ease-out duration-500"
                                        x-transition:enter-start="{{ $enterStart }}"
                                        x-transition:enter-end="{{ $enterEnd }}"
                                        x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="{{ $leaveStart }}"
                                        x-transition:leave-end="{{ $leaveEnd }}"
                                        class="[grid-area:1/1]"
                                        style="color: var(--color-primary)"
                                    >{{ $word }}</span>
                                @endforeach
                            </span>
                            @if ($settings->hero_headline_suffix)
                                <span class="mt-1 block">{{ $settings->hero_headline_suffix }}</span>
                            @endif
                        @else
                            {{ $settings->hero_title ?? 'Your Trusted Partner At Sea and Beyond' }}
                        @endif
                    </h1>
                    <p class="mt-6 max-w-lg text-lg leading-relaxed {{ $heroHasPhoto ? 'text-navy-600' : 'text-white/75' }}">
                        {{ $settings->hero_subtitle ?? 'We bridge the gap between maritime companies and qualified seafarers, while delivering compliant HR and logistics solutions for land-based operations across West Africa.' }}
                    </p>
                    <div class="mt-9 flex flex-wrap gap-4">
                        @if ($heroHasPhoto)
                            <a href="{{ route('services.index') }}" class="btn-secondary">Our Services</a>
                            <a href="{{ route('contact') }}" class="btn-outline-dark">Contact Us</a>
                        @else
                            <a href="{{ route('contact') }}" class="btn-gold">
                                Request Crew / Get a Quote
                                <x-icon name="arrow-right" class="h-4 w-4" />
                            </a>
                            <a href="{{ route('services.index') }}" class="btn-outline">Explore Our Services</a>
                        @endif
                    </div>

                    @if ($heroHasPhoto)
                        <div class="mt-8 flex items-center gap-2" x-show="slides.length > 1">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button @click="goTo(index)" :class="current === index ? 'w-8' : 'w-2 opacity-40'" class="h-2 rounded-full transition-all" style="background-color: var(--color-secondary)" :aria-label="'Go to slide ' + (index + 1)"></button>
                            </template>
                        </div>
                    @endif
                </div>
            </div>

            <div class="relative">
                <svg class="block h-14 w-full sm:h-20" viewBox="0 0 1440 100" preserveAspectRatio="none">
                    <path d="M0 60C240 100 480 20 720 40C960 60 1200 100 1440 60V100H0V60Z" fill="var(--color-primary)" opacity="0.18" />
                </svg>
                <svg class="absolute inset-x-0 bottom-0 block h-10 w-full text-white sm:h-14" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="currentColor">
                    <path d="M0 40C240 80 480 0 720 20C960 40 1200 80 1440 40V80H0V40Z" />
                </svg>
            </div>
        </section>

        {{-- Quick feature strip --}}
        <div class="border-b border-navy-100 bg-white">
            <div class="container-boza grid grid-cols-2 divide-y divide-navy-100 sm:grid-cols-4 sm:divide-x sm:divide-y-0">
                @foreach ([
                    ['icon' => 'users', 'title' => 'Professional Crew', 'subtitle' => 'Qualified & certified'],
                    ['icon' => 'shield-check', 'title' => 'Safety First', 'subtitle' => 'Zero compromise'],
                    ['icon' => 'globe', 'title' => 'Global Standards', 'subtitle' => 'Compliant & reliable'],
                    ['icon' => 'clock', 'title' => '24/7 Support', 'subtitle' => 'Always available'],
                ] as $feature)
                    <div class="flex items-center gap-3 px-4 py-6 sm:px-6">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                            <x-icon :name="$feature['icon']" class="h-5 w-5" />
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-navy-900">{{ $feature['title'] }}</p>
                            <p class="text-xs text-navy-400">{{ $feature['subtitle'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Stats --}}
    @if ($stats->count())
        <section class="border-b border-navy-100 bg-white">
            <div class="container-boza grid grid-cols-2 gap-8 py-12 sm:grid-cols-4">
                @foreach ($stats as $stat)
                    <div class="reveal text-center" style="transition-delay: {{ $loop->index * 80 }}ms" x-data="counter('{{ $stat->value }}')">
                        <p class="font-display text-4xl font-semibold text-navy-900"><span x-text="display"></span><span style="color: var(--color-primary)">{{ $stat->suffix }}</span></p>
                        <p class="mt-2 text-xs font-semibold uppercase tracking-wider text-navy-400">{{ $stat->label }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- About intro --}}
    <section class="py-20 sm:py-28">
        <div class="container-boza grid grid-cols-1 gap-14 lg:grid-cols-2 lg:items-center">
            <div class="reveal">
                @if ($settings->about_image)
                    <div class="mb-8 flex h-64 w-full items-center justify-center overflow-hidden rounded-2xl bg-navy-50 shadow-soft">
                        <img src="{{ asset('storage/'.$settings->about_image) }}" alt="{{ $settings->company_name }}" class="h-full w-full object-contain">
                    </div>
                @endif
                <p class="section-eyebrow">About Boza Marine Solutions</p>
                <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">
                    Your partner across crewing, HR, and logistics
                </h2>
                <p class="mt-6 text-base leading-relaxed text-navy-600">
                    {{ $settings->about_text }}
                </p>
                @if ($settings->nav_about_visible ?? true)
                    <a href="{{ route('about') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[var(--color-primary)] hover:text-[var(--color-primary)]">
                        Learn more about us <x-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                @endif
            </div>

            <div class="reveal grid grid-cols-1 gap-5 sm:grid-cols-1" style="transition-delay: 120ms">
                <div class="rounded-xl border border-navy-100 bg-navy-50/60 p-6">
                    <p class="text-xs font-bold uppercase tracking-wider text-[var(--color-primary)]">Our Goal</p>
                    <p class="mt-2 text-navy-700">{{ $settings->goal_text }}</p>
                </div>
                <div class="rounded-xl border border-navy-100 bg-navy-50/60 p-6">
                    <p class="text-xs font-bold uppercase tracking-wider text-[var(--color-primary)]">Our Vision</p>
                    <p class="mt-2 text-navy-700">{{ $settings->vision_text }}</p>
                </div>
                <div class="rounded-xl border border-navy-100 bg-navy-50/60 p-6">
                    <p class="text-xs font-bold uppercase tracking-wider text-[var(--color-primary)]">Our Mission</p>
                    <p class="mt-2 text-navy-700">{{ $settings->mission_text }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Highlights (alternating image + text) --}}
    @if ($highlights->isNotEmpty())
        <section class="py-20 sm:py-24">
            <div class="container-boza space-y-16 sm:space-y-24">
                @foreach ($highlights as $highlight)
                    <div class="reveal grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16" style="transition-delay: {{ $loop->index * 100 }}ms">
                        <div class="{{ $loop->even ? 'lg:order-2' : '' }}">
                            @if ($highlight->image_path)
                                <img
                                    src="{{ asset('storage/'.$highlight->image_path) }}"
                                    alt="{{ $highlight->title }}"
                                    class="aspect-[4/3] w-full rounded-2xl object-cover shadow-soft"
                                >
                            @else
                                <div class="flex aspect-[4/3] w-full items-center justify-center rounded-2xl shadow-soft" style="background-color: var(--color-secondary)">
                                    <span class="flex h-20 w-20 items-center justify-center rounded-full bg-white/10 text-[var(--color-accent)]">
                                        <x-icon :name="$highlight->icon ?: 'shield-check'" class="h-10 w-10" />
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="{{ $loop->even ? 'lg:order-1' : '' }}">
                            <h3 class="font-display text-2xl font-semibold text-navy-900 sm:text-3xl">{{ $highlight->title }}</h3>
                            <p class="mt-4 text-base leading-relaxed text-navy-600">{{ $highlight->description }}</p>
                            @if ($highlight->button_text && $highlight->button_url)
                                <a href="{{ $highlight->button_url }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[var(--color-primary)] hover:opacity-75">
                                    {{ $highlight->button_text }} <x-icon name="arrow-right" class="h-4 w-4" />
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Services --}}
    @if ($settings->nav_services_visible ?? true)
        <section class="bg-navy-50/50 py-20 sm:py-28">
            <div class="container-boza">
                <div class="reveal mx-auto max-w-2xl text-center">
                    <p class="section-eyebrow">What We Do</p>
                    <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">One-stop marine &amp; HR solutions</h2>
                    <p class="mt-4 text-navy-600">Crewing, HR outsourcing, consultancy, and logistics — delivered under one roof, for offshore and land-based operations alike.</p>
                </div>

                <div class="mt-14 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($services as $service)
                        <a href="{{ route('services.show', $service) }}" class="reveal group flex flex-col overflow-hidden rounded-xl border border-navy-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-soft" style="transition-delay: {{ $loop->index * 90 }}ms">
                            @if ($service->image_path)
                                <div class="relative h-40 overflow-hidden">
                                    <img src="{{ asset('storage/'.$service->image_path) }}" alt="{{ $service->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                    <span class="absolute bottom-3 left-3 flex h-10 w-10 items-center justify-center rounded-full bg-white text-[var(--color-primary)] shadow-soft">
                                        <x-icon :name="$service->icon" class="h-5 w-5" />
                                    </span>
                                </div>
                            @endif
                            <div class="flex flex-1 flex-col p-7">
                                @unless ($service->image_path)
                                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)] group-hover:bg-[var(--color-primary)] group-hover:text-white">
                                        <x-icon :name="$service->icon" class="h-6 w-6" />
                                    </span>
                                @endunless
                                <h3 class="{{ $service->image_path ? '' : 'mt-5' }} text-lg font-semibold text-navy-900">{{ $service->title }}</h3>
                                <p class="mt-2 flex-1 text-sm leading-relaxed text-navy-600">{{ $service->summary }}</p>
                                <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)]">
                                    Learn more <x-icon name="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1" />
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Differentiators --}}
    <section class="bg-brand-dark py-20 text-white sm:py-28">
        <div class="container-boza">
            <div class="mx-auto max-w-2xl text-center">
                <p class="section-eyebrow text-brand-accent">Our Differentiators</p>
                <h2 class="font-display mt-3 text-3xl font-semibold sm:text-4xl">Why clients choose Boza</h2>
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

    {{-- Process --}}
    <section class="py-20 sm:py-28">
        <div class="container-boza">
            <div class="mx-auto max-w-2xl text-center">
                <p class="section-eyebrow">How We Work</p>
                <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">Our process</h2>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ([
                    ['Consultation', 'Understand your vessel, contract, or manpower needs.'],
                    ['Sourcing', 'Shortlist from our database of certified seafarers and shore staff.'],
                    ['Execution', 'Recruitment, deployment, or service delivery.'],
                    ['Management', 'On-going HR, payroll, welfare, and performance tracking.'],
                    ['Review', 'Quarterly performance and compliance review.'],
                ] as $index => [$title, $description])
                    <div class="reveal relative rounded-xl border border-navy-100 p-6" style="transition-delay: {{ $index * 90 }}ms">
                        <span class="font-display text-3xl font-semibold text-[color-mix(in_srgb,var(--color-primary)_18%,white)]">0{{ $index + 1 }}</span>
                        <h3 class="mt-2 text-base font-semibold text-navy-900">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-navy-600">{{ $description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    @if ($testimonials->count())
        <section class="bg-navy-50/50 py-20 sm:py-28">
            <div class="container-boza">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="section-eyebrow">Client Voices</p>
                    <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">What our clients say</h2>
                </div>

                <div class="mt-14 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    @foreach ($testimonials as $testimonial)
                        <div class="reveal rounded-xl border border-navy-100 bg-white p-8 shadow-sm" style="transition-delay: {{ $loop->index * 100 }}ms">
                            <div class="flex gap-1 text-[var(--color-accent)]">
                                @for ($i = 0; $i < 5; $i++)
                                    <x-icon name="star" class="h-4 w-4" fill="currentColor" />
                                @endfor
                            </div>
                            <p class="mt-4 text-navy-700">&ldquo;{{ $testimonial->quote }}&rdquo;</p>
                            <div class="mt-5 flex items-center gap-3">
                                @if ($testimonial->photo_path)
                                    <img src="{{ asset('storage/'.$testimonial->photo_path) }}" alt="{{ $testimonial->name }}" class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-primary-soft text-sm font-semibold text-[var(--color-primary)]">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </span>
                                @endif
                                <div>
                                    <p class="text-sm font-semibold text-navy-900">{{ $testimonial->name }}</p>
                                    <p class="text-xs uppercase tracking-wider text-navy-400">{{ $testimonial->role }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Careers teaser --}}
    @if ($jobs->count() && ($settings->nav_careers_visible ?? true))
        <section class="py-20 sm:py-28">
            <div class="container-boza">
                <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <p class="section-eyebrow">Careers</p>
                        <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">Current openings</h2>
                    </div>
                    <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)] hover:text-[var(--color-primary)]">
                        View all openings <x-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    @foreach ($jobs as $job)
                        <a href="{{ route('careers.show', $job) }}" class="reveal rounded-xl border border-navy-100 p-6 transition hover:border-[var(--color-primary)] hover:shadow-soft" style="transition-delay: {{ $loop->index * 100 }}ms">
                            <span class="inline-block rounded-full bg-brand-primary-soft px-3 py-1 text-xs font-bold uppercase tracking-wider text-[var(--color-primary)]">{{ $job->sector }}</span>
                            <h3 class="mt-4 text-base font-semibold text-navy-900">{{ $job->title }}</h3>
                            <p class="mt-2 flex items-center gap-1.5 text-sm text-navy-500">
                                <x-icon name="map-pin" class="h-4 w-4" /> {{ $job->location }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- News teaser --}}
    @if ($newsPosts->count() && ($settings->nav_news_visible ?? true))
        <section class="bg-navy-50/50 py-20 sm:py-28">
            <div class="container-boza">
                <div class="reveal flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <p class="section-eyebrow">News</p>
                        <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">Latest News from Boza</h2>
                    </div>
                    <a href="{{ route('news.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)] hover:text-[var(--color-primary)]">
                        View all news <x-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-3">
                    @foreach ($newsPosts as $post)
                        <a href="{{ route('news.show', $post) }}" class="reveal group flex flex-col overflow-hidden rounded-xl border border-navy-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-soft" style="transition-delay: {{ $loop->index * 90 }}ms">
                            <div class="relative h-40 overflow-hidden bg-navy-100">
                                @if ($post->image_path)
                                    <img src="{{ asset('storage/'.$post->image_path) }}" alt="{{ $post->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <x-icon name="document-text" class="h-8 w-8 text-navy-300" />
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <p class="text-xs font-semibold uppercase tracking-wider text-navy-400">{{ optional($post->published_at)->format('d M Y') }}</p>
                                <h3 class="mt-2 text-base font-semibold text-navy-900">{{ $post->title }}</h3>
                                <p class="mt-2 flex-1 text-sm leading-relaxed text-navy-600 line-clamp-2">{{ $post->excerpt }}</p>
                                <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)]">
                                    Read more <x-icon name="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1" />
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Showcase carousel (text + rotating images) --}}
    @if ($showcaseSlideData->isNotEmpty())
        <section class="bg-brand-dark py-20 text-white sm:py-24">
            <div class="container-boza grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16">
                <div class="reveal">
                    <p class="section-eyebrow text-brand-accent">Behind the Scenes</p>
                    <h2 class="font-display mt-3 text-3xl font-semibold sm:text-4xl">{{ $settings->showcase_title ?: 'Life at Boza' }}</h2>
                    <p class="mt-4 max-w-md text-white/70">
                        {{ $settings->showcase_text ?: 'A glimpse of our crew, operations, and the people delivering certified, compliant service across West Africa.' }}
                    </p>
                    @if ($settings->nav_gallery_visible ?? true)
                        <a href="{{ route('gallery') }}" class="btn-outline mt-7 inline-flex">
                            View Full Gallery <x-icon name="arrow-right" class="h-4 w-4" />
                        </a>
                    @endif
                </div>

                <div class="reveal" style="transition-delay: 120ms" x-data="heroCarousel(@js($showcaseSlideData), 4000)">
                    <div class="relative aspect-[4/3] overflow-hidden rounded-2xl shadow-soft">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div
                                x-show="current === index"
                                x-transition:enter="transition ease-out duration-700"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-500"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute inset-0 bg-cover bg-center"
                                :style="`background-image: url(${slide.image})`"
                            ></div>
                        </template>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/0 to-black/0"></div>
                        <template x-if="active.caption">
                            <p class="absolute inset-x-0 bottom-0 p-4 text-sm font-medium text-white" x-text="active.caption"></p>
                        </template>
                    </div>

                    <div class="mt-5 flex items-center justify-center gap-2" x-show="slides.length > 1">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="goTo(index)" :class="current === index ? 'w-8 bg-[var(--color-accent)]' : 'w-2 bg-white/30'" class="h-2 rounded-full transition-all" :aria-label="'Go to image ' + (index + 1)"></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Gallery preview --}}
    @if ($galleryPreview->count() && ($settings->nav_gallery_visible ?? true))
        <section class="py-20 sm:py-28">
            <div class="container-boza">
                <div class="reveal flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <p class="section-eyebrow">Gallery</p>
                        <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">Boza in action</h2>
                    </div>
                    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)] hover:text-[var(--color-primary)]">
                        View full gallery <x-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>

                <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
                    @foreach ($galleryPreview as $image)
                        <a href="{{ route('gallery') }}" class="reveal group aspect-square overflow-hidden rounded-xl bg-navy-50" style="transition-delay: {{ $loop->index * 70 }}ms">
                            <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $image->caption }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    <section class="bg-brand-cta">
        <div class="reveal container-boza flex flex-col items-center gap-6 py-16 text-center text-white">
            <h2 class="font-display text-3xl font-semibold sm:text-4xl">Ready to crew your next vessel or project?</h2>
            <p class="max-w-2xl text-white/85">Talk to our team about crewing, HR outsourcing, consultancy, or logistics support — pre-qualified talent can mobilize within 48 hours.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact') }}" class="btn-gold">Get a Quote</a>
                <a href="{{ route('careers.apply') }}" class="btn-outline">Submit Your CV</a>
            </div>
        </div>
    </section>

</x-layouts.public>
