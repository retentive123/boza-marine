@php $image ??= null; @endphp

<div x-data="{ preview: null }">
    <x-input-label value="Photo" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-24 w-40 items-center justify-center overflow-hidden rounded-lg border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-cover">
            </template>
            <template x-if="!preview">
                @if (isset($image) && $image->image_path)
                    <img src="{{ asset('storage/'.$image->image_path) }}" class="h-full w-full object-cover">
                @else
                    <x-icon name="photo" class="h-6 w-6 text-navy-300" />
                @endif
            </template>
        </div>
        <label class="cursor-pointer text-sm font-semibold" style="color: var(--color-primary)">
            Choose file
            <input type="file" name="image" accept="image/*" class="sr-only" @change="preview = URL.createObjectURL($event.target.files[0])" {{ isset($image) ? '' : 'required' }}>
        </label>
    </div>
    <p class="mt-1 text-[11px] text-navy-400">Wide landscape photo, ideally 1920×960px or larger. Keep the main subject centered or right-of-frame — the left side fades behind the headline text.</p>
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="order" value="Display Order" />
    <x-text-input id="order" name="order" type="number" class="mt-1.5 max-w-xs" :value="old('order', $image->order ?? 0)" />
    <x-input-error :messages="$errors->get('order')" class="mt-2" />
</div>

<div class="mt-6 flex items-center gap-2.5">
    <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $image->is_active ?? true)) class="rounded border-navy-300 text-ocean-600 focus:ring-[var(--color-primary)]">
    <x-input-label for="is_active" value="Visible in rotation" />
</div>
