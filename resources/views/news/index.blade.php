<x-layouts.public :settings="$settings" title="News" metaDescription="Announcements, compliance updates, and stories from Boza Marine Solutions and Crewing Services.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_news])
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">News</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Latest From Boza</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                Company announcements, compliance updates, and stories from across our crewing, HR, and logistics operations.
            </p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza">
            @if ($posts->isEmpty())
                <div class="rounded-xl border border-dashed border-navy-200 p-16 text-center text-navy-400">
                    No news posts yet — check back soon.
                </div>
            @else
                <div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <a href="{{ route('news.show', $post) }}"
                           class="reveal group flex flex-col overflow-hidden rounded-2xl border border-navy-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1.5 hover:shadow-soft"
                           style="transition-delay: {{ $loop->index * 80 }}ms">
                            <div class="relative h-48 overflow-hidden bg-navy-50">
                                @if ($post->image_path)
                                    <img src="{{ asset('storage/'.$post->image_path) }}" alt="{{ $post->title }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <x-icon name="document-text" class="h-10 w-10 text-navy-200" />
                                    </div>
                                @endif
                                @if ($post->category)
                                    <span class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-[var(--color-primary)] backdrop-blur">
                                        {{ $post->category }}
                                    </span>
                                @endif
                            </div>
                            <div class="flex flex-1 flex-col p-7">
                                <p class="text-xs font-semibold uppercase tracking-wider text-navy-400">
                                    {{ optional($post->published_at)->format('d M Y') }}
                                </p>
                                <h2 class="mt-2 text-lg font-semibold text-navy-900">{{ $post->title }}</h2>
                                <p class="mt-2 flex-1 text-sm leading-relaxed text-navy-600">{{ $post->excerpt }}</p>
                                <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-[var(--color-primary)]">
                                    Read more <x-icon name="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1" />
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <div class="mt-14">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>

</x-layouts.public>
