<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.testimonials.index', [
            'testimonials' => Testimonial::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        unset($validated['photo'], $validated['remove_photo']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $this->storeImage($request->file('photo'), 'testimonials');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', ['testimonial' => $testimonial]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $this->validated($request);
        unset($validated['photo'], $validated['remove_photo']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->boolean('remove_photo')) {
            $this->deleteImage($testimonial->photo_path);
            $validated['photo_path'] = null;
        } else {
            $validated['photo_path'] = $this->replaceImage($request->file('photo'), 'testimonials', $testimonial->photo_path);
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deleteImage($testimonial->photo_path);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'quote' => ['required', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'remove_photo' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ]);
    }
}
