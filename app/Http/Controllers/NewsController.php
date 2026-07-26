<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\SiteSetting;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'settings' => SiteSetting::current(),
            'posts' => NewsPost::where('is_published', true)
                ->orderByDesc('published_at')
                ->paginate(9),
        ]);
    }

    public function show(NewsPost $newsPost)
    {
        abort_unless($newsPost->is_published, 404);

        return view('news.show', [
            'settings' => SiteSetting::current(),
            'post' => $newsPost,
            'otherPosts' => NewsPost::where('is_published', true)
                ->where('id', '!=', $newsPost->id)
                ->orderByDesc('published_at')
                ->take(3)
                ->get(),
        ]);
    }
}
