<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.clients.index', [
            'clients' => Client::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        unset($validated['logo'], $validated['remove_logo']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $this->storeImage($request->file('logo'), 'clients');
        }

        Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Company added.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', ['client' => $client]);
    }

    public function update(Request $request, Client $client)
    {
        $validated = $this->validated($request);
        unset($validated['logo'], $validated['remove_logo']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->boolean('remove_logo')) {
            $this->deleteImage($client->logo_path);
            $validated['logo_path'] = null;
        } else {
            $validated['logo_path'] = $this->replaceImage($request->file('logo'), 'clients', $client->logo_path);
        }

        $client->update($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Company updated.');
    }

    public function destroy(Client $client)
    {
        $this->deleteImage($client->logo_path);
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Company removed.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ]);
    }
}
