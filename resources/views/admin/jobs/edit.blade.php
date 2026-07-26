<x-layouts.admin title="Edit Job Posting">

    <a href="{{ route('admin.jobs.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Job Postings
    </a>

    <form method="POST" action="{{ route('admin.jobs.update', $job) }}" class="mt-6 max-w-3xl rounded-xl border border-navy-100 bg-white p-8">
        @csrf
        @method('PUT')
        @include('admin.jobs._form')

        <button type="submit" class="btn-primary mt-8">Save Changes</button>
    </form>

</x-layouts.admin>
