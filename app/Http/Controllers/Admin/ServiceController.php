<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.services.index', [
            'services' => Service::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        unset($validated['image'], $validated['remove_image']);
        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['deliverables'] = $this->deliverablesFromInput($request->input('deliverables', ''));
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request->file('image'), 'services');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validated($request);
        unset($validated['image'], $validated['remove_image']);

        if ($validated['title'] !== $service->title) {
            $validated['slug'] = $this->uniqueSlug($validated['title'], $service->id);
        }

        $validated['deliverables'] = $this->deliverablesFromInput($request->input('deliverables', ''));
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->boolean('remove_image')) {
            $this->deleteImage($service->image_path);
            $validated['image_path'] = null;
        } else {
            $validated['image_path'] = $this->replaceImage($request->file('image'), 'services', $service->image_path);
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $this->deleteImage($service->image_path);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'summary' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'order' => ['nullable', 'integer'],
        ]);
    }

    protected function deliverablesFromInput(string $input): array
    {
        return collect(explode("\n", $input))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    protected function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (Service::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
