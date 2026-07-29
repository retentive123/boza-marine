<x-layouts.admin title="Edit Staff User">

    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Staff Users
    </a>

    <form method="POST" action="{{ route('admin.users.update', $staffUser) }}" class="mt-6 max-w-xl rounded-xl border border-navy-100 bg-white p-8">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" value="Full Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1.5" :value="old('name', $staffUser->name)" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="email" value="Email Address" />
            <x-text-input id="email" name="email" type="email" class="mt-1.5" :value="old('email', $staffUser->email)" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6 border-t border-navy-100 pt-6">
            <x-input-label for="password" value="New Password (optional)" />
            <x-text-input id="password" name="password" type="password" class="mt-1.5" autocomplete="new-password" />
            <p class="mt-1 text-[11px] text-navy-400">Leave blank to keep the current password.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="password_confirmation" value="Confirm New Password" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1.5" autocomplete="new-password" />
        </div>

        <button type="submit" class="btn-primary mt-8">Save Changes</button>
    </form>

</x-layouts.admin>
