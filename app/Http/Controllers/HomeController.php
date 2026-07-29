<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Differentiator;
use App\Models\GalleryImage;
use App\Models\HeroBackgroundImage;
use App\Models\HeroSlide;
use App\Models\HomeHighlight;
use App\Models\HomeShowcaseImage;
use App\Models\JobPosting;
use App\Models\NewsPost;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Stat;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'settings' => SiteSetting::current(),
            'heroSlides' => HeroSlide::where('is_active', true)->orderBy('order')->get(),
            'heroBackgroundImages' => HeroBackgroundImage::where('is_active', true)->orderBy('order')->get(),
            'services' => Service::where('is_active', true)->orderBy('order')->orderBy('id')->take(3)->get(),
            'differentiators' => Differentiator::orderBy('order')->get(),
            'stats' => Stat::orderBy('order')->get(),
            'testimonials' => Testimonial::where('is_active', true)->orderBy('order')->get(),
            'jobs' => JobPosting::where('is_active', true)->latest()->take(3)->get(),
            'galleryPreview' => GalleryImage::where('is_active', true)->orderBy('order')->take(6)->get(),
            'newsPosts' => NewsPost::where('is_published', true)->orderByDesc('published_at')->take(3)->get(),
            'highlights' => HomeHighlight::where('is_active', true)->orderBy('order')->get(),
            'showcaseImages' => HomeShowcaseImage::where('is_active', true)->orderBy('order')->get(),
            'clients' => Client::where('is_active', true)->orderBy('order')->get(),
        ]);
    }
}
