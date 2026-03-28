<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamDepartment;
use Illuminate\Http\Request;

class TeamDepartmentController extends Controller
{
    public function index()
    {
        $teamDepartments = TeamDepartment::withCount('members')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.team-departments.index', compact('teamDepartments'));
    }

    public function create()
    {
        return view('admin.team-departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        TeamDepartment::create([
            'name_ar' => $validated['name_ar'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.team-departments.index')->with('success', 'Department created successfully.');
    }

    public function show(TeamDepartment $teamDepartment)
    {
        return redirect()->route('admin.team-departments.edit', $teamDepartment);
    }

    public function edit(TeamDepartment $teamDepartment)
    {
        return view('admin.team-departments.edit', compact('teamDepartment'));
    }

    public function update(Request $request, TeamDepartment $teamDepartment)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $teamDepartment->update([
            'name_ar' => $validated['name_ar'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.team-departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(TeamDepartment $teamDepartment)
    {
        $teamDepartment->delete();

        return redirect()->route('admin.team-departments.index')->with('success', 'Department deleted successfully.');
    }
}
