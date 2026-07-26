<x-layouts.admin title="Messages">

    <div class="overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">From</th>
                    <th class="px-5 py-3">Subject</th>
                    <th class="px-5 py-3">Received</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($messages as $message)
                    <tr @unless($message->is_read) style="background-color: color-mix(in srgb, var(--color-accent) 8%, white)" @endunless>
                        <td class="px-5 py-4">
                            <p class="font-medium text-navy-900">{{ $message->name }}</p>
                            <p class="text-xs text-navy-500">{{ $message->email }}</p>
                        </td>
                        <td class="px-5 py-4 text-navy-600">{{ $message->subject ?: 'No subject' }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $message->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-4">
                            @if ($message->is_read)
                                <span class="rounded-full bg-navy-100 px-2.5 py-1 text-xs font-semibold text-navy-500">Read</span>
                            @else
                                <span class="rounded-full bg-brand-accent-soft px-2.5 py-1 text-xs font-semibold text-[var(--color-accent)]">Unread</span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.messages.show', $message) }}" class="admin-link">Read</a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="Delete this message?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-navy-400">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
