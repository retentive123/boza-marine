<x-layouts.admin title="Hero Slides">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Manage the rotating photo carousel shown at the top of the home page. Falls back to a graphic background when no slides are active.</p>
        <a href="{{ route('admin.hero-slides.create') }}" class="btn-primary shrink-0">+ New Slide</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Image</th>
                    <th class="px-5 py-3">Title</th>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($slides as $slide)
                    <tr>
                        <td class="px-5 py-3">
                            <img src="{{ asset('storage/'.$slide->image_path) }}" class="h-12 w-20 rounded-md object-cover">
                        </td>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $slide->title }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $slide->order }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $slide->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                                {{ $slide->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.hero-slides.destroy', $slide) }}" data-confirm="Delete this slide?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-navy-400">No hero slides yet — the homepage will show its default graphic hero until you add one.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
