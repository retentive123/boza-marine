<x-layouts.admin title="New Hero Slide">

    <a href="{{ route('admin.hero-slides.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Hero Slides
    </a>

    <form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data" class="mt-6 max-w-3xl rounded-xl border border-navy-100 bg-white p-8">
        @csrf
        @include('admin.hero-slides._form')

        <button type="submit" class="btn-primary mt-8">Create Slide</button>
    </form>

</x-layouts.admin>
