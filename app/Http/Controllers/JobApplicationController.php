<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function create(Request $request)
    {
        $jobPosting = null;

        if ($request->filled('job')) {
            $jobPosting = JobPosting::where('slug', $request->string('job'))->where('is_active', true)->first();
        }

        return view('careers.apply', [
            'settings' => SiteSetting::current(),
            'jobPosting' => $jobPosting,
            'jobs' => JobPosting::where('is_active', true)->orderBy('title')->get(),
            'candidate' => Auth::guard('candidate')->user(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_posting_id' => ['nullable', 'exists:job_postings,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'position_applied_for' => ['nullable', 'string', 'max:255'],
            'cover_message' => ['nullable', 'string', 'max:5000'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        JobApplication::create([
            'job_posting_id' => $validated['job_posting_id'] ?? null,
            'candidate_id' => Auth::guard('candidate')->id(),
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'position_applied_for' => $validated['position_applied_for'] ?? null,
            'cover_message' => $validated['cover_message'] ?? null,
            'cv_path' => $cvPath,
            'status' => 'new',
        ]);

        return redirect()
            ->route('candidate.applications.index')
            ->with('success', 'Thank you — your application has been received. Our recruitment team will be in touch if your profile matches an opening. You can track its status below.');
    }
}
