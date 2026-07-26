<x-layouts.admin title="Applications">

    <div class="flex flex-wrap items-center gap-3">
        @foreach (['' => 'All', 'new' => 'New', 'reviewed' => 'Reviewed', 'shortlisted' => 'Shortlisted', 'rejected' => 'Rejected', 'hired' => 'Hired'] as $value => $label)
            <a href="{{ route('admin.applications.index', array_filter(['status' => $value])) }}"
               class="rounded-full px-4 py-1.5 text-sm font-semibold {{ $status === $value ? 'bg-[var(--color-primary)] text-white' : 'bg-navy-50 text-navy-600 hover:bg-navy-100' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Applicant</th>
                    <th class="px-5 py-3">Position</th>
                    <th class="px-5 py-3">Applied</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($applications as $application)
                    <tr>
                        <td class="px-5 py-4">
                            <p class="font-medium text-navy-900">{{ $application->full_name }}</p>
                            <p class="text-xs text-navy-500">{{ $application->email }}</p>
                        </td>
                        <td class="px-5 py-4 text-navy-600">{{ $application->position_applied_for ?: optional($application->jobPosting)->title ?: 'General' }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $application->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full bg-navy-100 px-2.5 py-1 text-xs font-semibold capitalize text-navy-600">{{ $application->status }}</span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.applications.show', $application) }}" class="admin-link">Review</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-navy-400">No applications found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
