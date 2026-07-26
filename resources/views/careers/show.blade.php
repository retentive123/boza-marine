<x-layouts.public :settings="$settings" :title="$job->title" :metaDescription="str($job->description)->limit(150)">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_careers])
        <div class="container-boza relative z-10">
            <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-white/60 hover:text-white">
                <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> All Openings
            </a>
            <span class="mt-6 inline-block w-fit rounded-full bg-[var(--color-accent)]/15 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[var(--color-accent)]">{{ $job->sector }}</span>
            <h1 class="font-display mt-3 text-3xl font-semibold sm:text-4xl">{{ $job->title }}</h1>
            <div class="mt-5 flex flex-wrap gap-x-6 gap-y-2 text-sm text-white/70">
                @if ($job->location)
                    <span class="flex items-center gap-1.5"><x-icon name="map-pin" class="h-4 w-4" /> {{ $job->location }}</span>
                @endif
                @if ($job->employment_type)
                    <span class="flex items-center gap-1.5"><x-icon name="briefcase" class="h-4 w-4" /> {{ $job->employment_type }}</span>
                @endif
                @if ($job->vessel_type)
                    <span class="flex items-center gap-1.5"><x-icon name="ship" class="h-4 w-4" /> {{ $job->vessel_type }}</span>
                @endif
                @if ($job->closing_date)
                    <span class="flex items-center gap-1.5"><x-icon name="clock" class="h-4 w-4" /> Closes {{ $job->closing_date->format('d M Y') }}</span>
                @endif
            </div>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza grid grid-cols-1 gap-14 lg:grid-cols-3">
            <div class="space-y-10 lg:col-span-2">
                <div>
                    <h2 class="text-lg font-semibold text-navy-900">Role Overview</h2>
                    <p class="mt-4 whitespace-pre-line leading-relaxed text-navy-700">{{ $job->description }}</p>
                </div>

                @if ($job->requirements)
                    <div>
                        <h2 class="text-lg font-semibold text-navy-900">Requirements</h2>
                        <ul class="mt-4 space-y-3">
                            @foreach (preg_split('/\r?\n/', trim($job->requirements)) as $line)
                                @if (trim($line) !== '')
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                                            <x-icon name="check" class="h-4 w-4" />
                                        </span>
                                        <span class="text-navy-700">{{ $line }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div>
                <div class="rounded-xl border border-navy-100 bg-navy-50/60 p-7">
                    <h3 class="text-base font-semibold text-navy-900">Apply for this role</h3>
                    <p class="mt-2 text-sm text-navy-600">Submit your CV and certifications — our recruitment team will review and reach out.</p>
                    <a href="{{ route('careers.apply', ['job' => $job->slug]) }}" class="btn-primary mt-5 w-full">Apply Now</a>
                </div>
            </div>
        </div>
    </section>

</x-layouts.public>
