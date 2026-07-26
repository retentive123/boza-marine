<x-layouts.admin title="Services">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Manage the service lines shown on the public site.</p>
        <a href="{{ route('admin.services.create') }}" class="btn-primary">+ New Service</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Service</th>
                    <th class="px-5 py-3">Category</th>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($services as $service)
                    <tr>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $service->title }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $service->category }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $service->order }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $service->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                                {{ $service->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('services.show', $service) }}" target="_blank" class="text-navy-400 hover:text-[var(--color-primary)]">View</a>
                                <a href="{{ route('admin.services.edit', $service) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" data-confirm="Delete this service?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-navy-400">No services yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
