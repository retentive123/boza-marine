<x-layouts.admin title="Staff Users">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Accounts with access to this admin panel.</p>
        <a href="{{ route('admin.users.create') }}" class="btn-primary shrink-0">+ Add Staff User</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3">Added</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-5 py-4 font-medium text-navy-900">
                            {{ $user->name }}
                            @if ($user->id === auth()->id())
                                <span class="ml-1.5 rounded-full bg-brand-primary-soft px-2 py-0.5 text-[11px] font-semibold text-[var(--color-primary)]">You</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-navy-600">{{ $user->email }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="admin-link">Edit</a>
                                @if ($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" data-confirm="Remove this staff user? They will lose access immediately.">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-navy-400">No staff users yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
