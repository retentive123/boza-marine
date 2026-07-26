<x-layouts.admin title="Edit Hero Photo">

    <a href="{{ route('admin.hero-background.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Default Hero Photos
    </a>

    <form method="POST" action="{{ route('admin.hero-background.update', $image) }}" enctype="multipart/form-data" class="mt-6 max-w-2xl rounded-xl border border-navy-100 bg-white p-8">
        @csrf
        @method('PUT')
        @include('admin.hero-background._form')

        <button type="submit" class="btn-primary mt-8">Save Changes</button>
    </form>

</x-layouts.admin>
