<x-layouts.public :settings="$settings" title="My Applications" metaDescription="Track the status of your job applications with Boza Marine Solutions.">

    <section class="relative overflow-hidden bg-brand-hero py-20 text-white sm:py-24">
        <div class="container-boza relative z-10 text-center">
            <p class="section-eyebrow text-brand-accent">Careers</p>
            <h1 class="font-display mt-3 text-4xl font-semibold sm:text-5xl">My Applications</h1>
            <p class="mx-auto mt-5 max-w-2xl text-white/75">
                Welcome back, {{ $candidate->name }}. Track the status of everything you've applied for below.
            </p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="container-boza mx-auto max-w-4xl">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('careers.index') }}" class="text-sm font-semibold text-[var(--color-primary)] hover:opacity-80">
                    &larr; Browse Openings
                </a>
                <div class="flex items-center gap-4">
                    <a href="{{ route('careers.apply') }}" class="btn-primary">Submit Another Application</a>
                    <form method="POST" action="{{ route('candidate.logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-navy-500 hover:text-navy-800">Sign Out</button>
                    </form>
                </div>
            </div>

            @if ($applications->isEmpty())
                <div class="mt-10 rounded-2xl border border-dashed border-navy-200 bg-navy-50/40 p-16 text-center">
                    <x-icon name="inbox" class="mx-auto h-10 w-10 text-navy-300" />
                    <p class="mt-4 text-navy-500">You haven't submitted any applications yet.</p>
                    <a href="{{ route('careers.apply') }}" class="btn-primary mt-6 inline-flex">Submit Your First Application</a>
                </div>
            @else
                <div class="mt-10 space-y-4">
                    @php
                        $statusStyles = [
                            'new' => ['label' => 'Received', 'class' => 'bg-navy-100 text-navy-600'],
                            'reviewed' => ['label' => 'Under Review', 'class' => 'bg-amber-100 text-amber-700'],
                            'shortlisted' => ['label' => 'Shortlisted', 'class' => 'bg-brand-primary-soft text-[var(--color-primary)]'],
                            'hired' => ['label' => 'Hired', 'class' => 'bg-green-100 text-green-700'],
                            'rejected' => ['label' => 'Not Selected', 'class' => 'bg-red-100 text-red-600'],
                        ];
                    @endphp
                    @foreach ($applications as $application)
                        @php $style = $statusStyles[$application->status] ?? ['label' => ucfirst($application->status), 'class' => 'bg-navy-100 text-navy-600']; @endphp
                        <div class="flex flex-col gap-4 rounded-xl border border-navy-100 p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-base font-semibold text-navy-900">
                                    {{ $application->jobPosting->title ?? $application->position_applied_for ?? 'General / Speculative Application' }}
                                </h2>
                                <p class="mt-1 text-sm text-navy-500">
                                    Applied {{ $application->created_at->format('d M Y') }}
                                    @if ($application->jobPosting)
                                        &middot; {{ $application->jobPosting->sector }} &middot; {{ $application->jobPosting->location }}
                                    @endif
                                </p>
                            </div>
                            <span class="inline-flex w-fit items-center rounded-full px-3 py-1.5 text-xs font-bold uppercase tracking-wider {{ $style['class'] }}">
                                {{ $style['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

</x-layouts.public>
