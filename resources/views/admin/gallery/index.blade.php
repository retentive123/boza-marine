<x-layouts.admin title="Gallery">

    <div class="flex items-center justify-between">
        <p class="text-sm text-navy-500">Photos shown on the public Gallery page and homepage preview strip.</p>
        <a href="{{ route('admin.gallery.create') }}" class="btn-primary shrink-0">+ Add Image</a>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @forelse ($images as $image)
            <div class="group relative overflow-hidden rounded-xl border border-navy-100 bg-white">
                <img src="{{ asset('storage/'.$image->image_path) }}" class="h-40 w-full object-cover">
                <div class="p-3">
                    <p class="truncate text-sm font-medium text-navy-900">{{ $image->caption ?: 'Untitled' }}</p>
                    <p class="text-xs text-navy-400">{{ $image->category ?: 'Uncategorized' }}</p>
                    <span class="mt-1 inline-block rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $image->is_active ? 'bg-brand-primary-soft text-[var(--color-primary)]' : 'bg-navy-100 text-navy-500' }}">
                        {{ $image->is_active ? 'Visible' : 'Hidden' }}
                    </span>
                </div>
                <div class="absolute inset-x-0 top-0 flex justify-end gap-2 bg-gradient-to-b from-black/50 to-transparent p-2 opacity-0 transition group-hover:opacity-100">
                    <a href="{{ route('admin.gallery.edit', $image) }}" class="rounded-md bg-white/90 px-2 py-1 text-xs font-semibold text-navy-800">Edit</a>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" data-confirm="Delete this image?">
                        @csrf @method('DELETE')
                        <button type="submit" class="rounded-md bg-white/90 px-2 py-1 text-xs font-semibold text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-navy-200 p-12 text-center text-navy-400">
                No images yet. Add your first photo to populate the Gallery page and homepage.
            </div>
        @endforelse
    </div>

</x-layouts.admin>
