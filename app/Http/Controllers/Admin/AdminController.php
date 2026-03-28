<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with('roles')->latest()->get();

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:30'],
            'is_active' => ['nullable', 'boolean'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['integer', 'exists:roles,id'],
        ]);

        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone' => $validated['phone'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $admin->roles()->sync($validated['roles'] ?? []);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
    }

    public function show(Admin $admin)
    {
        return redirect()->route('admin.admins.edit', $admin);
    }

    public function edit(Admin $admin)
    {
        $roles = Role::orderBy('name')->get();
        $admin->load('roles');

        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($admin->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:30'],
            'is_active' => ['nullable', 'boolean'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['integer', 'exists:roles,id'],
        ]);

        $admin->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        if (!empty($validated['password'])) {
            $admin->password = $validated['password'];
        }

        $admin->save();
        $admin->roles()->sync($validated['roles'] ?? []);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }
}
