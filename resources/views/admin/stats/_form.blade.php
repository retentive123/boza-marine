@php $stat ??= null; @endphp

<div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
    <div>
        <x-input-label for="value" value="Value" />
        <x-text-input id="value" name="value" type="text" class="mt-1.5" :value="old('value', $stat->value ?? '')" required placeholder="e.g. 48" />
        <x-input-error :messages="$errors->get('value')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="suffix" value="Suffix" />
        <x-text-input id="suffix" name="suffix" type="text" class="mt-1.5" :value="old('suffix', $stat->suffix ?? '')" placeholder="e.g. hrs, +, %" />
        <x-input-error :messages="$errors->get('suffix')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="order" value="Display Order" />
        <x-text-input id="order" name="order" type="number" class="mt-1.5" :value="old('order', $stat->order ?? 0)" />
        <x-input-error :messages="$errors->get('order')" class="mt-2" />
    </div>
</div>

<div class="mt-6">
    <x-input-label for="label" value="Label" />
    <x-text-input id="label" name="label" type="text" class="mt-1.5" :value="old('label', $stat->label ?? '')" required placeholder="e.g. Mobilization Time" />
    <x-input-error :messages="$errors->get('label')" class="mt-2" />
</div>
