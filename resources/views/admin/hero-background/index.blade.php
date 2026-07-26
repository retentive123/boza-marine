<x-layouts.admin title="Default Hero Photos">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Photos that rotate behind the homepage's default hero headline (used when no Hero Slides are active). Add 2 or more to enable the carousel.</p>
        <a href="{{ route('admin.hero-background.create') }}" class="btn-primary shrink-0">+ Add Photo</a>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @forelse ($images as $image)
            <div class="group relative overflow-hidden rounded-xl border border-navy-100 bg-white">
                <img src="{{ asset('storage/'.$image->image_path) }}" class="h-40 w-full object-cover">
                <div class="p-3">
                    <p class="text-sm font-medium text-navy-900">Order {{ $image->order }}</p>
                    <span class="mt-1 inline-block rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $image->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                        {{ $image->is_active ? 'Visible' : 'Hidden' }}
                    </span>
                </div>
                <div class="absolute inset-x-0 top-0 flex justify-end gap-2 bg-gradient-to-b from-black/50 to-transparent p-2 opacity-0 transition group-hover:opacity-100">
                    <a href="{{ route('admin.hero-background.edit', $image) }}" class="rounded-md bg-white/90 px-2 py-1 text-xs font-semibold text-navy-800">Edit</a>
                    <form method="POST" action="{{ route('admin.hero-background.destroy', $image) }}" data-confirm="Delete this photo?">
                        @csrf @method('DELETE')
                        <button type="submit" class="rounded-md bg-white/90 px-2 py-1 text-xs font-semibold text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-navy-200 p-12 text-center text-navy-400">
                No photos yet. The homepage hero will use a plain color background until you add one.
            </div>
        @endforelse
    </div>

</x-layouts.admin>
