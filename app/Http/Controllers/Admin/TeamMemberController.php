<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        return view('admin.team.index', [
            'members' => TeamMember::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        unset($validated['photo'], $validated['remove_photo']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $this->storeImage($request->file('photo'), 'team');
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member added.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', ['member' => $teamMember]);
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $this->validated($request);
        unset($validated['photo'], $validated['remove_photo']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->boolean('remove_photo')) {
            $this->deleteImage($teamMember->photo_path);
            $validated['photo_path'] = null;
        } else {
            $validated['photo_path'] = $this->replaceImage($request->file('photo'), 'team', $teamMember->photo_path);
        }

        $teamMember->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $this->deleteImage($teamMember->photo_path);
        $teamMember->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team member removed.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:Director,Management'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'remove_photo' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ]);
    }
}
