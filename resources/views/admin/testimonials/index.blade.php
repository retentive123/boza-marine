<x-layouts.admin title="Testimonials">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Manage client quotes shown on the home page.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-primary">+ New Testimonial</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Role</th>
                    <th class="px-5 py-3">Quote</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($testimonials as $testimonial)
                    <tr>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $testimonial->name }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $testimonial->role }}</td>
                        <td class="px-5 py-4 max-w-sm truncate text-navy-600">{{ $testimonial->quote }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $testimonial->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                                {{ $testimonial->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" data-confirm="Delete this testimonial?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-navy-400">No testimonials yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
