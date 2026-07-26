<x-layouts.admin title="Differentiators">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Manage the "Why clients choose Boza" points shown on Home and About.</p>
        <a href="{{ route('admin.differentiators.create') }}" class="btn-primary">+ New Differentiator</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Title</th>
                    <th class="px-5 py-3">Description</th>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($differentiators as $item)
                    <tr>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $item->title }}</td>
                        <td class="px-5 py-4 max-w-md text-navy-600">{{ $item->description }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $item->order }}</td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.differentiators.edit', $item) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.differentiators.destroy', $item) }}" data-confirm="Delete this differentiator?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-navy-400">None yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
