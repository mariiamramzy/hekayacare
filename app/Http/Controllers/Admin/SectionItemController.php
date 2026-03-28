<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionItem;
use App\Support\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectionItemController extends Controller
{
    public function index(Page $page, PageSection $section)
    {
        $this->ensureHierarchy($page, $section);

        $items = $section->items()->with('media')->get();

        return view('admin.items.index', compact('page', 'section', 'items'));
    }

    public function create(Page $page, PageSection $section)
    {
        $this->ensureHierarchy($page, $section);

        return view('admin.items.create', compact('page', 'section'));
    }

    public function store(Request $request, Page $page, PageSection $section)
    {
        $this->ensureHierarchy($page, $section);

        $validated = $request->validate([
            'title_ar' => ['nullable', 'string', 'max:255'],
            'body_ar' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
            'link_type' => ['nullable', Rule::in(['internal', 'external', 'service', 'post', 'none'])],
            'link_value' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $mediaId = null;
        if ($request->hasFile('image')) {
            $mediaId = MediaUploader::uploadImage($request->file('image'), 'section-items');
        }

        $section->items()->create([
            'title_ar' => $validated['title_ar'] ?? null,
            'body_ar' => $validated['body_ar'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'media_id' => $mediaId,
            'link_type' => $validated['link_type'] ?? null,
            'link_value' => $validated['link_value'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.pages.sections.items.index', [$page, $section])->with('success', 'Section item created successfully.');
    }

    public function show(Page $page, PageSection $section, SectionItem $item)
    {
        $this->ensureHierarchy($page, $section, $item);

        return redirect()->route('admin.pages.sections.items.edit', [$page, $section, $item]);
    }

    public function edit(Page $page, PageSection $section, SectionItem $item)
    {
        $this->ensureHierarchy($page, $section, $item);

        return view('admin.items.edit', compact('page', 'section', 'item'));
    }

    public function update(Request $request, Page $page, PageSection $section, SectionItem $item)
    {
        $this->ensureHierarchy($page, $section, $item);

        $validated = $request->validate([
            'title_ar' => ['nullable', 'string', 'max:255'],
            'body_ar' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
            'link_type' => ['nullable', Rule::in(['internal', 'external', 'service', 'post', 'none'])],
            'link_value' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $mediaId = $item->media_id;
        if ($request->hasFile('image')) {
            $mediaId = MediaUploader::uploadImage($request->file('image'), 'section-items');
        }

        $item->update([
            'title_ar' => $validated['title_ar'] ?? null,
            'body_ar' => $validated['body_ar'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'media_id' => $mediaId,
            'link_type' => $validated['link_type'] ?? null,
            'link_value' => $validated['link_value'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.pages.sections.items.index', [$page, $section])->with('success', 'Section item updated successfully.');
    }

    public function destroy(Page $page, PageSection $section, SectionItem $item)
    {
        $this->ensureHierarchy($page, $section, $item);

        $item->delete();

        return redirect()->route('admin.pages.sections.items.index', [$page, $section])->with('success', 'Section item deleted successfully.');
    }

    private function ensureHierarchy(Page $page, PageSection $section, ?SectionItem $item = null): void
    {
        abort_unless($section->page_id === $page->id, 404);

        if ($item) {
            abort_unless($item->page_section_id === $section->id, 404);
        }
    }
}
