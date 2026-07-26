<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\SiteSetting;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery', [
            'settings' => SiteSetting::current(),
            'images' => GalleryImage::where('is_active', true)->orderBy('order')->get(),
        ]);
    }
}
