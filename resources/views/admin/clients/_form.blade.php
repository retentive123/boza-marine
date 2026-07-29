@php $client ??= null; @endphp

<div class="mb-6" x-data="{ preview: null }">
    <x-input-label value="Logo (optional)" />
    <div class="mt-1.5 flex items-center gap-4">
        <div class="flex h-20 w-20 items-center justify-center overflow-hidden rounded-xl border border-navy-100 bg-navy-50">
            <template x-if="preview">
                <img :src="preview" class="h-full w-full object-contain">
            </template>
            <template x-if="!preview">
                @if (isset($client) && $client->logo_path)
                    <img src="{{ asset('storage/'.$client->logo_path) }}" class="h-full w-full object-contain">
                @else
                    <x-icon name="building-office" class="h-6 w-6 text-navy-300" />
                @endif
            </template>
        </div>
        <label class="cursor-pointer text-sm font-semibold" style="color: var(--color-primary)">
            Choose file
            <input type="file" name="logo" accept="image/*" class="sr-only" @change="preview = URL.createObjectURL($event.target.files[0])">
        </label>
    </div>
    <p class="mt-1 text-[11px] text-navy-400">Leave empty to show the company name as a text badge instead.</p>
    @if (isset($client) && $client->logo_path)
        <label class="mt-2 flex items-center gap-1.5 text-xs text-navy-500">
            <input type="checkbox" name="remove_logo" value="1" class="rounded border-navy-300"> Remove logo
        </label>
    @endif
    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
</div>

<div>
    <x-input-label for="name" value="Company Name" />
    <x-text-input id="name" name="name" type="text" class="mt-1.5" :value="old('name', $client->name ?? '')" required />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="website_url" value="Website URL (optional)" />
    <x-text-input id="website_url" name="website_url" type="url" class="mt-1.5" :value="old('website_url', $client->website_url ?? '')" placeholder="https://..." />
    <x-input-error :messages="$errors->get('website_url')" class="mt-2" />
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $client->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
    <div class="flex items-end pb-2.5">
        <label class="flex items-center gap-2.5">
            <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $client->is_active ?? true)) class="rounded border-navy-300 text-ocean-600 focus:ring-[var(--color-primary)]">
            <span class="text-sm font-semibold text-navy-800">Visible on public site</span>
        </label>
    </div>
</div>
