<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.gallery.index', [
            'images' => GalleryImage::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
        ]);

        GalleryImage::create([
            'image_path' => $this->storeImage($request->file('image'), 'gallery'),
            'caption' => $validated['caption'] ?? null,
            'category' => $validated['category'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image added to gallery.');
    }

    public function edit(GalleryImage $galleryImage)
    {
        return view('admin.gallery.edit', ['image' => $galleryImage]);
    }

    public function update(Request $request, GalleryImage $galleryImage)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
        ]);

        $galleryImage->update([
            'image_path' => $this->replaceImage($request->file('image'), 'gallery', $galleryImage->image_path),
            'caption' => $validated['caption'] ?? null,
            'category' => $validated['category'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image updated.');
    }

    public function destroy(GalleryImage $galleryImage)
    {
        $this->deleteImage($galleryImage->image_path);
        $galleryImage->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted.');
    }
}
