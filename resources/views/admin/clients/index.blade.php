<x-layouts.admin title="Companies We've Worked For">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Shown as a trust strip on the Homepage and About page.</p>
        <a href="{{ route('admin.clients.create') }}" class="btn-primary shrink-0">+ Add Company</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-navy-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-navy-50 text-xs font-semibold uppercase tracking-wider text-navy-500">
                <tr>
                    <th class="px-5 py-3">Logo</th>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navy-100">
                @forelse ($clients as $client)
                    <tr>
                        <td class="px-5 py-3">
                            @if ($client->logo_path)
                                <img src="{{ asset('storage/'.$client->logo_path) }}" class="h-10 w-10 rounded-lg object-contain">
                            @else
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-brand-primary-soft text-[var(--color-primary)]">
                                    <x-icon name="building-office" class="h-5 w-5" />
                                </div>
                            @endif
                        </td>
                        <td class="px-5 py-4 font-medium text-navy-900">{{ $client->name }}</td>
                        <td class="px-5 py-4 text-navy-600">{{ $client->order }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $client->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                                {{ $client->is_active ? 'Visible' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.clients.edit', $client) }}" class="admin-link">Edit</a>
                                <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" data-confirm="Remove this company?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-navy-400">No companies added yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.admin>
