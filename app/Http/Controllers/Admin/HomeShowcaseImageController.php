<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\HomeShowcaseImage;
use Illuminate\Http\Request;

class HomeShowcaseImageController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.home-showcase.index', [
            'images' => HomeShowcaseImage::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.home-showcase.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
        ]);

        HomeShowcaseImage::create([
            'image_path' => $this->storeImage($request->file('image'), 'showcase'),
            'caption' => $validated['caption'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.home-showcase.index')->with('success', 'Image added.');
    }

    public function edit(HomeShowcaseImage $homeShowcase)
    {
        return view('admin.home-showcase.edit', ['image' => $homeShowcase]);
    }

    public function update(Request $request, HomeShowcaseImage $homeShowcase)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
        ]);

        $homeShowcase->update([
            'image_path' => $this->replaceImage($request->file('image'), 'showcase', $homeShowcase->image_path),
            'caption' => $validated['caption'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.home-showcase.index')->with('success', 'Image updated.');
    }

    public function destroy(HomeShowcaseImage $homeShowcase)
    {
        $this->deleteImage($homeShowcase->image_path);
        $homeShowcase->delete();

        return redirect()->route('admin.home-showcase.index')->with('success', 'Image deleted.');
    }
}
