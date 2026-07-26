@php $highlight ??= null; @endphp

<div class="mb-6" x-data="{ preview: null }">
    <x-input-label value="Image (optional — falls back to an icon if left blank)" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-24 w-40 items-center justify-center overflow-hidden rounded-lg border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-cover">
            </template>
            <template x-if="!preview">
                @if (isset($highlight) && $highlight->image_path)
                    <img src="{{ asset('storage/'.$highlight->image_path) }}" class="h-full w-full object-cover">
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
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="title" value="Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1.5" :value="old('title', $highlight->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="icon" value="Fallback Icon" />
        <select id="icon" name="icon" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
            @foreach (['ship','briefcase','academic-cap','truck','users','building-office','shield-check','bolt','globe','clock','star'] as $iconOption)
                <option value="{{ $iconOption }}" @selected(old('icon', $highlight->icon ?? 'shield-check') === $iconOption)>{{ $iconOption }}</option>
            @endforeach
        </select>
        <p class="mt-1 text-[11px] text-navy-400">Used only when no image is uploaded.</p>
        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
    </div>
</div>

<div class="mt-6">
    <x-input-label for="description" value="Description" />
    <textarea id="description" name="description" rows="4" maxlength="1000" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" required>{{ old('description', $highlight->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="button_text" value="Button Text (optional)" />
        <x-text-input id="button_text" name="button_text" type="text" class="mt-1.5" :value="old('button_text', $highlight->button_text ?? '')" placeholder="e.g. Learn More" />
        <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="button_url" value="Button Link" />
        <x-text-input id="button_url" name="button_url" type="text" class="mt-1.5" :value="old('button_url', $highlight->button_url ?? '')" placeholder="/services" />
        <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $highlight->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
    <div class="flex items-end pb-2.5">
        <label class="flex items-center gap-2.5">
            <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $highlight->is_active ?? true)) class="rounded border-navy-300 text-ocean-600 focus:ring-[var(--color-primary)]">
            <span class="text-sm font-semibold text-navy-800">Visible on homepage</span>
        </label>
    </div>
</div>
