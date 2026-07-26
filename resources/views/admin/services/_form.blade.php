@php $service ??= null; @endphp

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="title" value="Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1.5" :value="old('title', $service->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="category" value="Category" />
        <x-text-input id="category" name="category" type="text" class="mt-1.5" :value="old('category', $service->category ?? '')" required placeholder="e.g. Offshore, Consultancy" />
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="icon" value="Icon" />
        <select id="icon" name="icon" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
            @foreach (['ship','briefcase','academic-cap','truck','users','building-office','shield-check','scale','bolt','globe','document-text','star'] as $icon)
                <option value="{{ $icon }}" @selected(old('icon', $service->icon ?? 'ship') === $icon)>{{ $icon }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $service->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
</div>

<div class="mt-6" x-data="{ preview: null }">
    <x-input-label value="Card / Detail Image (optional — icon is used when no image is set)" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-20 w-32 items-center justify-center overflow-hidden rounded-lg border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-cover">
            </template>
            <template x-if="!preview">
                @if (isset($service) && $service->image_path)
                    <img src="{{ asset('storage/'.$service->image_path) }}" class="h-full w-full object-cover">
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
    @if (isset($service) && $service->image_path)
        <label class="mt-2 flex items-center gap-1.5 text-xs text-navy-500">
            <input type="checkbox" name="remove_image" value="1" class="rounded border-navy-300"> Remove image
        </label>
    @endif
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="summary" value="Short Summary" />
    <x-text-input id="summary" name="summary" type="text" class="mt-1.5" :value="old('summary', $service->summary ?? '')" required maxlength="255" />
    <x-input-error :messages="$errors->get('summary')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="description" value="Full Description" />
    <textarea id="description" name="description" rows="5" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" required>{{ old('description', $service->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="deliverables" value="Key Deliverables (one per line)" />
    <textarea id="deliverables" name="deliverables" rows="5" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('deliverables', isset($service) ? implode("\n", $service->deliverables ?? []) : '') }}</textarea>
    <x-input-error :messages="$errors->get('deliverables')" class="mt-2" />
</div>

<div class="mt-6 flex items-center gap-2.5">
    <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $service->is_active ?? true)) class="rounded border-navy-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
    <x-input-label for="is_active" value="Visible on public site" />
</div>
