<x-layouts.public :settings="$settings" title="Search" metaDescription="Search Boza Marine Solutions services, careers, and news.">

    <section class="bg-brand-hero py-16 text-white sm:py-20">
        <div class="container-boza">
            <p class="section-eyebrow text-brand-accent">Search</p>
            <h1 class="font-display mt-3 text-3xl font-semibold sm:text-4xl">
                @if ($query !== '')
                    Results for "{{ $query }}"
                @else
                    Search Boza Marine Solutions
                @endif
            </h1>

            <form action="{{ route('search') }}" method="GET" class="mt-6 flex max-w-xl items-center gap-3">
                <input
                    type="text"
                    name="q"
                    value="{{ $query }}"
                    placeholder="Search services, careers, news…"
                    autofocus
                    class="flex-1 rounded-md border-0 bg-white/10 px-4 py-3 text-white placeholder:text-white/50 focus:outline-none focus:ring-2 focus:ring-white/40"
                >
                <button type="submit" class="btn-gold shrink-0">Search</button>
            </form>
        </div>
    </section>

    <section class="py-16 sm:py-20">
        <div class="container-boza">
            @if ($query === '')
                <p class="text-navy-500">Enter a search term above to find services, career openings, and news posts.</p>
            @elseif ($results->isEmpty())
                <div class="rounded-xl border border-dashed border-navy-200 p-12 text-center">
                    <p class="text-navy-600">No results found for "{{ $query }}".</p>
                    <p class="mt-2 text-sm text-navy-400">Try a different term, or <a href="{{ route('contact') }}" class="font-semibold text-[var(--color-primary)]">contact us</a> directly.</p>
                </div>
            @else
                <p class="text-sm text-navy-500">{{ $results->count() }} result{{ $results->count() === 1 ? '' : 's' }} found</p>

                <div class="mt-8 space-y-4">
                    @foreach ($results as $result)
                        <a href="{{ $result['url'] }}" class="reveal group flex items-start gap-4 rounded-xl border border-navy-100 bg-white p-6 transition hover:-translate-y-0.5 hover:border-[var(--color-primary)] hover:shadow-soft">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                                <x-icon :name="$result['icon']" class="h-5 w-5" />
                            </span>
                            <div class="flex-1">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--color-primary)]">{{ $result['type'] }}</span>
                                <h2 class="mt-0.5 text-base font-semibold text-navy-900 transition group-hover:text-[var(--color-primary)]">{{ $result['title'] }}</h2>
                                @if ($result['excerpt'])
                                    <p class="mt-1 text-sm text-navy-600 line-clamp-2">{{ $result['excerpt'] }}</p>
                                @endif
                            </div>
                            <x-icon name="arrow-right" class="mt-2 h-4 w-4 shrink-0 text-navy-300 transition group-hover:translate-x-1 group-hover:text-[var(--color-primary)]" />
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

</x-layouts.public>
