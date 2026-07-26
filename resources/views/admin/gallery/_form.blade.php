@php $image ??= null; @endphp

<div x-data="{ preview: null }">
    <x-input-label value="Image" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-lg border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-cover">
            </template>
            <template x-if="!preview">
                @if (isset($image) && $image->image_path)
                    <img src="{{ asset('storage/'.$image->image_path) }}" class="h-full w-full object-cover">
                @else
                    <x-icon name="image" class="h-8 w-8 text-navy-300" />
                @endif
            </template>
        </div>
        <label class="cursor-pointer text-sm font-semibold" style="color: var(--color-primary)">
            Choose file
            <input type="file" name="image" accept="image/*" class="sr-only" @change="preview = URL.createObjectURL($event.target.files[0])" {{ isset($image) ? '' : 'required' }}>
        </label>
    </div>
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="caption" value="Caption (optional)" />
        <x-text-input id="caption" name="caption" type="text" class="mt-1.5" :value="old('caption', $image->caption ?? '')" />
        <x-input-error :messages="$errors->get('caption')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="category" value="Category (optional)" />
        <x-text-input id="category" name="category" type="text" class="mt-1.5" :value="old('category', $image->category ?? '')" placeholder="e.g. Offshore, Team, Events" />
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $image->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
    <div class="flex items-end pb-2.5">
        <label class="flex items-center gap-2.5">
            <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $image->is_active ?? true)) class="rounded border-navy-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
            <span class="text-sm font-semibold text-navy-800">Visible on public site</span>
        </label>
    </div>
</div>
