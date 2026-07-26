<x-layouts.admin title="Application Detail">

    <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Applications
    </a>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="rounded-xl border border-navy-100 bg-white p-8 lg:col-span-2">
            <h2 class="text-xl font-semibold text-navy-900">{{ $application->full_name }}</h2>
            <p class="mt-1 text-sm text-navy-500">Applied {{ $application->created_at->format('d M Y, g:i a') }}</p>

            <dl class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Email</dt>
                    <dd class="mt-1 text-navy-800"><a href="mailto:{{ $application->email }}" class="hover:text-[var(--color-primary)]">{{ $application->email }}</a></dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Phone</dt>
                    <dd class="mt-1 text-navy-800">{{ $application->phone ?: '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Position Applied For</dt>
                    <dd class="mt-1 text-navy-800">{{ $application->position_applied_for ?: '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Linked Job Posting</dt>
                    <dd class="mt-1 text-navy-800">
                        @if ($application->jobPosting)
                            <a href="{{ route('careers.show', $application->jobPosting) }}" target="_blank" class="admin-link">{{ $application->jobPosting->title }}</a>
                        @else
                            General / Speculative
                        @endif
                    </dd>
                </div>
            </dl>

            @if ($application->cover_message)
                <div class="mt-6">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Cover Message</dt>
                    <dd class="mt-2 whitespace-pre-line rounded-lg bg-navy-50/60 p-4 text-navy-700">{{ $application->cover_message }}</dd>
                </div>
            @endif

            <a href="{{ asset('storage/'.$application->cv_path) }}" target="_blank" class="btn-primary mt-8">
                <x-icon name="document-text" class="h-4 w-4" /> View / Download CV
            </a>
        </div>

        <div class="space-y-6">
            <div class="rounded-xl border border-navy-100 bg-white p-6">
                <h3 class="text-sm font-semibold text-navy-900">Update Status</h3>
                <form method="POST" action="{{ route('admin.applications.update', $application) }}" class="mt-4 space-y-4">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full rounded-md border-navy-200 text-navy-900 shadow-sm focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)]">
                        @foreach (['new', 'reviewed', 'shortlisted', 'rejected', 'hired'] as $option)
                            <option value="{{ $option }}" @selected($application->status === $option)>{{ ucfirst($option) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary w-full">Save Status</button>
                </form>
            </div>

            <form method="POST" action="{{ route('admin.applications.destroy', $application) }}" data-confirm="Delete this application?">
                @csrf @method('DELETE')
                <button type="submit" class="w-full rounded-md border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50">Delete Application</button>
            </form>
        </div>
    </div>

</x-layouts.admin>
