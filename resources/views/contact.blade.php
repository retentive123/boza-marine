<x-layouts.public :settings="$settings" title="Contact Us" metaDescription="Get in touch with Boza Marine Solutions for crewing, HR outsourcing, consultancy, or logistics support.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_contact])
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">Contact Us</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Let's Talk</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                Whether it's crewing an offshore project or outsourcing your HR function, our team responds within one business day.
            </p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza grid grid-cols-1 gap-14 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <h2 class="text-lg font-semibold text-navy-900">Contact Information</h2>
                <div class="mt-6 space-y-5">
                    <div class="flex items-start gap-3.5">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                            <x-icon name="map-pin" class="h-5 w-5" />
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-navy-900">Head Office</p>
                            <p class="text-sm text-navy-600">{{ $settings->address }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3.5">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                            <x-icon name="phone" class="h-5 w-5" />
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-navy-900">Phone</p>
                            <p class="text-sm text-navy-600">{{ $settings->phone_primary }}</p>
                            @if ($settings->phone_secondary)
                                <p class="text-sm text-navy-600">{{ $settings->phone_secondary }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-start gap-3.5">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                            <x-icon name="mail" class="h-5 w-5" />
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-navy-900">Email</p>
                            <p class="text-sm text-navy-600">{{ $settings->email_primary }}</p>
                            @if ($settings->email_secondary)
                                <p class="text-sm text-navy-600">{{ $settings->email_secondary }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-10 overflow-hidden rounded-xl border border-navy-100">
                    <iframe
                        title="Boza Marine Solutions location"
                        src="https://www.google.com/maps?q={{ urlencode($settings->address ?? 'Takoradi, Ghana') }}&output=embed"
                        class="h-64 w-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="lg:col-span-3">
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-6 rounded-2xl border border-navy-100 p-8 shadow-sm sm:p-10">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <x-input-label for="name" value="Full Name" />
                            <x-text-input id="name" name="name" type="text" class="mt-1.5" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="email" value="Email Address" />
                            <x-text-input id="email" name="email" type="email" class="mt-1.5" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <x-input-label for="phone" value="Phone Number (optional)" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1.5" :value="old('phone')" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="subject" value="Subject" />
                            <x-text-input id="subject" name="subject" type="text" class="mt-1.5" :value="old('subject')" placeholder="e.g. Crew Request, HR Outsourcing Quote" />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="message" value="Message" />
                        <textarea id="message" name="message" rows="6" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" required>{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <button type="submit" class="btn-primary w-full">Send Message</button>
                </form>
            </div>
        </div>
    </section>

</x-layouts.public>
