<x-layouts.public :settings="$settings ?? \App\Models\SiteSetting::current()" title="Create an Account" metaDescription="Create a candidate account to apply for roles and track your application status with Boza Marine Solutions.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">Careers</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">Create Your Account</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                Register to apply for roles and track the status of every application in one place.
            </p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza mx-auto max-w-md">
            <form method="POST" action="{{ route('candidate.register') }}" class="space-y-6 rounded-2xl border border-navy-100 p-8 shadow-sm sm:p-10">
                @csrf

                <div>
                    <x-input-label for="name" value="Full Name" />
                    <x-text-input id="name" name="name" type="text" class="mt-1.5" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" value="Email Address" />
                    <x-text-input id="email" name="email" type="email" class="mt-1.5" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" value="Phone Number (optional)" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1.5" :value="old('phone')" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" name="password" type="password" class="mt-1.5" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="Confirm Password" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1.5" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="btn-primary w-full">Create Account</button>

                <p class="text-center text-sm text-navy-500">
                    Already have an account?
                    <a href="{{ route('candidate.login') }}" class="font-semibold text-[var(--color-primary)] hover:opacity-80">Sign in</a>
                </p>
            </form>
        </div>
    </section>

</x-layouts.public>
