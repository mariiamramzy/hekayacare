<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Support\MediaUploader;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    public function index(Page $page)
    {
        $sections = $page->sections()->with('media')->withCount('items')->get();

        return view('admin.sections.index', compact('page', 'sections'));
    }

    public function create(Page $page)
    {
        return view('admin.sections.create', compact('page'));
    }

    public function store(Request $request, Page $page)
    {
        $validated = $request->validate([
            'key' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'subtitle_ar' => ['nullable', 'string', 'max:255'],
            'body_ar' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'data_json' => ['nullable', 'json'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $mediaId = null;
        if ($request->hasFile('image')) {
            $mediaId = MediaUploader::uploadImage($request->file('image'), 'sections');
        }

        $page->sections()->create([
            'key' => $validated['key'],
            'title_ar' => $validated['title_ar'] ?? null,
            'subtitle_ar' => $validated['subtitle_ar'] ?? null,
            'body_ar' => $validated['body_ar'] ?? null,
            'media_id' => $mediaId,
            'data' => isset($validated['data_json']) ? json_decode($validated['data_json'], true) : null,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.pages.sections.index', $page)->with('success', 'Section created successfully.');
    }

    public function show(Page $page, PageSection $section)
    {
        $this->ensureSectionBelongsToPage($page, $section);

        return redirect()->route('admin.pages.sections.edit', [$page, $section]);
    }

    public function edit(Page $page, PageSection $section)
    {
        $this->ensureSectionBelongsToPage($page, $section);

        $section->load('media');

        return view('admin.sections.edit', compact('page', 'section'));
    }

    public function update(Request $request, Page $page, PageSection $section)
    {
        $this->ensureSectionBelongsToPage($page, $section);

        $validated = $request->validate([
            'key' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'subtitle_ar' => ['nullable', 'string', 'max:255'],
            'body_ar' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'data_json' => ['nullable', 'json'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $mediaId = $section->media_id;
        if ($request->hasFile('image')) {
            $mediaId = MediaUploader::uploadImage($request->file('image'), 'sections');
        }

        $section->update([
            'key' => $validated['key'],
            'title_ar' => $validated['title_ar'] ?? null,
            'subtitle_ar' => $validated['subtitle_ar'] ?? null,
            'body_ar' => $validated['body_ar'] ?? null,
            'media_id' => $mediaId,
            'data' => isset($validated['data_json']) ? json_decode($validated['data_json'], true) : null,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.pages.sections.index', $page)->with('success', 'Section updated successfully.');
    }

    public function destroy(Page $page, PageSection $section)
    {
        $this->ensureSectionBelongsToPage($page, $section);

        $section->delete();

        return redirect()->route('admin.pages.sections.index', $page)->with('success', 'Section deleted successfully.');
    }

    private function ensureSectionBelongsToPage(Page $page, PageSection $section): void
    {
        abort_unless($section->page_id === $page->id, 404);
    }
}
