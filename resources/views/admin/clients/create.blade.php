<x-layouts.admin title="Add Company">

    <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-navy-500 hover:text-navy-700">
        <x-icon name="chevron-right" class="h-4 w-4 rotate-180" /> Back to Companies
    </a>

    <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data" class="mt-6 max-w-xl rounded-xl border border-navy-100 bg-white p-8">
        @csrf
        @include('admin.clients._form')

        <button type="submit" class="btn-primary mt-8">Add Company</button>
    </form>

</x-layouts.admin>
