<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobPosting::where('is_active', true)
            ->when($request->filled('sector'), fn ($q) => $q->where('sector', $request->string('sector')))
            ->latest()
            ->get();

        return view('careers.index', [
            'settings' => SiteSetting::current(),
            'jobs' => $jobs,
            'sector' => $request->string('sector')->toString(),
        ]);
    }

    public function show(JobPosting $jobPosting)
    {
        abort_unless($jobPosting->is_active, 404);

        return view('careers.show', [
            'settings' => SiteSetting::current(),
            'job' => $jobPosting,
        ]);
    }
}
