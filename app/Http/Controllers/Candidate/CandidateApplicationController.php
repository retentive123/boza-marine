<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CandidateApplicationController extends Controller
{
    public function index(): View
    {
        $candidate = Auth::guard('candidate')->user();

        return view('candidate.applications.index', [
            'settings' => SiteSetting::current(),
            'candidate' => $candidate,
            'applications' => $candidate->applications()->with('jobPosting')->latest()->get(),
        ]);
    }
}
