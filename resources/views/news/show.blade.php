<x-layouts.public :settings="$settings" :title="$post->title" :metaDescription="$post->excerpt">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_news])
        <div class="container-boza relative z-10">
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-white/60 hover:text-white">
                <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> All News
            </a>
            @if ($post->category)
                <span class="mt-6 inline-block w-fit rounded-full bg-[var(--color-accent)]/15 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[var(--color-accent)]">{{ $post->category }}</span>
            @endif
            <h1 class="font-display mt-3 text-3xl font-semibold sm:text-4xl">{{ $post->title }}</h1>
            <p class="mt-4 text-sm text-white/60">{{ optional($post->published_at)->format('d F Y') }}</p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza grid grid-cols-1 gap-14 lg:grid-cols-3">
            <div class="lg:col-span-2">
                @if ($post->image_path)
                    <img src="{{ asset('storage/'.$post->image_path) }}" alt="{{ $post->title }}" class="mb-10 h-72 w-full rounded-2xl object-cover shadow-soft sm:h-96">
                @endif

                <div class="prose-boza whitespace-pre-line text-base leading-relaxed text-navy-700">{{ $post->body }}</div>
            </div>

            <div class="space-y-6">
                <div class="rounded-xl border border-navy-100 bg-navy-50/60 p-7">
                    <h3 class="text-base font-semibold text-navy-900">Talk to Our Team</h3>
                    <p class="mt-2 text-sm text-navy-600">Questions about this update? Reach out and we'll respond within one business day.</p>
                    <a href="{{ route('contact') }}" class="btn-primary mt-5 w-full">Contact Us</a>
                </div>

                @if ($otherPosts->count())
                    <div class="rounded-xl border border-navy-100 p-7">
                        <h3 class="text-base font-semibold text-navy-900">More News</h3>
                        <ul class="mt-4 space-y-4">
                            @foreach ($otherPosts as $other)
                                <li>
                                    <a href="{{ route('news.show', $other) }}" class="block group">
                                        <p class="text-sm font-medium text-navy-800 transition group-hover:text-[var(--color-primary)]">{{ $other->title }}</p>
                                        <p class="mt-0.5 text-xs text-navy-400">{{ optional($other->published_at)->format('d M Y') }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script type="application/ld+json">
        {!! json_encode(array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $post->title,
            'description' => $post->excerpt,
            'image' => $post->image_path ? asset('storage/'.$post->image_path) : null,
            'datePublished' => $post->published_at?->toAtomString(),
            'dateModified' => $post->updated_at->toAtomString(),
            'author' => [
                '@type' => 'Organization',
                'name' => $settings->company_name ?? 'Boza Marine Solutions and Crewing Services',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $settings->company_name ?? 'Boza Marine Solutions and Crewing Services',
                'logo' => $settings->logo_path ? [
                    '@type' => 'ImageObject',
                    'url' => asset('storage/'.$settings->logo_path),
                ] : null,
            ],
        ]), JSON_UNESCAPED_SLASHES) !!}
    </script>

</x-layouts.public>
