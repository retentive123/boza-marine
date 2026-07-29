<x-layouts.public :settings="$settings ?? \App\Models\SiteSetting::current()" title="Candidate Sign In" metaDescription="Sign in to apply for roles and track your application status with Boza Marine Solutions.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">Careers</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Candidate Sign In</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                Sign in to apply for roles and track the status of your applications.
            </p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza mx-auto max-w-md">
            <form method="POST" action="{{ route('candidate.login') }}" class="space-y-6 rounded-2xl border border-navy-100 p-8 shadow-sm sm:p-10">
                @csrf

                <x-auth-session-status :status="session('status')" />

                <div>
                    <x-input-label for="email" value="Email Address" />
                    <x-text-input id="email" name="email" type="email" class="mt-1.5" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" name="password" type="password" class="mt-1.5" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <label class="flex items-center gap-2 text-sm text-navy-600">
                    <input type="checkbox" name="remember" class="rounded border-navy-300 text-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                    Remember me
                </label>

                <button type="submit" class="btn-primary w-full">Sign In</button>

                <p class="text-center text-sm text-navy-500">
                    Don't have an account?
                    <a href="{{ route('candidate.register') }}" class="font-semibold text-[var(--color-primary)] hover:opacity-80">Create one</a>
                </p>
            </form>
        </div>
    </section>

</x-layouts.public>
