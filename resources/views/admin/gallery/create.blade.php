<x-layouts.admin title="Add Gallery Image">

    <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Gallery
    </a>

    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="mt-6 max-w-2xl rounded-xl border border-navy-100 bg-white p-8">
        @csrf
        @include('admin.gallery._form')

        <button type="submit" class="btn-primary mt-8">Add Image</button>
    </form>

</x-layouts.admin>
