<x-layouts.admin title="Site Settings">

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="max-w-4xl space-y-8">
        @csrf
        @method('PUT')

        <div class="rounded-xl border border-navy-100 bg-white p-8" x-data="{
            logoPreview: null, faviconPreview: null, aboutPreview: null,
        }">
            <h2 class="text-base font-semibold text-navy-900">Branding &amp; Media</h2>
            <p class="mt-1 text-sm text-navy-500">Logo, favicon, brand colors, and fonts used across the site.</p>

            <div class="mt-6 grid grid-cols-1 gap-8 sm:grid-cols-3">
                <div>
                    <x-input-label value="Logo" />
                    <div class="mt-1.5 flex h-24 w-24 items-center justify-center overflow-hidden rounded-xl border border-navy-100 bg-navy-50">
                        <template x-if="logoPreview">
                            <img :src="logoPreview" class="h-full w-full object-cover">
                        </template>
                        <template x-if="!logoPreview">
                            @if ($settings->logo_path)
                                <img src="{{ asset('storage/'.$settings->logo_path) }}" class="h-full w-full object-cover">
                            @else
                                <x-icon name="image" class="h-8 w-8 text-navy-300" />
                            @endif
                        </template>
                    </div>
                    <label class="mt-2 inline-block cursor-pointer text-xs font-semibold" style="color: var(--color-primary)">
                        Choose file
                        <input type="file" name="logo" accept="image/*" class="sr-only" @change="logoPreview = URL.createObjectURL($event.target.files[0])">
                    </label>
                    @if ($settings->logo_path)
                        <label class="mt-1 flex items-center gap-1.5 text-xs text-navy-500">
                            <input type="checkbox" name="remove_logo" value="1" class="rounded border-navy-300"> Remove logo
                        </label>
                    @endif
                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="Favicon" />
                    <div class="mt-1.5 flex h-24 w-24 items-center justify-center overflow-hidden rounded-xl border border-navy-100 bg-navy-50">
                        <template x-if="faviconPreview">
                            <img :src="faviconPreview" class="h-full w-full object-cover">
                        </template>
                        <template x-if="!faviconPreview">
                            @if ($settings->favicon_path)
                                <img src="{{ asset('storage/'.$settings->favicon_path) }}" class="h-full w-full object-cover">
                            @else
                                <x-icon name="image" class="h-8 w-8 text-navy-300" />
                            @endif
                        </template>
                    </div>
                    <label class="mt-2 inline-block cursor-pointer text-xs font-semibold" style="color: var(--color-primary)">
                        Choose file
                        <input type="file" name="favicon" accept="image/*" class="sr-only" @change="faviconPreview = URL.createObjectURL($event.target.files[0])">
                    </label>
                    @if ($settings->favicon_path)
                        <label class="mt-1 flex items-center gap-1.5 text-xs text-navy-500">
                            <input type="checkbox" name="remove_favicon" value="1" class="rounded border-navy-300"> Remove favicon
                        </label>
                    @endif
                    <x-input-error :messages="$errors->get('favicon')" class="mt-2" />
                </div>

                <div>
                    <x-input-label value="About Page Image" />
                    <div class="mt-1.5 flex h-24 w-24 items-center justify-center overflow-hidden rounded-xl border border-navy-100 bg-navy-50">
                        <template x-if="aboutPreview">
                            <img :src="aboutPreview" class="h-full w-full object-cover">
                        </template>
                        <template x-if="!aboutPreview">
                            @if ($settings->about_image)
                                <img src="{{ asset('storage/'.$settings->about_image) }}" class="h-full w-full object-cover">
                            @else
                                <x-icon name="image" class="h-8 w-8 text-navy-300" />
                            @endif
                        </template>
                    </div>
                    <label class="mt-2 inline-block cursor-pointer text-xs font-semibold" style="color: var(--color-primary)">
                        Choose file
                        <input type="file" name="about_image_upload" accept="image/*" class="sr-only" @change="aboutPreview = URL.createObjectURL($event.target.files[0])">
                    </label>
                    @if ($settings->about_image)
                        <label class="mt-1 flex items-center gap-1.5 text-xs text-navy-500">
                            <input type="checkbox" name="remove_about_image" value="1" class="rounded border-navy-300"> Remove image
                        </label>
                    @endif
                    <x-input-error :messages="$errors->get('about_image_upload')" class="mt-2" />
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-3">
                <div>
                    <x-input-label for="color_primary" value="Primary Color" />
                    <div class="mt-1.5 flex items-center gap-2">
                        <input type="color" id="color_primary" class="h-10 w-12 rounded border border-navy-200" value="{{ old('color_primary', $settings->color_primary) }}" oninput="document.getElementById('color_primary_hex').value = this.value">
                        <input type="text" id="color_primary_hex" name="color_primary" class="w-full rounded-md border-navy-200 text-sm shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" value="{{ old('color_primary', $settings->color_primary) }}" oninput="document.getElementById('color_primary').value = this.value">
                    </div>
                    <x-input-error :messages="$errors->get('color_primary')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="color_secondary" value="Secondary Color" />
                    <div class="mt-1.5 flex items-center gap-2">
                        <input type="color" id="color_secondary" class="h-10 w-12 rounded border border-navy-200" value="{{ old('color_secondary', $settings->color_secondary) }}" oninput="document.getElementById('color_secondary_hex').value = this.value">
                        <input type="text" id="color_secondary_hex" name="color_secondary" class="w-full rounded-md border-navy-200 text-sm shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" value="{{ old('color_secondary', $settings->color_secondary) }}" oninput="document.getElementById('color_secondary').value = this.value">
                    </div>
                    <x-input-error :messages="$errors->get('color_secondary')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="color_accent" value="Accent Color" />
                    <div class="mt-1.5 flex items-center gap-2">
                        <input type="color" id="color_accent" class="h-10 w-12 rounded border border-navy-200" value="{{ old('color_accent', $settings->color_accent) }}" oninput="document.getElementById('color_accent_hex').value = this.value">
                        <input type="text" id="color_accent_hex" name="color_accent" class="w-full rounded-md border-navy-200 text-sm shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" value="{{ old('color_accent', $settings->color_accent) }}" oninput="document.getElementById('color_accent').value = this.value">
                    </div>
                    <x-input-error :messages="$errors->get('color_accent')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <x-input-label for="font_heading" value="Heading Font" />
                    <select id="font_heading" name="font_heading" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                        @foreach ($headingFonts as $font)
                            <option value="{{ $font }}" @selected(old('font_heading', $settings->font_heading) === $font)>{{ $font }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('font_heading')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="font_body" value="Body Font" />
                    <select id="font_body" name="font_body" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                        @foreach ($bodyFonts as $font)
                            <option value="{{ $font }}" @selected(old('font_body', $settings->font_body) === $font)>{{ $font }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('font_body')" class="mt-2" />
                </div>
            </div>
            <p class="mt-3 text-xs text-navy-400">Color and font changes apply across the entire public site and this admin panel after saving.</p>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-8" x-data="{
            previews: { about: null, services: null, gallery: null, careers: null, news: null, leadership: null, contact: null },
        }">
            <h2 class="text-base font-semibold text-navy-900">Page Header Images</h2>
            <p class="mt-1 text-sm text-navy-500">Each page below can have its own image, shown faded on the right of that page's header banner. Leave blank to keep the plain brand-color header.</p>

            <div class="mt-6 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    'about' => 'About Us',
                    'services' => 'Services',
                    'gallery' => 'Gallery',
                    'careers' => 'Careers (listing, detail & apply)',
                    'news' => 'News',
                    'leadership' => 'Leadership',
                    'contact' => 'Contact Us',
                ] as $key => $label)
                    @php $field = "header_image_{$key}"; @endphp
                    <div>
                        <x-input-label :value="$label" />
                        <div class="mt-1.5 flex h-24 w-full items-center justify-center overflow-hidden rounded-xl border border-navy-100 bg-navy-50">
                            <template x-if="previews.{{ $key }}">
                                <img :src="previews.{{ $key }}" class="h-full w-full object-cover">
                            </template>
                            <template x-if="!previews.{{ $key }}">
                                @if ($settings->$field)
                                    <img src="{{ asset('storage/'.$settings->$field) }}" class="h-full w-full object-cover">
                                @else
                                    <x-icon name="image" class="h-8 w-8 text-navy-300" />
                                @endif
                            </template>
                        </div>
                        <label class="mt-2 inline-block cursor-pointer text-xs font-semibold" style="color: var(--color-primary)">
                            Choose file
                            <input type="file" name="{{ $field }}_upload" accept="image/*" class="sr-only" @change="previews.{{ $key }} = URL.createObjectURL($event.target.files[0])">
                        </label>
                        @if ($settings->$field)
                            <label class="mt-1 flex items-center gap-1.5 text-xs text-navy-500">
                                <input type="checkbox" name="remove_{{ $field }}" value="1" class="rounded border-navy-300"> Remove image
                            </label>
                        @endif
                        <x-input-error :messages="$errors->get($field.'_upload')" class="mt-2" />
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-8">
            <h2 class="text-base font-semibold text-navy-900">Homepage Showcase Text</h2>
            <p class="mt-1 text-sm text-navy-500">The heading and blurb shown beside the rotating Showcase Carousel photos (managed in Admin → Showcase Carousel).</p>
            <div class="mt-6 space-y-6">
                <div>
                    <x-input-label for="showcase_title" value="Showcase Heading" />
                    <x-text-input id="showcase_title" name="showcase_title" type="text" class="mt-1.5" :value="old('showcase_title', $settings->showcase_title)" placeholder="e.g. Life at Boza" />
                    <x-input-error :messages="$errors->get('showcase_title')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="showcase_text" value="Showcase Text" />
                    <textarea id="showcase_text" name="showcase_text" rows="3" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" placeholder="A short blurb about your crew, operations, or culture.">{{ old('showcase_text', $settings->showcase_text) }}</textarea>
                    <x-input-error :messages="$errors->get('showcase_text')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-8">
            <h2 class="text-base font-semibold text-navy-900">Company Details</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <x-input-label for="company_name" value="Company Name" />
                    <x-text-input id="company_name" name="company_name" type="text" class="mt-1.5" :value="old('company_name', $settings->company_name)" required />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="tagline" value="Tagline" />
                    <x-text-input id="tagline" name="tagline" type="text" class="mt-1.5" :value="old('tagline', $settings->tagline)" />
                    <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-8">
            <h2 class="text-base font-semibold text-navy-900">Navigation Menu</h2>
            <p class="mt-1 text-sm text-navy-500">Uncheck an item to hide it from the header menu and footer quick links. The page itself stays reachable by direct link.</p>
            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach ([
                    'nav_about_visible' => 'About Us',
                    'nav_leadership_visible' => 'Leadership',
                    'nav_services_visible' => 'Services',
                    'nav_gallery_visible' => 'Gallery',
                    'nav_news_visible' => 'News',
                    'nav_careers_visible' => 'Careers',
                    'nav_contact_visible' => 'Contact',
                ] as $field => $label)
                    <label class="flex items-center gap-2.5 text-sm font-medium text-navy-700">
                        <input type="hidden" name="{{ $field }}" value="0">
                        <input
                            type="checkbox"
                            name="{{ $field }}"
                            value="1"
                            class="rounded border-navy-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]"
                            @checked(old($field, $settings->$field))
                        >
                        {{ $label }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-8" x-data="{ heroBgPreview: null }">
            <h2 class="text-base font-semibold text-navy-900">Homepage Hero</h2>
            <p class="mt-1 text-sm text-navy-500">Only used when no photo Hero Slides are active (Admin → Hero Slides) — otherwise the carousel takes over.</p>
            <div class="mt-6 space-y-6">
                <div>
                    <x-input-label value="Hero Background Photo (fallback)" />
                    <p class="mt-1 text-[11px] text-navy-400">Used only if no photos are added under Admin → Homepage → Default Hero Photos, where you can add multiple photos to rotate. Leave empty to use a plain color background instead.</p>
                    <div class="mt-2 flex h-32 w-full max-w-md items-center justify-center overflow-hidden rounded-xl border border-navy-100 bg-navy-50">
                        <template x-if="heroBgPreview">
                            <img :src="heroBgPreview" class="h-full w-full object-cover">
                        </template>
                        <template x-if="!heroBgPreview">
                            @if ($settings->hero_background_image)
                                <img src="{{ asset('storage/'.$settings->hero_background_image) }}" class="h-full w-full object-cover">
                            @else
                                <x-icon name="image" class="h-8 w-8 text-navy-300" />
                            @endif
                        </template>
                    </div>
                    <label class="mt-2 inline-block cursor-pointer text-xs font-semibold" style="color: var(--color-primary)">
                        Choose file
                        <input type="file" name="hero_background_image_upload" accept="image/*" class="sr-only" @change="heroBgPreview = URL.createObjectURL($event.target.files[0])">
                    </label>
                    @if ($settings->hero_background_image)
                        <label class="mt-1 flex items-center gap-1.5 text-xs text-navy-500">
                            <input type="checkbox" name="remove_hero_background_image" value="1" class="rounded border-navy-300"> Remove image
                        </label>
                    @endif
                    <x-input-error :messages="$errors->get('hero_background_image_upload')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="hero_title" value="Static Hero Title" />
                    <x-text-input id="hero_title" name="hero_title" type="text" class="mt-1.5" :value="old('hero_title', $settings->hero_title)" />
                    <p class="mt-1 text-[11px] text-navy-400">Used as-is unless an animated headline is set up below.</p>
                    <x-input-error :messages="$errors->get('hero_title')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="hero_subtitle" value="Hero Subtitle" />
                    <textarea id="hero_subtitle" name="hero_subtitle" rows="3" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('hero_subtitle', $settings->hero_subtitle) }}</textarea>
                    <x-input-error :messages="$errors->get('hero_subtitle')" class="mt-2" />
                </div>
            </div>

            <div class="mt-8 border-t border-navy-100 pt-6">
                <h3 class="text-sm font-semibold text-navy-900">Animated Headline (optional)</h3>
                <p class="mt-1 text-sm text-navy-500">Like WordPress "animated text" widgets — one word or phrase rotates in place. Fill in Rotating Phrases to enable it; this replaces the Static Hero Title above.</p>

                <div class="mt-5 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="hero_headline_prefix" value="Prefix Text" />
                        <x-text-input id="hero_headline_prefix" name="hero_headline_prefix" type="text" class="mt-1.5" :value="old('hero_headline_prefix', $settings->hero_headline_prefix)" placeholder="e.g. We Deliver" />
                        <x-input-error :messages="$errors->get('hero_headline_prefix')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="hero_headline_suffix" value="Suffix Text (optional)" />
                        <x-text-input id="hero_headline_suffix" name="hero_headline_suffix" type="text" class="mt-1.5" :value="old('hero_headline_suffix', $settings->hero_headline_suffix)" placeholder="e.g. For Every Client" />
                        <x-input-error :messages="$errors->get('hero_headline_suffix')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6">
                    <x-input-label for="hero_headline_words" value="Rotating Phrases (one per line)" />
                    <textarea id="hero_headline_words" name="hero_headline_words" rows="4" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" placeholder="Certified Crew&#10;Compliant HR&#10;Reliable Logistics">{{ old('hero_headline_words', $settings->hero_headline_words) }}</textarea>
                    <p class="mt-1 text-[11px] text-navy-400">Leave blank to disable the animation and use the Static Hero Title instead.</p>
                    <x-input-error :messages="$errors->get('hero_headline_words')" class="mt-2" />
                </div>

                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="hero_headline_animation_type" value="Animation Type" />
                        <select id="hero_headline_animation_type" name="hero_headline_animation_type" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                            @foreach ($animationTypes as $value => $label)
                                <option value="{{ $value }}" @selected(old('hero_headline_animation_type', $settings->hero_headline_animation_type) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-[11px] text-navy-400">How the phrases change — words swapping, or a typewriter effect.</p>
                        <x-input-error :messages="$errors->get('hero_headline_animation_type')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="hero_headline_animation_style" value="Animation Style" />
                        <select id="hero_headline_animation_style" name="hero_headline_animation_style" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                            @foreach ($animationStyles as $value => $label)
                                <option value="{{ $value }}" @selected(old('hero_headline_animation_style', $settings->hero_headline_animation_style) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-[11px] text-navy-400">The transition effect used — only applies when Animation Type is "Rotate".</p>
                        <x-input-error :messages="$errors->get('hero_headline_animation_style')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-8">
            <h2 class="text-base font-semibold text-navy-900">About, Goal, Vision &amp; Mission</h2>
            <div class="mt-6 space-y-6">
                <div>
                    <x-input-label for="about_text" value="About Text" />
                    <textarea id="about_text" name="about_text" rows="4" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('about_text', $settings->about_text) }}</textarea>
                    <x-input-error :messages="$errors->get('about_text')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="goal_text" value="Our Goal" />
                    <textarea id="goal_text" name="goal_text" rows="2" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('goal_text', $settings->goal_text) }}</textarea>
                    <x-input-error :messages="$errors->get('goal_text')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="vision_text" value="Our Vision" />
                    <textarea id="vision_text" name="vision_text" rows="2" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('vision_text', $settings->vision_text) }}</textarea>
                    <x-input-error :messages="$errors->get('vision_text')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="mission_text" value="Our Mission" />
                    <textarea id="mission_text" name="mission_text" rows="2" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('mission_text', $settings->mission_text) }}</textarea>
                    <x-input-error :messages="$errors->get('mission_text')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-8">
            <h2 class="text-base font-semibold text-navy-900">Contact Information</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <x-input-label for="address" value="Address" />
                    <x-text-input id="address" name="address" type="text" class="mt-1.5" :value="old('address', $settings->address)" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="phone_primary" value="Primary Phone" />
                    <x-text-input id="phone_primary" name="phone_primary" type="text" class="mt-1.5" :value="old('phone_primary', $settings->phone_primary)" />
                    <x-input-error :messages="$errors->get('phone_primary')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="phone_secondary" value="Secondary Phone" />
                    <x-text-input id="phone_secondary" name="phone_secondary" type="text" class="mt-1.5" :value="old('phone_secondary', $settings->phone_secondary)" />
                    <x-input-error :messages="$errors->get('phone_secondary')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="email_primary" value="Primary Email" />
                    <x-text-input id="email_primary" name="email_primary" type="email" class="mt-1.5" :value="old('email_primary', $settings->email_primary)" />
                    <x-input-error :messages="$errors->get('email_primary')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="email_secondary" value="Secondary Email" />
                    <x-text-input id="email_secondary" name="email_secondary" type="email" class="mt-1.5" :value="old('email_secondary', $settings->email_secondary)" />
                    <x-input-error :messages="$errors->get('email_secondary')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-8">
            <h2 class="text-base font-semibold text-navy-900">Social Links (optional)</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-3">
                <div>
                    <x-input-label for="facebook_url" value="Facebook URL" />
                    <x-text-input id="facebook_url" name="facebook_url" type="url" class="mt-1.5" :value="old('facebook_url', $settings->facebook_url)" />
                    <x-input-error :messages="$errors->get('facebook_url')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="linkedin_url" value="LinkedIn URL" />
                    <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1.5" :value="old('linkedin_url', $settings->linkedin_url)" />
                    <x-input-error :messages="$errors->get('linkedin_url')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="whatsapp_url" value="WhatsApp URL" />
                    <x-text-input id="whatsapp_url" name="whatsapp_url" type="url" class="mt-1.5" :value="old('whatsapp_url', $settings->whatsapp_url)" />
                    <x-input-error :messages="$errors->get('whatsapp_url')" class="mt-2" />
                </div>
            </div>
        </div>

        <button type="submit" class="btn-primary">Save Settings</button>
    </form>

</x-layouts.admin>
