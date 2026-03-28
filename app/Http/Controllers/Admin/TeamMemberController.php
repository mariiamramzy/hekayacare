<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamDepartment;
use App\Models\TeamMember;
use App\Support\MediaUploader;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::with(['departments', 'photoMedia'])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.team-members.index', compact('teamMembers'));
    }

    public function create()
    {
        $departments = TeamDepartment::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.team-members.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'specialty_ar' => ['nullable', 'string', 'max:255'],
            'bio_ar' => ['nullable', 'string'],
            'photo_image' => ['nullable', 'image', 'max:5120'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'departments' => ['nullable', 'array'],
            'departments.*' => ['integer', 'exists:team_departments,id'],
        ]);

        $photoMediaId = null;
        if ($request->hasFile('photo_image')) {
            $photoMediaId = MediaUploader::uploadImage($request->file('photo_image'), 'team-members');
        }

        $member = TeamMember::create([
            'name_ar' => $validated['name_ar'],
            'title_ar' => $validated['title_ar'] ?? null,
            'specialty_ar' => $validated['specialty_ar'] ?? null,
            'bio_ar' => $validated['bio_ar'] ?? null,
            'photo_media_id' => $photoMediaId,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $member->departments()->sync($validated['departments'] ?? []);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member created successfully.');
    }

    public function show(TeamMember $teamMember)
    {
        return redirect()->route('admin.team-members.edit', $teamMember);
    }

    public function edit(TeamMember $teamMember)
    {
        $departments = TeamDepartment::orderBy('sort_order')->orderBy('id')->get();
        $teamMember->load('departments');

        return view('admin.team-members.edit', compact('teamMember', 'departments'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'specialty_ar' => ['nullable', 'string', 'max:255'],
            'bio_ar' => ['nullable', 'string'],
            'photo_image' => ['nullable', 'image', 'max:5120'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'departments' => ['nullable', 'array'],
            'departments.*' => ['integer', 'exists:team_departments,id'],
        ]);

        $photoMediaId = $teamMember->photo_media_id;
        if ($request->hasFile('photo_image')) {
            $photoMediaId = MediaUploader::uploadImage($request->file('photo_image'), 'team-members');
        }

        $teamMember->update([
            'name_ar' => $validated['name_ar'],
            'title_ar' => $validated['title_ar'] ?? null,
            'specialty_ar' => $validated['specialty_ar'] ?? null,
            'bio_ar' => $validated['bio_ar'] ?? null,
            'photo_media_id' => $photoMediaId,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        $teamMember->departments()->sync($validated['departments'] ?? []);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('admin.team-members.index')->with('success', 'Team member deleted successfully.');
    }
}
