<x-layouts.public :settings="$settings" :title="$service->title" :metaDescription="$service->summary">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_services])
        <div class="container-boza relative z-10">
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-white/60 hover:text-white">
                <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> All Services
            </a>
            <div class="mt-6 flex items-center gap-5">
                <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-white/10 text-[var(--color-accent)]">
                    <x-icon :name="$service->icon" class="h-8 w-8" />
                </span>
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--color-accent)]">{{ $service->category }}</span>
                    <h1 class="font-display mt-1 text-3xl font-semibold sm:text-4xl">{{ $service->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza grid grid-cols-1 gap-14 lg:grid-cols-3">
            <div class="lg:col-span-2">
                @if ($service->image_path)
                    <div class="mb-10 overflow-hidden rounded-2xl shadow-soft">
                        <img src="{{ asset('storage/'.$service->image_path) }}" alt="{{ $service->title }}" class="h-72 w-full object-cover sm:h-96">
                    </div>
                @endif

                <p class="text-lg leading-relaxed text-navy-700">{{ $service->description }}</p>

                @if (!empty($service->deliverables))
                    <h2 class="mt-10 text-lg font-semibold text-navy-900">Key Deliverables</h2>
                    <ul class="mt-5 space-y-4">
                        @foreach ($service->deliverables as $deliverable)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                                    <x-icon name="check" class="h-4 w-4" />
                                </span>
                                <span class="text-navy-700">{{ $deliverable }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="space-y-6">
                <div class="rounded-xl border border-navy-100 bg-navy-50/60 p-7">
                    <h3 class="text-base font-semibold text-navy-900">Request this service</h3>
                    <p class="mt-2 text-sm text-navy-600">Tell us about your requirements and our team will respond within one business day.</p>
                    <a href="{{ route('contact') }}" class="btn-primary mt-5 w-full">Get a Quote</a>
                </div>

                @if ($otherServices->count())
                    <div class="rounded-xl border border-navy-100 p-7">
                        <h3 class="text-base font-semibold text-navy-900">Other Services</h3>
                        <ul class="mt-4 space-y-3">
                            @foreach ($otherServices as $other)
                                <li>
                                    <a href="{{ route('services.show', $other) }}" class="flex items-center gap-2.5 text-sm font-medium text-navy-700 hover:text-[var(--color-primary)]">
                                        <x-icon :name="$other->icon" class="h-4 w-4 text-[var(--color-primary)]" />
                                        {{ $other->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

</x-layouts.public>
