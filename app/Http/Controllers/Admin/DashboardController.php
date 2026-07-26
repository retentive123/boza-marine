<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'serviceCount' => Service::count(),
            'activeJobCount' => JobPosting::where('is_active', true)->count(),
            'newApplicationCount' => JobApplication::where('status', 'new')->count(),
            'unreadMessageCount' => ContactMessage::where('is_read', false)->count(),
            'recentApplications' => JobApplication::with('jobPosting')->latest()->take(5)->get(),
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
