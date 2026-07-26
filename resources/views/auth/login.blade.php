<x-guest-layout>
    <h1 class="font-display text-xl font-semibold text-navy-900">Admin Sign In</h1>
    <p class="mt-1 text-sm text-navy-500">Internal access for Boza Marine Solutions staff.</p>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1.5 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1.5 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-navy-300 text-[var(--color-primary)] shadow-sm focus:ring-[var(--color-primary)]" name="remember">
                <span class="ms-2 text-sm text-navy-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-navy-500 underline hover:text-[var(--color-primary)]" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="mt-6 w-full justify-center py-3">
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</x-guest-layout>
