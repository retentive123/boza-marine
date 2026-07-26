<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\NewsPost;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->string('q'));
        $results = collect();

        if ($query !== '') {
            $like = '%'.str_replace(['%', '_'], ['\%', '\_'], $query).'%';

            $services = Service::where('is_active', true)
                ->where(fn ($q) => $q->where('title', 'like', $like)
                    ->orWhere('summary', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhere('category', 'like', $like))
                ->orderBy('order')
                ->get()
                ->map(fn ($s) => [
                    'type' => 'Service',
                    'icon' => 'ship',
                    'title' => $s->title,
                    'excerpt' => $s->summary,
                    'url' => route('services.show', $s),
                ]);

            $jobs = JobPosting::where('is_active', true)
                ->where(fn ($q) => $q->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhere('sector', 'like', $like)
                    ->orWhere('location', 'like', $like))
                ->latest()
                ->get()
                ->map(fn ($j) => [
                    'type' => 'Career',
                    'icon' => 'briefcase',
                    'title' => $j->title,
                    'excerpt' => trim(($j->sector ? $j->sector.' · ' : '').($j->location ?? '')),
                    'url' => route('careers.show', $j),
                ]);

            $news = NewsPost::where('is_published', true)
                ->where(fn ($q) => $q->where('title', 'like', $like)
                    ->orWhere('excerpt', 'like', $like)
                    ->orWhere('body', 'like', $like)
                    ->orWhere('category', 'like', $like))
                ->orderByDesc('published_at')
                ->get()
                ->map(fn ($n) => [
                    'type' => 'News',
                    'icon' => 'document-text',
                    'title' => $n->title,
                    'excerpt' => $n->excerpt,
                    'url' => route('news.show', $n),
                ]);

            $results = $services->concat($jobs)->concat($news);
        }

        return view('search', [
            'settings' => SiteSetting::current(),
            'query' => $query,
            'results' => $results,
        ]);
    }
}
