<x-layouts.admin title="Dashboard">

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-navy-100 bg-white p-6">
            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                <x-icon name="ship" class="h-5 w-5" />
            </span>
            <p class="mt-4 text-2xl font-semibold text-navy-900">{{ $serviceCount }}</p>
            <p class="text-sm text-navy-500">Services Listed</p>
        </div>
        <div class="rounded-xl border border-navy-100 bg-white p-6">
            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand-primary-soft text-[var(--color-primary)]">
                <x-icon name="briefcase" class="h-5 w-5" />
            </span>
            <p class="mt-4 text-2xl font-semibold text-navy-900">{{ $activeJobCount }}</p>
            <p class="text-sm text-navy-500">Active Job Postings</p>
        </div>
        <div class="rounded-xl border border-navy-100 bg-white p-6">
            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand-accent-soft text-[var(--color-accent)]">
                <x-icon name="document-text" class="h-5 w-5" />
            </span>
            <p class="mt-4 text-2xl font-semibold text-navy-900">{{ $newApplicationCount }}</p>
            <p class="text-sm text-navy-500">New Applications</p>
        </div>
        <div class="rounded-xl border border-navy-100 bg-white p-6">
            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand-accent-soft text-[var(--color-accent)]">
                <x-icon name="mail" class="h-5 w-5" />
            </span>
            <p class="mt-4 text-2xl font-semibold text-navy-900">{{ $unreadMessageCount }}</p>
            <p class="text-sm text-navy-500">Unread Messages</p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-navy-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-navy-900">Recent Applications</h2>
                <a href="{{ route('admin.applications.index') }}" class="admin-link text-sm">View all</a>
            </div>
            <div class="mt-4 divide-y divide-navy-100">
                @forelse ($recentApplications as $application)
                    <a href="{{ route('admin.applications.show', $application) }}" class="flex items-center justify-between py-3 hover:opacity-75">
                        <div>
                            <p class="text-sm font-semibold text-navy-900">{{ $application->full_name }}</p>
                            <p class="text-xs text-navy-500">{{ $application->position_applied_for ?: optional($application->jobPosting)->title ?: 'General Application' }}</p>
                        </div>
                        <span class="rounded-full bg-navy-50 px-2.5 py-1 text-xs font-semibold capitalize text-navy-600">{{ $application->status }}</span>
                    </a>
                @empty
                    <p class="py-6 text-center text-sm text-navy-400">No applications yet.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-xl border border-navy-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-navy-900">Recent Messages</h2>
                <a href="{{ route('admin.messages.index') }}" class="admin-link text-sm">View all</a>
            </div>
            <div class="mt-4 divide-y divide-navy-100">
                @forelse ($recentMessages as $message)
                    <a href="{{ route('admin.messages.show', $message) }}" class="flex items-center justify-between py-3 hover:opacity-75">
                        <div>
                            <p class="text-sm font-semibold text-navy-900">{{ $message->name }}</p>
                            <p class="text-xs text-navy-500">{{ $message->subject ?: 'No subject' }}</p>
                        </div>
                        @unless ($message->is_read)
                            <span class="h-2 w-2 rounded-full bg-[var(--color-accent)]"></span>
                        @endunless
                    </a>
                @empty
                    <p class="py-6 text-center text-sm text-navy-400">No messages yet.</p>
                @endforelse
            </div>
        </div>
    </div>

</x-layouts.admin>
