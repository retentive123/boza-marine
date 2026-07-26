<x-layouts.public :settings="$settings" title="Leadership" metaDescription="Meet the Board of Directors and Management team behind Boza Marine Solutions and Crewing Services.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_leadership])
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">Leadership</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Directors &amp; Management</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                The people steering Boza Marine Solutions' commitment to compliance, safety, and service.
            </p>
        </div>
    </section>

    @if ($directors->isEmpty() && $management->isEmpty())
        <section class="py-20 sm:py-24">
            <div class="container-boza">
                <div class="rounded-xl border border-dashed border-navy-200 p-16 text-center text-navy-400">
                    Leadership profiles are being updated — check back soon.
                </div>
            </div>
        </section>
    @endif

    {{-- Board of Directors --}}
    @if ($directors->isNotEmpty())
        <section class="py-20 sm:py-24">
            <div class="container-boza">
                <div class="reveal mx-auto max-w-2xl text-center">
                    <p class="section-eyebrow">Board of Directors</p>
                    <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">Our Directors</h2>
                </div>

                <div class="mt-14 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($directors as $member)
                        <div class="reveal group text-center" style="transition-delay: {{ $loop->index * 90 }}ms">
                            <div class="relative mx-auto h-40 w-40 overflow-hidden rounded-full border-4 border-white shadow-soft ring-1 ring-navy-100">
                                @if ($member->photo_path)
                                    <img src="{{ asset('storage/'.$member->photo_path) }}" alt="{{ $member->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-brand-primary-soft text-3xl font-semibold text-[var(--color-primary)]">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="mt-5 text-lg font-semibold text-navy-900">{{ $member->name }}</h3>
                            <p class="text-sm font-medium text-[var(--color-primary)]">{{ $member->role }}</p>
                            @if ($member->bio)
                                <p class="mx-auto mt-3 max-w-xs text-sm leading-relaxed text-navy-600">{{ $member->bio }}</p>
                            @endif
                            @if ($member->linkedin_url)
                                <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-navy-400 transition hover:text-[var(--color-primary)]">
                                    <x-icon name="external-link" class="h-3.5 w-3.5" /> LinkedIn
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Management Team --}}
    @if ($management->isNotEmpty())
        <section class="bg-navy-50/50 py-20 sm:py-24">
            <div class="container-boza">
                <div class="reveal mx-auto max-w-2xl text-center">
                    <p class="section-eyebrow">Management</p>
                    <h2 class="font-display mt-3 text-3xl font-semibold text-navy-900 sm:text-4xl">Our Management Team</h2>
                </div>

                <div class="mt-14 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($management as $member)
                        <div class="reveal group text-center" style="transition-delay: {{ $loop->index * 90 }}ms">
                            <div class="relative mx-auto h-32 w-32 overflow-hidden rounded-full border-4 border-white shadow-soft ring-1 ring-navy-100">
                                @if ($member->photo_path)
                                    <img src="{{ asset('storage/'.$member->photo_path) }}" alt="{{ $member->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-brand-primary-soft text-2xl font-semibold text-[var(--color-primary)]">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="mt-5 text-base font-semibold text-navy-900">{{ $member->name }}</h3>
                            <p class="text-sm font-medium text-[var(--color-primary)]">{{ $member->role }}</p>
                            @if ($member->bio)
                                <p class="mx-auto mt-3 max-w-xs text-sm leading-relaxed text-navy-600 line-clamp-3">{{ $member->bio }}</p>
                            @endif
                            @if ($member->linkedin_url)
                                <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-navy-400 transition hover:text-[var(--color-primary)]">
                                    <x-icon name="external-link" class="h-3.5 w-3.5" /> LinkedIn
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    <section class="bg-brand-cta">
        <div class="container-boza flex flex-col items-center gap-6 py-16 text-center text-white">
            <h2 class="font-display text-3xl font-semibold sm:text-4xl">Want to work with our team?</h2>
            <a href="{{ route('contact') }}" class="btn-gold">Contact Us</a>
        </div>
    </section>

</x-layouts.public>
