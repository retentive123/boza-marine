@php $post ??= null; @endphp

<div class="mb-6" x-data="{ preview: null }">
    <x-input-label value="Cover Image" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-24 w-40 items-center justify-center overflow-hidden rounded-lg border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-cover">
            </template>
            <template x-if="!preview">
                @if (isset($post) && $post->image_path)
                    <img src="{{ asset('storage/'.$post->image_path) }}" class="h-full w-full object-cover">
                @else
                    <x-icon name="image" class="h-6 w-6 text-navy-300" />
                @endif
            </template>
        </div>
        <label class="cursor-pointer text-sm font-semibold" style="color: var(--color-primary)">
            Choose file
            <input type="file" name="image" accept="image/*" class="sr-only" @change="preview = URL.createObjectURL($event.target.files[0])">
        </label>
    </div>
    @if (isset($post) && $post->image_path)
        <label class="mt-2 flex items-center gap-1.5 text-xs text-navy-500">
            <input type="checkbox" name="remove_image" value="1" class="rounded border-navy-300"> Remove image
        </label>
    @endif
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="title" value="Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1.5" :value="old('title', $post->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="category" value="Category (optional)" />
        <x-text-input id="category" name="category" type="text" class="mt-1.5" :value="old('category', $post->category ?? '')" placeholder="e.g. Company News, Compliance, Crew Welfare" />
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>
</div>

<div class="mt-6">
    <x-input-label for="excerpt" value="Excerpt" />
    <textarea id="excerpt" name="excerpt" rows="2" maxlength="500" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" required>{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    <p class="mt-1 text-[11px] text-navy-400">Short summary shown on the News listing page and homepage teaser.</p>
    <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="body" value="Full Article" />
    <textarea id="body" name="body" rows="10" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" required>{{ old('body', $post->body ?? '') }}</textarea>
    <p class="mt-1 text-[11px] text-navy-400">Plain text or line breaks — paragraphs are preserved automatically.</p>
    <x-input-error :messages="$errors->get('body')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="published_at" value="Publish Date" />
        <x-text-input id="published_at" name="published_at" type="date" class="mt-1.5" :value="old('published_at', optional($post->published_at ?? null)->format('Y-m-d') ?? now()->toDateString())" />
        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
    </div>
    <div class="flex items-end pb-2.5">
        <label class="flex items-center gap-2.5">
            <input id="is_published" name="is_published" type="checkbox" value="1" @checked(old('is_published', $post->is_published ?? true)) class="rounded border-navy-300 text-ocean-600 focus:ring-[var(--color-primary)]">
            <span class="text-sm font-semibold text-navy-800">Published (visible on public site)</span>
        </label>
    </div>
</div>
