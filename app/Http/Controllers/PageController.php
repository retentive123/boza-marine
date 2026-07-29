<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Differentiator;
use App\Models\SiteSetting;
use App\Models\Stat;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function about()
    {
        return view('about', [
            'settings' => SiteSetting::current(),
            'differentiators' => Differentiator::orderBy('order')->get(),
            'stats' => Stat::orderBy('order')->get(),
            'clients' => Client::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function leadership()
    {
        return view('leadership', [
            'settings' => SiteSetting::current(),
            'directors' => TeamMember::where('is_active', true)->where('category', 'Director')->orderBy('order')->get(),
            'management' => TeamMember::where('is_active', true)->where('category', 'Management')->orderBy('order')->get(),
        ]);
    }
}
