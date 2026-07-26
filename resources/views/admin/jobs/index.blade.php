<x-layouts.admin title="Job Postings">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Manage openings shown on the Careers page.</p>
        <a href="{{ route('admin.jobs.create') }}" class="btn-primary">+ New Job Posting</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Title</th>
                    <th class="px-5 py-3">Sector</th>
                    <th class="px-5 py-3">Applications</th>
                    <th class="px-5 py-3">Closes</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($jobs as $job)
                    <tr>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $job->title }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $job->sector }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $job->applications_count }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ optional($job->closing_date)->format('d M Y') ?? '—' }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $job->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                                {{ $job->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('careers.show', $job) }}" target="_blank" class="text-navy-400 hover:text-[var(--color-primary)]">View</a>
                                <a href="{{ route('admin.jobs.edit', $job) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}" data-confirm="Delete this job posting?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-8 text-center text-navy-400">No job postings yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
