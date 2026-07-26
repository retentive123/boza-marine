<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\HomeHighlight;
use Illuminate\Http\Request;

class HomeHighlightController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.home-highlights.index', [
            'highlights' => HomeHighlight::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.home-highlights.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request->file('image'), 'highlights');
        }

        HomeHighlight::create($validated);

        return redirect()->route('admin.home-highlights.index')->with('success', 'Highlight created.');
    }

    public function edit(HomeHighlight $homeHighlight)
    {
        return view('admin.home-highlights.edit', ['highlight' => $homeHighlight]);
    }

    public function update(Request $request, HomeHighlight $homeHighlight)
    {
        $validated = $this->validated($request);
        unset($validated['image']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image_path'] = $this->replaceImage($request->file('image'), 'highlights', $homeHighlight->image_path);

        $homeHighlight->update($validated);

        return redirect()->route('admin.home-highlights.index')->with('success', 'Highlight updated.');
    }

    public function destroy(HomeHighlight $homeHighlight)
    {
        $this->deleteImage($homeHighlight->image_path);
        $homeHighlight->delete();

        return redirect()->route('admin.home-highlights.index')->with('success', 'Highlight deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:50'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'order' => ['nullable', 'integer'],
        ]);
    }
}
