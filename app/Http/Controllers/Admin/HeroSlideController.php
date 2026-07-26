<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.hero-slides.index', [
            'slides' => HeroSlide::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        unset($validated['image']);
        $validated['image_path'] = $this->storeImage($request->file('image'), 'hero-slides');
        $validated['is_active'] = $request->boolean('is_active');

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', ['slide' => $heroSlide]);
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $this->validated($request, false);
        unset($validated['image']);
        $validated['image_path'] = $this->replaceImage($request->file('image'), 'hero-slides', $heroSlide->image_path);
        $validated['is_active'] = $request->boolean('is_active');

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $this->deleteImage($heroSlide->image_path);
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide deleted.');
    }

    protected function validated(Request $request, bool $imageRequired = true): array
    {
        return $request->validate([
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:4096'],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
        ]);
    }
}
