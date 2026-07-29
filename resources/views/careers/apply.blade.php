<x-layouts.public :settings="$settings" title="Submit Your Application" metaDescription="Apply for an offshore or land-based role, or submit a speculative CV to Boza Marine Solutions.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        @include('partials.page-header-image', ['image' => $settings->header_image_careers])
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">Careers</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">
                {{ $jobPosting ? 'Apply: '.$jobPosting->title : 'Submit Your Application' }}
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                Fill in your details and attach your CV (PDF or Word, max 5MB). Our recruitment team reviews every application.
            </p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza mx-auto max-w-2xl">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3 rounded-xl bg-brand-primary-soft px-5 py-3 text-sm">
                <span class="font-medium text-navy-700">Signed in as <strong>{{ $candidate->name }}</strong></span>
                <div class="flex items-center gap-4">
                    <a href="{{ route('candidate.applications.index') }}" class="font-semibold text-[var(--color-primary)] hover:opacity-80">My Applications</a>
                    <form method="POST" action="{{ route('candidate.logout') }}">
                        @csrf
                        <button type="submit" class="font-semibold text-navy-500 hover:text-navy-800">Sign Out</button>
                    </form>
                </div>
            </div>

            <form method="POST" action="{{ route('careers.apply.store') }}" enctype="multipart/form-data" class="space-y-6 rounded-2xl border border-navy-100 p-8 shadow-sm sm:p-10">
                @csrf

                <div>
                    <x-input-label for="job_posting_id" value="Position" />
                    <select id="job_posting_id" name="job_posting_id" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                        <option value="">General / Speculative Application</option>
                        @foreach ($jobs as $job)
                            <option value="{{ $job->id }}" @selected(optional($jobPosting)->id === $job->id)>{{ $job->title }} ({{ $job->sector }})</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('job_posting_id')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="full_name" value="Full Name" />
                        <x-text-input id="full_name" name="full_name" type="text" class="mt-1.5" :value="old('full_name', $candidate->name)" required autofocus />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" value="Email Address" />
                        <x-text-input id="email" name="email" type="email" class="mt-1.5" :value="old('email', $candidate->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="phone" value="Phone Number" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1.5" :value="old('phone', $candidate->phone)" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="position_applied_for" value="Position / Role Title" />
                        <x-text-input id="position_applied_for" name="position_applied_for" type="text" class="mt-1.5" :value="old('position_applied_for', optional($jobPosting)->title)" />
                        <x-input-error :messages="$errors->get('position_applied_for')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="cover_message" value="Cover Message (optional)" />
                    <textarea id="cover_message" name="cover_message" rows="5" class="mt-1.5 w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">{{ old('cover_message') }}</textarea>
                    <x-input-error :messages="$errors->get('cover_message')" class="mt-2" />
                </div>

                <div x-data="{ fileName: '' }">
                    <x-input-label for="cv" value="Upload CV (PDF or Word, max 5MB)" />
                    <div class="mt-1.5 flex items-center justify-center rounded-md border-2 border-dashed border-navy-200 px-6 py-8 text-center">
                        <div>
                            <x-icon name="upload" class="mx-auto h-8 w-8 text-navy-400" />
                            <label for="cv" class="mt-3 block cursor-pointer text-sm font-semibold text-[var(--color-primary)] hover:text-[var(--color-primary)]">
                                <span x-text="fileName || 'Choose a file'"></span>
                                <input id="cv" name="cv" type="file" accept=".pdf,.doc,.docx" class="sr-only" required
                                       @change="fileName = $event.target.files[0]?.name ?? ''">
                            </label>
                            <p class="mt-1 text-xs text-navy-400">PDF, DOC, or DOCX up to 5MB</p>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                </div>

                <button type="submit" class="btn-primary w-full">Submit Application</button>
            </form>
        </div>
    </section>

</x-layouts.public>
