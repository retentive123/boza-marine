<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index', [
            'settings' => SiteSetting::current(),
            'services' => Service::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        return view('services.show', [
            'settings' => SiteSetting::current(),
            'service' => $service,
            'otherServices' => Service::where('is_active', true)
                ->where('id', '!=', $service->id)
                ->orderBy('order')
                ->take(4)
                ->get(),
        ]);
    }
}
