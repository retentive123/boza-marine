<x-layouts.public :settings="$settings" title="Gallery" metaDescription="A look at Boza Marine Solutions crew, operations, and team in action.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_gallery])
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">Gallery</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Boza in Action</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                Crew mobilizations, vessel operations, and the people behind Boza Marine Solutions.
            </p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza">
            @if ($images->isEmpty())
                <div class="rounded-xl border border-dashed border-navy-200 p-16 text-center text-navy-400">
                    The gallery is being updated — check back soon.
                </div>
            @else
                @php $categories = $images->pluck('category')->filter()->unique()->values(); @endphp

                <div x-data="{ ...lightbox(), category: 'All' }">
                    @if ($categories->count() > 1)
                        <div class="reveal mb-10 flex flex-wrap justify-center gap-3">
                            <button
                                @click="category = 'All'"
                                :class="category === 'All' ? 'text-white' : 'bg-brand-primary-soft text-[var(--color-primary)] hover:opacity-80'"
                                :style="category === 'All' ? 'background-color: var(--color-primary)' : ''"
                                class="rounded-full px-4 py-2 text-sm font-semibold transition active:scale-95"
                            >All Photos</button>
                            @foreach ($categories as $cat)
                                <button
                                    @click="category = '{{ $cat }}'"
                                    :class="category === '{{ $cat }}' ? 'text-white' : 'bg-brand-primary-soft text-[var(--color-primary)] hover:opacity-80'"
                                    :style="category === '{{ $cat }}' ? 'background-color: var(--color-primary)' : ''"
                                    class="rounded-full px-4 py-2 text-sm font-semibold transition active:scale-95"
                                >{{ $cat }}</button>
                            @endforeach
                        </div>
                    @endif

                    <div class="columns-2 gap-4 sm:columns-3 lg:columns-4">
                        @foreach ($images as $index => $image)
                            <button
                                type="button"
                                @click="show({{ $index }})"
                                x-show="category === 'All' || category === '{{ $image->category }}'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="reveal group relative mb-4 block w-full overflow-hidden rounded-xl bg-navy-50 break-inside-avoid"
                                style="transition-delay: {{ ($index % 8) * 60 }}ms"
                            >
                                <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $image->caption }}" loading="lazy" class="w-full object-cover transition duration-500 group-hover:scale-110">
                                <span class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 transition group-hover:opacity-100"></span>
                                <span class="absolute inset-x-0 bottom-0 flex items-center justify-between p-3 text-left opacity-0 transition group-hover:opacity-100">
                                    @if ($image->caption)
                                        <span class="text-xs font-medium text-white">{{ $image->caption }}</span>
                                    @endif
                                    <x-icon name="image" class="h-4 w-4 shrink-0 text-white/80" />
                                </span>
                            </button>
                        @endforeach
                    </div>

                    {{-- Lightbox --}}
                    <div x-show="open" x-cloak x-transition.opacity @keydown.escape.window="close()" class="fixed inset-0 z-[60] flex items-center justify-center bg-black/90 p-4 sm:p-10">
                        <button @click="close()" class="absolute right-5 top-5 text-white/70 transition hover:text-white active:scale-90" aria-label="Close">
                            <x-icon name="x" class="h-8 w-8" />
                        </button>
                        <button @click="prev({{ $images->count() }})" class="absolute left-3 text-white/70 transition hover:text-white active:scale-90 sm:left-6" aria-label="Previous">
                            <x-icon name="chevron-right" class="h-8 w-8 rotate-180" />
                        </button>
                        <button @click="next({{ $images->count() }})" class="absolute right-3 text-white/70 transition hover:text-white active:scale-90 sm:right-6" aria-label="Next">
                            <x-icon name="chevron-right" class="h-8 w-8" />
                        </button>

                        <div class="max-h-[85vh] max-w-4xl">
                            @foreach ($images as $index => $image)
                                <template x-if="activeIndex === {{ $index }}">
                                    <figure>
                                        <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $image->caption }}" class="max-h-[75vh] w-full rounded-lg object-contain">
                                        <figcaption class="mt-3 flex items-center justify-center gap-3 text-center text-sm text-white/70">
                                            @if ($image->caption)
                                                <span>{{ $image->caption }}</span>
                                                <span class="text-white/30">·</span>
                                            @endif
                                            <span>{{ $index + 1 }} / {{ $images->count() }}</span>
                                        </figcaption>
                                    </figure>
                                </template>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

</x-layouts.public>
