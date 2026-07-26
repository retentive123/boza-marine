<x-layouts.admin title="Leadership Team">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Directors and management shown on the About Us page.</p>
        <a href="{{ route('admin.team.create') }}" class="btn-primary shrink-0">+ Add Team Member</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Photo</th>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Role</th>
                    <th class="px-5 py-3">Category</th>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($members as $member)
                    <tr>
                        <td class="px-5 py-3">
                            @if ($member->photo_path)
                                <img src="{{ asset('storage/'.$member->photo_path) }}" class="h-12 w-12 rounded-full object-cover">
                            @else
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-primary-soft text-sm font-semibold text-[var(--color-primary)]">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $member->name }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $member->role }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $member->category }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $member->order }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $member->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                                {{ $member->is_active ? 'Visible' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.team.edit', $member) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.team.destroy', $member) }}" data-confirm="Remove this team member?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-5 py-8 text-center text-navy-400">No team members yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
