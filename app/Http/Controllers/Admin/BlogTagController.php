<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogTagController extends Controller
{
    public function index()
    {
        $blogTags = BlogTag::withCount('posts')->orderBy('name_ar')->get();

        return view('admin.blog-tags.index', compact('blogTags'));
    }

    public function create()
    {
        return view('admin.blog-tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:blog_tags,slug'],
            'name_ar' => ['required', 'string', 'max:255'],
        ]);

        BlogTag::create($validated);

        return redirect()->route('admin.blog-tags.index')->with('success', 'Blog tag created successfully.');
    }

    public function show(BlogTag $blogTag)
    {
        return redirect()->route('admin.blog-tags.edit', $blogTag);
    }

    public function edit(BlogTag $blogTag)
    {
        return view('admin.blog-tags.edit', compact('blogTag'));
    }

    public function update(Request $request, BlogTag $blogTag)
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('blog_tags', 'slug')->ignore($blogTag->id)],
            'name_ar' => ['required', 'string', 'max:255'],
        ]);

        $blogTag->update($validated);

        return redirect()->route('admin.blog-tags.index')->with('success', 'Blog tag updated successfully.');
    }

    public function destroy(BlogTag $blogTag)
    {
        $blogTag->delete();

        return redirect()->route('admin.blog-tags.index')->with('success', 'Blog tag deleted successfully.');
    }
}
