@php $differentiator ??= null; @endphp

<div>
    <x-input-label for="title" value="Title" />
    <x-text-input id="title" name="title" type="text" class="mt-1.5" :value="old('title', $differentiator->title ?? '')" required />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="description" value="Description" />
    <x-text-input id="description" name="description" type="text" class="mt-1.5" :value="old('description', $differentiator->description ?? '')" required maxlength="255" />
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="icon" value="Icon" />
        <select id="icon" name="icon" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
            @foreach (['building-office','shield-check','scale','bolt','globe','users','academic-cap','truck','ship','briefcase','star'] as $icon)
                <option value="{{ $icon }}" @selected(old('icon', $differentiator->icon ?? 'building-office') === $icon)>{{ $icon }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $differentiator->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
</div>
