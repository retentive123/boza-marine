@props(['title' => 'Dashboard'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} — Boza Admin</title>
    @include('partials.brand-styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-navy-50/40 font-sans text-navy-900" x-data="{ sidebarOpen: false }">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-40 flex w-64 transform flex-col bg-brand-dark text-white/80 transition-transform duration-200 lg:static lg:translate-x-0">
            <div class="flex h-16 shrink-0 items-center gap-2 border-b border-white/10 px-6">
                <x-logo light />
            </div>

            <nav class="min-h-0 flex-1 space-y-5 overflow-y-auto px-3 py-4 text-sm">
                @php
                    $groups = [
                        'Overview' => [
                            'admin.dashboard' => ['Dashboard', 'building-office'],
                        ],
                        'Recruitment' => [
                            'admin.jobs.index' => ['Job Postings', 'briefcase'],
                            'admin.applications.index' => ['Applications', 'document-text'],
                        ],
                        'Homepage' => [
                            'admin.hero-slides.index' => ['Hero Slides', 'image'],
                            'admin.hero-background.index' => ['Default Hero Photos', 'photo'],
                            'admin.home-highlights.index' => ['Highlights', 'sparkle'],
                            'admin.home-showcase.index' => ['Showcase Carousel', 'stack'],
                        ],
                        'Site Content' => [
                            'admin.services.index' => ['Services', 'ship'],
                            'admin.gallery.index' => ['Gallery', 'photo'],
                            'admin.news.index' => ['News', 'newspaper'],
                            'admin.team.index' => ['Leadership Team', 'users'],
                            'admin.testimonials.index' => ['Testimonials', 'star'],
                            'admin.differentiators.index' => ['Differentiators', 'shield-check'],
                            'admin.stats.index' => ['Stats', 'bolt'],
                        ],
                        'Inbox' => [
                            'admin.messages.index' => ['Messages', 'inbox'],
                        ],
                        'Configuration' => [
                            'admin.settings.edit' => ['Site Settings', 'globe'],
                        ],
                    ];
                @endphp
                @foreach ($groups as $groupLabel => $links)
                    <div>
                        <p class="px-3 text-[11px] font-bold uppercase tracking-[0.15em] text-white/35">{{ $groupLabel }}</p>
                        <div class="mt-2 space-y-1">
                            @foreach ($links as $routeName => [$label, $icon])
                                <a href="{{ route($routeName) }}"
                                   class="flex items-center gap-3 rounded-md px-3 py-2.5 font-medium transition {{ request()->routeIs($routeName.'*') ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                                    <x-icon :name="$icon" class="h-4.5 w-4.5" />
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>

            <div class="shrink-0 space-y-1 border-t border-white/10 p-3 text-sm">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-md px-3 py-2.5 font-medium text-white/60 hover:bg-white/5 hover:text-white">
                    <x-icon name="arrow-right" class="h-4.5 w-4.5" /> View Live Site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left font-medium text-white/60 hover:bg-white/5 hover:text-white">
                        <x-icon name="x" class="h-4.5 w-4.5" /> Log Out
                    </button>
                </form>
            </div>
        </aside>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-30 lg:hidden" style="background-color: color-mix(in srgb, var(--color-secondary) 60%, transparent)"></div>

        {{-- Main --}}
        <div class="flex min-h-screen flex-1 flex-col">
            <header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-navy-100 bg-white px-6">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="text-navy-500 lg:hidden">
                        <x-icon name="menu" class="h-6 w-6" />
                    </button>
                    <h1 class="text-lg font-semibold text-navy-900">{{ $title }}</h1>
                </div>
                <div class="flex items-center gap-3 text-sm text-navy-600">
                    <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-primary-soft font-semibold text-[var(--color-primary)]">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
            </header>

            @if (session('success'))
                <div class="mx-6 mt-6 flex items-center gap-2 rounded-md bg-brand-primary-soft px-4 py-3 text-sm font-medium text-[var(--color-primary)]">
                    <x-icon name="check" class="h-5 w-5 shrink-0" /> {{ session('success') }}
                </div>
            @endif

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <x-back-to-top />

</body>
</html>
