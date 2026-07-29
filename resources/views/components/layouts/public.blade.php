@props(['settings' => null, 'title' => null, 'metaDescription' => null, 'canonical' => null])
@php
    $pageTitle = isset($title) ? $title.' — Boza Marine Solutions' : 'Boza Marine Solutions and Crewing Services';
    $pageDescription = $metaDescription ?? 'Boza Marine Solutions and Crewing Services — Ghanaian-owned maritime crewing, HR outsourcing, consultancy, and logistics for offshore and land-based operations.';
    $canonicalUrl = $canonical ?? url()->current();
    $ogImagePath = $settings->hero_background_image ?? $settings->logo_path ?? null;
    $ogImageUrl = $ogImagePath ? asset('storage/'.$ogImagePath) : null;
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <title>{{ $pageTitle }}</title>

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $settings->company_name ?? 'Boza Marine Solutions' }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    @if ($ogImageUrl)
        <meta property="og:image" content="{{ $ogImageUrl }}">
    @endif

    <meta name="twitter:card" content="{{ $ogImageUrl ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    @if ($ogImageUrl)
        <meta name="twitter:image" content="{{ $ogImageUrl }}">
    @endif

    @include('partials.brand-styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $settings->company_name ?? 'Boza Marine Solutions and Crewing Services',
            'url' => url('/'),
            'logo' => $settings->logo_path ? asset('storage/'.$settings->logo_path) : null,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $settings->address ?? 'Takoradi, Western Region, Ghana',
                'addressCountry' => 'GH',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $settings->phone_primary ?? null,
                'email' => $settings->email_primary ?? null,
                'contactType' => 'customer service',
            ],
            'sameAs' => array_values(array_filter([
                $settings->facebook_url ?? null,
                $settings->linkedin_url ?? null,
                $settings->tiktok_url ?? null,
                $settings->youtube_url ?? null,
            ])),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
