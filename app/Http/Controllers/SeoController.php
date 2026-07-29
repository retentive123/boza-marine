<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\NewsPost;
use App\Models\Service;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            'Disallow: /dashboard',
            'Disallow: /profile',
            'Disallow: /careers/apply',
            'Disallow: /careers/my-applications',
            'Disallow: /careers/login',
            'Disallow: /careers/register',
            '',
            'Sitemap: '.url('/sitemap.xml'),
        ];

        return response(implode("\n", $lines), 200)->header('Content-Type', 'text/plain');
    }

    public function sitemap(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.8'],
            ['loc' => route('leadership'), 'priority' => '0.6'],
            ['loc' => route('services.index'), 'priority' => '0.9'],
            ['loc' => route('gallery'), 'priority' => '0.5'],
            ['loc' => route('news.index'), 'priority' => '0.7'],
            ['loc' => route('careers.index'), 'priority' => '0.8'],
            ['loc' => route('contact'), 'priority' => '0.6'],
        ]);

        Service::where('is_active', true)->get()->each(function (Service $service) use ($urls) {
            $urls->push(['loc' => route('services.show', $service), 'priority' => '0.7']);
        });

        JobPosting::where('is_active', true)->get()->each(function (JobPosting $job) use ($urls) {
            $urls->push(['loc' => route('careers.show', $job), 'lastmod' => $job->updated_at, 'priority' => '0.7']);
        });

        NewsPost::where('is_published', true)->get()->each(function (NewsPost $post) use ($urls) {
            $urls->push(['loc' => route('news.show', $post), 'lastmod' => $post->updated_at, 'priority' => '0.6']);
        });

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'text/xml');
    }
}
