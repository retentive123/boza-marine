<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsPostController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.news.index', [
            'posts' => NewsPost::latest('published_at')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        unset($validated['image'], $validated['remove_image']);
        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['published_at'] ?? now()->toDateString();

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request->file('image'), 'news');
        }

        NewsPost::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News post created.');
    }

    public function edit(NewsPost $newsPost)
    {
        return view('admin.news.edit', ['post' => $newsPost]);
    }

    public function update(Request $request, NewsPost $newsPost)
    {
        $validated = $this->validated($request);
        unset($validated['image'], $validated['remove_image']);

        if ($validated['title'] !== $newsPost->title) {
            $validated['slug'] = $this->uniqueSlug($validated['title'], $newsPost->id);
        }

        $validated['is_published'] = $request->boolean('is_published');

        if ($request->boolean('remove_image')) {
            $this->deleteImage($newsPost->image_path);
            $validated['image_path'] = null;
        } else {
            $validated['image_path'] = $this->replaceImage($request->file('image'), 'news', $newsPost->image_path);
        }

        $newsPost->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News post updated.');
    }

    public function destroy(NewsPost $newsPost)
    {
        $this->deleteImage($newsPost->image_path);
        $newsPost->delete();

        return redirect()->route('admin.news.index')->with('success', 'News post deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['required', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);
    }

    protected function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (NewsPost::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
