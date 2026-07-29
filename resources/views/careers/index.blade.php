<x-layouts.public :settings="$settings" title="Careers" metaDescription="Explore current offshore and land-based job openings with Boza Marine Solutions, or submit a speculative application.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_careers])
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">Careers</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Join Our Talent Pool</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                Certified seafarers and shore-based professionals — mobilize fast with a company built on compliance and welfare.
            </p>
            <a href="{{ route('careers.apply') }}" class="btn-gold mt-8 inline-flex">Submit a Speculative CV</a>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('careers.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ $sector === '' ? 'bg-[var(--color-primary)] text-white' : 'bg-navy-50 text-navy-600 hover:bg-navy-100' }}">All Openings</a>
                    <a href="{{ route('careers.index', ['sector' => 'Offshore']) }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ $sector === 'Offshore' ? 'bg-[var(--color-primary)] text-white' : 'bg-navy-50 text-navy-600 hover:bg-navy-100' }}">Offshore</a>
                    <a href="{{ route('careers.index', ['sector' => 'Land-Based']) }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ $sector === 'Land-Based' ? 'bg-[var(--color-primary)] text-white' : 'bg-navy-50 text-navy-600 hover:bg-navy-100' }}">Land-Based</a>
                </div>
                <a href="{{ auth('candidate')->check() ? route('candidate.applications.index') : route('candidate.login') }}" class="flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)] hover:opacity-80">
                    <x-icon name="users" class="h-4 w-4" />
                    {{ auth('candidate')->check() ? 'My Applications' : 'Track Your Application' }}
                </a>
            </div>

            @if ($jobs->isEmpty())
                <div class="mt-12 rounded-xl border border-dashed border-navy-200 p-12 text-center">
                    <p class="text-navy-600">No openings match this filter right now. Submit a speculative CV and we'll reach out when a role fits your profile.</p>
                    <a href="{{ route('careers.apply') }}" class="btn-primary mt-6 inline-flex">Submit Your CV</a>
                </div>
            @else
                <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($jobs as $job)
                        <a href="{{ route('careers.show', $job) }}" class="flex flex-col rounded-xl border border-navy-100 p-7 transition hover:border-[var(--color-primary)] hover:shadow-soft">
                            <span class="inline-block w-fit rounded-full bg-brand-primary-soft px-3 py-1 text-xs font-bold uppercase tracking-wider text-[var(--color-primary)]">{{ $job->sector }}</span>
                            <h3 class="mt-4 text-lg font-semibold text-navy-900">{{ $job->title }}</h3>
                            <div class="mt-3 space-y-1.5 text-sm text-navy-500">
                                @if ($job->location)
                                    <p class="flex items-center gap-1.5"><x-icon name="map-pin" class="h-4 w-4" /> {{ $job->location }}</p>
                                @endif
                                @if ($job->employment_type)
                                    <p class="flex items-center gap-1.5"><x-icon name="briefcase" class="h-4 w-4" /> {{ $job->employment_type }}</p>
                                @endif
                                @if ($job->closing_date)
                                    <p class="flex items-center gap-1.5"><x-icon name="clock" class="h-4 w-4" /> Closes {{ $job->closing_date->format('d M Y') }}</p>
                                @endif
                            </div>
                            <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)]">
                                View &amp; Apply <x-icon name="arrow-right" class="h-4 w-4" />
                            </span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

</x-layouts.public>
