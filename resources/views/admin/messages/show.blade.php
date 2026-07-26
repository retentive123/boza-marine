<x-layouts.admin title="Message Detail">

    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Messages
    </a>

    <div class="mt-6 max-w-2xl rounded-xl border border-navy-100 bg-white p-8">
        <h2 class="text-xl font-semibold text-navy-900">{{ $message->subject ?: 'No subject' }}</h2>
        <p class="mt-1 text-sm text-navy-500">{{ $message->created_at->format('d M Y, g:i a') }}</p>

        <dl class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Name</dt>
                <dd class="mt-1 text-navy-800">{{ $message->name }}</dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Email</dt>
                <dd class="mt-1 text-navy-800"><a href="mailto:{{ $message->email }}" class="hover:text-[var(--color-primary)]">{{ $message->email }}</a></dd>
            </div>
            @if ($message->phone)
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Phone</dt>
                    <dd class="mt-1 text-navy-800">{{ $message->phone }}</dd>
                </div>
            @endif
        </dl>

        <div class="mt-6">
            <dt class="text-xs font-semibold uppercase tracking-wider text-navy-400">Message</dt>
            <dd class="mt-2 whitespace-pre-line rounded-lg bg-navy-50/60 p-4 text-navy-700">{{ $message->message }}</dd>
        </div>

        <div class="mt-8 flex gap-3">
            <a href="mailto:{{ $message->email }}" class="btn-primary">Reply by Email</a>
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="Delete this message?">
                @csrf @method('DELETE')
                <button type="submit" class="rounded-md border border-red-200 px-5 py-3 text-sm font-semibold text-red-600 hover:bg-red-50">Delete</button>
            </form>
        </div>
    </div>

</x-layouts.admin>
