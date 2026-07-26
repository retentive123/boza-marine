<x-layouts.admin title="News">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Manage announcements and articles shown on the public News page.</p>
        <a href="{{ route('admin.news.create') }}" class="btn-primary shrink-0">+ New Post</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Image</th>
                    <th class="px-5 py-3">Title</th>
                    <th class="px-5 py-3">Category</th>
                    <th class="px-5 py-3">Published</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($posts as $post)
                    <tr>
                        <td class="px-5 py-3">
                            @if ($post->image_path)
                                <img src="{{ asset('storage/'.$post->image_path) }}" class="h-12 w-20 rounded-md object-cover">
                            @else
                                <div class="flex h-12 w-20 items-center justify-center rounded-md bg-navy-50">
                                    <x-icon name="image" class="h-5 w-5 text-navy-300" />
                                </div>
                            @endif
                        </td>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $post->title }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $post->category ?: '—' }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ optional($post->published_at)->format('d M Y') ?? '—' }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $post->is_published ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                                {{ $post->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                @if ($post->is_published)
                                    <a href="{{ route('news.show', $post) }}" target="_blank" class="text-navy-400 hover:text-[var(--color-primary)]">View</a>
                                @endif
                                <a href="{{ route('admin.news.edit', $post) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.news.destroy', $post) }}" data-confirm="Delete this post?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-8 text-center text-navy-400">No news posts yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
