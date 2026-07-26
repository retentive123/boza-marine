@php $slide ??= null; @endphp

<div x-data="{ preview: null }">
    <x-input-label value="Slide Image (recommended 1920×1080, landscape)" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-24 w-40 items-center justify-center overflow-hidden rounded-lg border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-cover">
            </template>
            <template x-if="!preview">
                @if (isset($slide) && $slide->image_path)
                    <img src="{{ asset('storage/'.$slide->image_path) }}" class="h-full w-full object-cover">
                @else
                    <x-icon name="image" class="h-8 w-8 text-navy-300" />
                @endif
            </template>
        </div>
        <label class="cursor-pointer text-sm font-semibold" style="color: var(--color-primary)">
            Choose file
            <input type="file" name="image" accept="image/*" class="sr-only" @change="preview = URL.createObjectURL($event.target.files[0])" {{ isset($slide) ? '' : 'required' }}>
        </label>
    </div>
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="eyebrow" value="Eyebrow Text (optional)" />
        <x-text-input id="eyebrow" name="eyebrow" type="text" class="mt-1.5" :value="old('eyebrow', $slide->eyebrow ?? '')" placeholder="e.g. Ghanaian-Owned · Maritime & HR Solutions" />
        <x-input-error :messages="$errors->get('eyebrow')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="title" value="Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1.5" :value="old('title', $slide->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
</div>

<div class="mt-6">
    <x-input-label for="subtitle" value="Subtitle" />
    <textarea id="subtitle" name="subtitle" rows="2" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('subtitle', $slide->subtitle ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-3">
    <div>
        <x-input-label for="button_text" value="Button Text (optional)" />
        <x-text-input id="button_text" name="button_text" type="text" class="mt-1.5" :value="old('button_text', $slide->button_text ?? '')" />
        <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="button_url" value="Button Link" />
        <x-text-input id="button_url" name="button_url" type="text" class="mt-1.5" :value="old('button_url', $slide->button_url ?? '')" placeholder="/contact" />
        <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $slide->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
</div>

<div class="mt-6 flex items-center gap-2.5">
    <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $slide->is_active ?? true)) class="rounded border-navy-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
    <x-input-label for="is_active" value="Visible in homepage carousel" />
</div>
