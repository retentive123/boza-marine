<x-layouts.admin title="Add Staff User">

    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Staff Users
    </a>

    <form method="POST" action="{{ route('admin.users.store') }}" class="mt-6 max-w-xl rounded-xl border border-navy-100 bg-white p-8">
        @csrf

        <div>
            <x-input-label for="name" value="Full Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1.5" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="email" value="Email Address" />
            <x-text-input id="email" name="email" type="email" class="mt-1.5" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" name="password" type="password" class="mt-1.5" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1.5" required autocomplete="new-password" />
        </div>

        <button type="submit" class="btn-primary mt-8">Add Staff User</button>
    </form>

</x-layouts.admin>
