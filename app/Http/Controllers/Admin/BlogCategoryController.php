<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $blogCategories = BlogCategory::withCount('posts')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.blog-categories.index', compact('blogCategories'));
    }

    public function create()
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:blog_categories,slug'],
            'name_ar' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        BlogCategory::create([
            'slug' => $validated['slug'],
            'name_ar' => $validated['name_ar'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category created successfully.');
    }

    public function show(BlogCategory $blogCategory)
    {
        return redirect()->route('admin.blog-categories.edit', $blogCategory);
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('blog_categories', 'slug')->ignore($blogCategory->id)],
            'name_ar' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $blogCategory->update([
            'slug' => $validated['slug'],
            'name_ar' => $validated['name_ar'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category deleted successfully.');
    }
}
