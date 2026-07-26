<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        return view('admin.stats.index', [
            'stats' => Stat::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.stats.create');
    }

    public function store(Request $request)
    {
        Stat::create($this->validated($request));

        return redirect()->route('admin.stats.index')->with('success', 'Stat created.');
    }

    public function edit(Stat $stat)
    {
        return view('admin.stats.edit', ['stat' => $stat]);
    }

    public function update(Request $request, Stat $stat)
    {
        $stat->update($this->validated($request));

        return redirect()->route('admin.stats.index')->with('success', 'Stat updated.');
    }

    public function destroy(Stat $stat)
    {
        $stat->delete();

        return redirect()->route('admin.stats.index')->with('success', 'Stat deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:50'],
            'suffix' => ['nullable', 'string', 'max:20'],
            'order' => ['nullable', 'integer'],
        ]);
    }
}
