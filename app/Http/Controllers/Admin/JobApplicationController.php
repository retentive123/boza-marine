<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = JobApplication::with('jobPosting')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->latest()
            ->get();

        return view('admin.applications.index', [
            'applications' => $applications,
            'status' => $request->string('status')->toString(),
        ]);
    }

    public function show(JobApplication $application)
    {
        return view('admin.applications.show', ['application' => $application]);
    }

    public function update(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,reviewed,shortlisted,rejected,hired'],
        ]);

        $application->update($validated);

        return back()->with('success', 'Application status updated.');
    }

    public function destroy(JobApplication $application)
    {
        $application->delete();

        return redirect()->route('admin.applications.index')->with('success', 'Application deleted.');
    }
}
