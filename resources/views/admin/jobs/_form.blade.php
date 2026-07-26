@php $job ??= null; @endphp

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="title" value="Job Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1.5" :value="old('title', $job->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="sector" value="Sector" />
        <select id="sector" name="sector" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" required>
            @foreach (['Offshore', 'Land-Based'] as $sector)
                <option value="{{ $sector }}" @selected(old('sector', $job->sector ?? '') === $sector)>{{ $sector }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('sector')" class="mt-2" />
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="location" value="Location" />
        <x-text-input id="location" name="location" type="text" class="mt-1.5" :value="old('location', $job->location ?? '')" />
        <x-input-error :messages="$errors->get('location')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="employment_type" value="Employment Type" />
        <x-text-input id="employment_type" name="employment_type" type="text" class="mt-1.5" :value="old('employment_type', $job->employment_type ?? '')" placeholder="e.g. Full-time, Contract / Rotational" />
        <x-input-error :messages="$errors->get('employment_type')" class="mt-2" />
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="vessel_type" value="Vessel Type (offshore roles)" />
        <x-text-input id="vessel_type" name="vessel_type" type="text" class="mt-1.5" :value="old('vessel_type', $job->vessel_type ?? '')" />
        <x-input-error :messages="$errors->get('vessel_type')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="closing_date" value="Closing Date" />
        <x-text-input id="closing_date" name="closing_date" type="date" class="mt-1.5" :value="old('closing_date', optional($job->closing_date ?? null)->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('closing_date')" class="mt-2" />
    </div>
</div>

<div class="mt-6">
    <x-input-label for="description" value="Role Overview" />
    <textarea id="description" name="description" rows="5" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]" required>{{ old('description', $job->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="requirements" value="Requirements (one per line)" />
    <textarea id="requirements" name="requirements" rows="5" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('requirements', $job->requirements ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
</div>

<div class="mt-6 flex items-center gap-2.5">
    <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $job->is_active ?? true)) class="rounded border-navy-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
    <x-input-label for="is_active" value="Visible on Careers page" />
</div>
