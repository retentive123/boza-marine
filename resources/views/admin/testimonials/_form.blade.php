@php $testimonial ??= null; @endphp

<div class="mb-6" x-data="{ preview: null }">
    <x-input-label value="Photo (optional)" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-full border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-cover">
            </template>
            <template x-if="!preview">
                @if (isset($testimonial) && $testimonial->photo_path)
                    <img src="{{ asset('storage/'.$testimonial->photo_path) }}" class="h-full w-full object-cover">
                @else
                    <x-icon name="image" class="h-6 w-6 text-navy-300" />
                @endif
            </template>
        </div>
        <label class="cursor-pointer text-sm font-semibold" style="color: var(--color-primary)">
            Choose file
            <input type="file" name="photo" accept="image/*" class="sr-only" @change="preview = URL.createObjectURL($event.target.files[0])">
        </label>
    </div>
    @if (isset($testimonial) && $testimonial->photo_path)
        <label class="mt-2 flex items-center gap-1.5 text-xs text-navy-500">
            <input type="checkbox" name="remove_photo" value="1" class="rounded border-navy-300"> Remove photo
        </label>
    @endif
    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="name" value="Name" />
        <x-text-input id="name" name="name" type="text" class="mt-1.5" :value="old('name', $testimonial->name ?? '')" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="role" value="Role / Company" />
        <x-text-input id="role" name="role" type="text" class="mt-1.5" :value="old('role', $testimonial->role ?? '')" />
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>
</div>

<div class="mt-6">
    <x-input-label for="quote" value="Quote" />
    <textarea id="quote" name="quote" rows="4" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" required>{{ old('quote', $testimonial->quote ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('quote')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $testimonial->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
    <div class="flex items-end pb-2.5">
        <label class="flex items-center gap-2.5">
            <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $testimonial->is_active ?? true)) class="rounded border-navy-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
            <span class="text-sm font-semibold text-navy-800">Visible on public site</span>
        </label>
    </div>
</div>
