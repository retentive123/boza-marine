<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPostingController extends Controller
{
    public function index()
    {
        return view('admin.jobs.index', [
            'jobs' => JobPosting::withCount('applications')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active');

        JobPosting::create($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job posting created.');
    }

    public function edit(JobPosting $job)
    {
        return view('admin.jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, JobPosting $job)
    {
        $validated = $this->validated($request);

        if ($validated['title'] !== $job->title) {
            $validated['slug'] = $this->uniqueSlug($validated['title'], $job->id);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $job->update($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job posting updated.');
    }

    public function destroy(JobPosting $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job posting deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'sector' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'max:255'],
            'vessel_type' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'closing_date' => ['nullable', 'date'],
        ]);
    }

    protected function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (JobPosting::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
