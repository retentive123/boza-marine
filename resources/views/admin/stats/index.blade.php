<x-layouts.admin title="Stats">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Manage the stat counters shown on Home and About.</p>
        <a href="{{ route('admin.stats.create') }}" class="btn-primary">+ New Stat</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Label</th>
                    <th class="px-5 py-3">Value</th>
                    <th class="px-5 py-3">Suffix</th>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($stats as $stat)
                    <tr>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $stat->label }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $stat->value }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $stat->suffix }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $stat->order }}</td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.stats.edit', $stat) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.stats.destroy', $stat) }}" data-confirm="Delete this stat?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-navy-400">None yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
