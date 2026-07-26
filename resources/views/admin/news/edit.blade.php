<x-layouts.admin title="Edit News Post">

    <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to News
    </a>

    <form method="POST" action="{{ route('admin.news.update', $post) }}" enctype="multipart/form-data" class="mt-6 max-w-3xl rounded-xl border border-navy-100 bg-white p-8">
        @csrf
        @method('PUT')
        @include('admin.news._form')

        <button type="submit" class="btn-primary mt-8">Save Changes</button>
    </form>

</x-layouts.admin>