</head>
<body class="flex min-h-screen flex-col bg-white font-sans text-navy-900">

    {{-- Top utility bar --}}
    <div class="hidden bg-brand-dark text-white/80 md:block">
        <div class="container-boza flex items-center justify-between py-2 text-xs">
            <div class="flex items-center gap-6">
                <a href="mailto:{{ $settings->email_primary ?? 'bozamarinesolutions@gmail.com' }}" class="flex items-center gap-1.5 hover:text-[var(--color-accent)]">
                    <x-icon name="mail" class="h-3.5 w-3.5" />
                    {{ $settings->email_primary ?? 'bozamarinesolutions@gmail.com' }}
                </a>
                <a href="tel:{{ preg_replace('/\s+/', '', $settings->phone_primary ?? '') }}" class="flex items-center gap-1.5 hover:text-[var(--color-accent)]">
                    <x-icon name="phone" class="h-3.5 w-3.5" />
                    {{ $settings->phone_primary ?? '+233 50 569 5555' }}
                </a>
            </div>
            <div class="flex items-center gap-1.5">
                <x-icon name="map-pin" class="h-3.5 w-3.5" />
                {{ $settings->address ?? 'Takoradi, Western Region, Ghana' }}
            </div>
        </div>
    </div>

    {{-- Main navigation --}}
    <header x-data="{ open: false, search: false }" class="sticky top-0 z-50 border-b border-navy-100 bg-white/95 backdrop-blur">
        <nav class="container-boza flex items-center justify-between py-4">
            <a href="{{ route('home') }}" class="transition-transform duration-200 hover:scale-[1.03] active:scale-95"><x-logo /></a>

            <div class="hidden items-center gap-6 lg:flex">
                @php
                    $navLinks = [
                        ['label' => 'Home', 'route' => 'home'],
                        ['label' => 'About Us', 'route' => 'about', 'visible' => $settings->nav_about_visible ?? true, 'children' => [
                            ['label' => 'Our Story', 'route' => 'about'],
                            ['label' => 'Leadership', 'route' => 'leadership', 'visible' => $settings->nav_leadership_visible ?? true],
                        ]],
                        ['label' => 'Services', 'route' => 'services.index', 'visible' => $settings->nav_services_visible ?? true],
                        ['label' => 'Gallery', 'route' => 'gallery', 'visible' => $settings->nav_gallery_visible ?? true],
                        ['label' => 'News', 'route' => 'news.index', 'visible' => $settings->nav_news_visible ?? true],
                        ['label' => 'Careers', 'route' => 'careers.index', 'visible' => $settings->nav_careers_visible ?? true],
                        ['label' => 'Contact', 'route' => 'contact', 'visible' => $settings->nav_contact_visible ?? true],
                    ];

                    $navLinks = collect($navLinks)
                        ->filter(fn ($item) => $item['visible'] ?? true)
                        ->map(function ($item) {
                            $children = collect($item['children'] ?? [])->filter(fn ($c) => $c['visible'] ?? true)->values();

                            // A dropdown with only a duplicate of the parent's own link isn't a real submenu.
                            if ($children->every(fn ($c) => $c['route'] === $item['route'])) {
                                $children = collect();
                            }

                            $item['children'] = $children->all();

                            return $item;
                        })
                        ->values()
                        ->all();
                @endphp
                @foreach ($navLinks as $item)
                    @php
                        $children = $item['children'] ?? [];
                        $isActive = request()->routeIs($item['route'].'*')
                            || collect($children)->contains(fn ($c) => request()->routeIs($c['route'].'*'));
                    @endphp
                    @if (count($children))
                        <div class="relative" x-data="{ menuOpen: false }" @mouseenter="menuOpen = true" @mouseleave="menuOpen = false">
                            <button
                                @click="menuOpen = !menuOpen"
                                class="group relative flex items-center gap-1 py-1 text-sm font-semibold transition-colors duration-200 {{ $isActive ? 'text-[var(--color-primary)]' : 'text-navy-700 hover:text-[var(--color-primary)]' }}"
                            >
                                {{ $item['label'] }}
                                <x-icon name="chevron-down" class="h-3.5 w-3.5 transition-transform duration-200" ::class="menuOpen ? 'rotate-180' : ''" />
                                <span class="absolute -bottom-1 left-0 h-0.5 rounded-full bg-[var(--color-primary)] transition-all duration-300 ease-out {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                            </button>
                            {{-- pt-3 (not mt-3) keeps this hoverable area touching the button, so the mouse never exits the div while crossing the visual gap --}}
                            <div
                                x-show="menuOpen"
                                x-cloak
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 -translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute left-0 top-full z-20 w-56 pt-3"
                            >
                                <div class="rounded-lg border border-navy-100 bg-white py-2 shadow-soft">
                                    @foreach ($children as $child)
                                        @php $childActive = request()->routeIs($child['route'].'*'); @endphp
                                        <a href="{{ route($child['route']) }}" class="block px-4 py-2.5 text-sm font-medium transition-colors {{ $childActive ? 'text-[var(--color-primary)]' : 'text-navy-700 hover:bg-navy-50 hover:text-[var(--color-primary)]' }}">
                                            {{ $child['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route($item['route']) }}"
                           class="group relative py-1 text-sm font-semibold transition-colors duration-200 active:scale-95 {{ $isActive ? 'text-[var(--color-primary)]' : 'text-navy-700 hover:text-[var(--color-primary)]' }}">
                            {{ $item['label'] }}
                            <span class="absolute -bottom-1 left-0 h-0.5 rounded-full bg-[var(--color-primary)] transition-all duration-300 ease-out {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                        </a>
                    @endif
                @endforeach
            </div>

            <div class="flex items-center gap-3">
                <button
                    @click="search = !search; open = false; $nextTick(() => search && $refs.searchInput.focus())"
                    class="text-navy-600 transition-transform duration-150 hover:text-[var(--color-primary)] active:scale-90"
                    aria-label="Search"
                >
                    <x-icon name="search" class="h-5 w-5" />
                </button>

                <div class="hidden lg:block">
                    <a href="{{ route('contact') }}" class="btn-primary">
                        Request Crew / Get a Quote
                    </a>
                </div>

                <button @click="open = !open; search = false" class="relative text-navy-800 transition-transform duration-150 active:scale-90 lg:hidden" aria-label="Toggle navigation">
                    <x-icon x-show="!open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -rotate-90" x-transition:enter-end="opacity-100 rotate-0" name="menu" class="h-7 w-7" />
                    <x-icon x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 rotate-90" x-transition:enter-end="opacity-100 rotate-0" name="x" class="absolute inset-0 h-7 w-7" x-cloak />
                </button>
            </div>
        </nav>

        {{-- Search panel --}}
        <div
            x-show="search"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @keydown.escape.window="search = false"
            @click.outside="search = false"
            class="border-t border-navy-100 bg-white shadow-soft"
        >
            <form action="{{ route('search') }}" method="GET" class="container-boza flex items-center gap-3 py-5">
                <x-icon name="search" class="h-5 w-5 shrink-0 text-navy-300" />
                <input
                    type="text"
                    name="q"
                    x-ref="searchInput"
                    placeholder="Search services, careers, news…"
                    value="{{ request('q') }}"
                    class="flex-1 border-0 border-b-2 border-navy-100 bg-transparent px-0 py-2 text-base text-navy-900 placeholder:text-navy-300 focus:border-[var(--color-primary)] focus:outline-none focus:ring-0 sm:text-lg"
                >
                <button type="submit" class="btn-primary shrink-0">Search</button>
            </form>
        </div>

        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="border-t border-navy-100 bg-white lg:hidden">
            <div class="container-boza flex flex-col gap-1 py-4">
                @foreach ($navLinks as $item)
                    <a href="{{ route($item['route']) }}" class="rounded-md px-3 py-2.5 text-sm font-semibold transition-colors duration-150 active:scale-95 {{ request()->routeIs($item['route'].'*') ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'text-navy-700 hover:bg-navy-50' }}">
                        {{ $item['label'] }}
                    </a>
                    @foreach ($item['children'] ?? [] as $child)
                        @continue($child['route'] === $item['route'])
                        <a href="{{ route($child['route']) }}" class="ml-4 rounded-md border-l border-navy-100 px-3 py-2 text-sm font-medium transition-colors duration-150 active:scale-95 {{ request()->routeIs($child['route'].'*') ? 'text-[var(--color-primary)]' : 'text-navy-500 hover:bg-navy-50' }}">
                            {{ $child['label'] }}
                        </a>
                    @endforeach
                @endforeach
                <a href="{{ route('contact') }}" class="btn-primary mt-2 justify-center">Request Crew / Get a Quote</a>
            </div>
        </div>
    </header>

    @if (session('success'))
        <div class="bg-brand-primary-soft border-b border-navy-100">
            <div class="container-boza flex items-center gap-2 py-3 text-sm font-medium text-[var(--color-primary)]">
                <x-icon name="check" class="h-5 w-5 shrink-0" />
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-brand-dark text-white/70">
        <div class="container-boza grid grid-cols-1 gap-10 py-16 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <x-logo light />
                <p class="mt-4 text-sm leading-relaxed text-white/60">
                    {{ $settings->tagline ?? 'People. Compliance. Operations. Delivered' }}
                </p>
                <p class="mt-4 text-xs uppercase tracking-widest text-white/40">Ghana Maritime Authority · Ghana Labour Act 2003 [Act 651] · MLC 2006 · STCW</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Quick Links</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @if ($settings->nav_about_visible ?? true)
                        <li><a href="{{ route('about') }}" class="hover:text-[var(--color-accent)]">About Us</a></li>
                    @endif
                    @if ($settings->nav_leadership_visible ?? true)
                        <li><a href="{{ route('leadership') }}" class="hover:text-[var(--color-accent)]">Leadership</a></li>
                    @endif
                    @if ($settings->nav_services_visible ?? true)
                        <li><a href="{{ route('services.index') }}" class="hover:text-[var(--color-accent)]">Our Services</a></li>
                    @endif
                    @if ($settings->nav_gallery_visible ?? true)
                        <li><a href="{{ route('gallery') }}" class="hover:text-[var(--color-accent)]">Gallery</a></li>
                    @endif
                    @if ($settings->nav_news_visible ?? true)
                        <li><a href="{{ route('news.index') }}" class="hover:text-[var(--color-accent)]">News</a></li>
                    @endif
                    @if ($settings->nav_careers_visible ?? true)
                        <li><a href="{{ route('careers.index') }}" class="hover:text-[var(--color-accent)]">Careers</a></li>
                        <li><a href="{{ route('careers.apply') }}" class="hover:text-[var(--color-accent)]">Submit CV</a></li>
                    @endif
                    @if ($settings->nav_contact_visible ?? true)
                        <li><a href="{{ route('contact') }}" class="hover:text-[var(--color-accent)]">Contact Us</a></li>
                    @endif
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Services</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('services.index') }}" class="hover:text-[var(--color-accent)]">Offshore Crewing & Recruitment</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-[var(--color-accent)]">Landbase Recruitment</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-[var(--color-accent)]">Consultancy Services</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-[var(--color-accent)]">Logistics & Operations Support</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-[var(--color-accent)]">HR Outsourcing</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Get In Touch</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li class="flex items-start gap-2.5">
                        <x-icon name="map-pin" class="mt-0.5 h-4 w-4 shrink-0 text-[var(--color-accent)]" />
                        {{ $settings->address ?? 'Takoradi, Western Region, Ghana' }}
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-icon name="phone" class="mt-0.5 h-4 w-4 shrink-0 text-[var(--color-accent)]" />
                        <span>
                            <a href="tel:{{ preg_replace('/\s+/', '', $settings->phone_primary ?? '') }}" class="hover:text-[var(--color-accent)]">{{ $settings->phone_primary ?? '' }}</a>
                            @if($settings->phone_secondary ?? false)
                                <br><a href="tel:{{ preg_replace('/\s+/', '', $settings->phone_secondary) }}" class="hover:text-[var(--color-accent)]">{{ $settings->phone_secondary }}</a>
                            @endif
                        </span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-icon name="mail" class="mt-0.5 h-4 w-4 shrink-0 text-[var(--color-accent)]" />
                        <span>
                            <a href="mailto:{{ $settings->email_primary ?? '' }}" class="hover:text-[var(--color-accent)]">{{ $settings->email_primary ?? '' }}</a>
                            @if($settings->email_secondary ?? false)
                                <br><a href="mailto:{{ $settings->email_secondary }}" class="hover:text-[var(--color-accent)]">{{ $settings->email_secondary }}</a>
                            @endif
                        </span>
                    </li>
                </ul>

                @if ($settings->facebook_url || $settings->linkedin_url || $settings->whatsapp_url || $settings->tiktok_url || $settings->youtube_url)
                    <div class="mt-6 flex items-center gap-3">
                        @if ($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-[var(--color-accent)]">
                                <x-icon name="facebook" class="h-4 w-4" />
                            </a>
                        @endif
                        @if ($settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener" aria-label="LinkedIn" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-[var(--color-accent)]">
                                <x-icon name="linkedin" class="h-4 w-4" />
                            </a>
                        @endif
                        @if ($settings->tiktok_url)
                            <a href="{{ $settings->tiktok_url }}" target="_blank" rel="noopener" aria-label="TikTok" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-[var(--color-accent)]">
                                <x-icon name="tiktok" class="h-4 w-4" />
                            </a>
                        @endif
                        @if ($settings->youtube_url)
                            <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-[var(--color-accent)]">
                                <x-icon name="youtube" class="h-4 w-4" />
                            </a>
                        @endif
                        @if ($settings->whatsapp_url)
                            <a href="{{ $settings->whatsapp_url }}" target="_blank" rel="noopener" aria-label="WhatsApp" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-[var(--color-accent)]">
                                <x-icon name="whatsapp" class="h-4 w-4" />
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="border-t border-white/10">
            <div class="container-boza flex flex-col items-center justify-between gap-2 py-6 text-xs text-white/50 sm:flex-row">
                <p>&copy; {{ now()->year }} Boza Marine Solutions and Crewing Services Ltd. All rights reserved.</p>
                <p>{{ $settings->tagline ?? 'People. Compliance. Operations. Delivered' }}</p>
            </div>
        </div>
    </footer>

    <x-back-to-top />

    @php $whatsappAgents = $settings?->whatsappAgents() ?? collect(); @endphp
    @if ($whatsappAgents->isNotEmpty())
        <x-whatsapp-agents :agents="$whatsappAgents" />
    @endif

</body>
</html>
