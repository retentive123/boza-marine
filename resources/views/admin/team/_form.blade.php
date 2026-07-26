@php $member ??= null; @endphp

<div class="mb-6" x-data="{ preview: null }">
    <x-input-label value="Photo" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-full border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-cover">
            </template>
            <template x-if="!preview">
                @if (isset($member) && $member->photo_path)
                    <img src="{{ asset('storage/'.$member->photo_path) }}" class="h-full w-full object-cover">
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
    <p class="mt-1 text-[11px] text-navy-400">Square photos work best (e.g. 500×500).</p>
    @if (isset($member) && $member->photo_path)
        <label class="mt-2 flex items-center gap-1.5 text-xs text-navy-500">
            <input type="checkbox" name="remove_photo" value="1" class="rounded border-navy-300"> Remove photo
        </label>
    @endif
    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="name" value="Full Name" />
        <x-text-input id="name" name="name" type="text" class="mt-1.5" :value="old('name', $member->name ?? '')" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="role" value="Title / Role" />
        <x-text-input id="role" name="role" type="text" class="mt-1.5" :value="old('role', $member->role ?? '')" required placeholder="e.g. Managing Director" />
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="category" value="Category" />
        <select id="category" name="category" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
            @foreach (['Director', 'Management'] as $option)
                <option value="{{ $option }}" @selected(old('category', $member->category ?? 'Management') === $option)>{{ $option }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="linkedin_url" value="LinkedIn URL (optional)" />
        <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1.5" :value="old('linkedin_url', $member->linkedin_url ?? '')" placeholder="https://linkedin.com/in/..." />
        <x-input-error :messages="$errors->get('linkedin_url')" class="mt-2" />
    </div>
</div>

<div class="mt-6">
    <x-input-label for="bio" value="Short Bio (optional)" />
    <textarea id="bio" name="bio" rows="4" maxlength="1000" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('bio', $member->bio ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $member->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
    <div class="flex items-end pb-2.5">
        <label class="flex items-center gap-2.5">
            <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $member->is_active ?? true)) class="rounded border-navy-300 text-ocean-600 focus:ring-[var(--color-primary)]">
            <span class="text-sm font-semibold text-navy-800">Visible on public site</span>
        </label>
    </div>
</div>
