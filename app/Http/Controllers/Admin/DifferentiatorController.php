<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Differentiator;
use Illuminate\Http\Request;

class DifferentiatorController extends Controller
{
    public function index()
    {
        return view('admin.differentiators.index', [
            'differentiators' => Differentiator::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.differentiators.create');
    }

    public function store(Request $request)
    {
        Differentiator::create($this->validated($request));

        return redirect()->route('admin.differentiators.index')->with('success', 'Differentiator created.');
    }

    public function edit(Differentiator $differentiator)
    {
        return view('admin.differentiators.edit', ['differentiator' => $differentiator]);
    }

    public function update(Request $request, Differentiator $differentiator)
    {
        $differentiator->update($this->validated($request));

        return redirect()->route('admin.differentiators.index')->with('success', 'Differentiator updated.');
    }

    public function destroy(Differentiator $differentiator)
    {
        $differentiator->delete();

        return redirect()->route('admin.differentiators.index')->with('success', 'Differentiator deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'order' => ['nullable', 'integer'],
        ]);
    }
}
