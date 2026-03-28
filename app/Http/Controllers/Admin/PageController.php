<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::withCount('sections')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:pages,slug'],
            'title_ar' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        Page::create([
            'slug' => $validated['slug'],
            'title_ar' => $validated['title_ar'],
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function show(Page $page)
    {
        return redirect()->route('admin.pages.edit', $page);
    }

    public function edit(Page $page)
    {
        $page->load(['sections' => fn ($query) => $query->withCount('items')]);

        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('pages', 'slug')->ignore($page->id)],
            'title_ar' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $page->update([
            'slug' => $validated['slug'],
            'title_ar' => $validated['title_ar'],
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
