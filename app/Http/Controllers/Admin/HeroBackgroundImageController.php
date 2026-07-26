<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\HeroBackgroundImage;
use Illuminate\Http\Request;

class HeroBackgroundImageController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.hero-background.index', [
            'images' => HeroBackgroundImage::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.hero-background.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:4096'],
            'order' => ['nullable', 'integer'],
        ]);

        HeroBackgroundImage::create([
            'image_path' => $this->storeImage($request->file('image'), 'hero-background'),
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.hero-background.index')->with('success', 'Image added.');
    }

    public function edit(HeroBackgroundImage $heroBackground)
    {
        return view('admin.hero-background.edit', ['image' => $heroBackground]);
    }

    public function update(Request $request, HeroBackgroundImage $heroBackground)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:4096'],
            'order' => ['nullable', 'integer'],
        ]);

        $heroBackground->update([
            'image_path' => $this->replaceImage($request->file('image'), 'hero-background', $heroBackground->image_path),
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.hero-background.index')->with('success', 'Image updated.');
    }

    public function destroy(HeroBackgroundImage $heroBackground)
    {
        $this->deleteImage($heroBackground->image_path);
        $heroBackground->delete();

        return redirect()->route('admin.hero-background.index')->with('success', 'Image deleted.');
    }
}
