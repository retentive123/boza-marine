<x-layouts.admin title="Homepage Highlights">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Alternating image + text feature blocks shown on the homepage, between About and Services.</p>
        <a href="{{ route('admin.home-highlights.create') }}" class="btn-primary shrink-0">+ New Highlight</a>
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
                @forelse ($highlights as $highlight)
                    <tr>
                        <td class="px-5 py-3">
                            @if ($highlight->image_path)
                                <img src="{{ asset('storage/'.$highlight->image_path) }}" class="h-12 w-20 rounded-md object-cover">
                            @else
                                <div class="flex h-12 w-20 items-center justify-center rounded-md bg-navy-50">
                                    <x-icon name="image" class="h-5 w-5 text-navy-300" />
                                </div>
                            @endif
                        </td>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $highlight->title }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $highlight->order }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $highlight->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                                {{ $highlight->is_active ? 'Visible' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.home-highlights.edit', $highlight) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.home-highlights.destroy', $highlight) }}" data-confirm="Delete this highlight?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-navy-400">No highlights yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
