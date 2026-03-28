<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Support\MediaUploader;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    public function index()
    {
        $galleryImages = GalleryImage::query()
            ->with('imageMedia')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.gallery-images.index', compact('galleryImages'));
    }

    public function create()
    {
        return view('admin.gallery-images.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_ar' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'image_file' => ['required', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imageMediaId = MediaUploader::uploadImage(
            $request->file('image_file'),
            'gallery',
            $validated['alt_text'] ?? null
        );

        GalleryImage::query()->create([
            'title_ar' => $validated['title_ar'] ?? null,
            'image_media_id' => $imageMediaId,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.gallery-images.index')->with('success', 'Gallery image created successfully.');
    }

    public function show(GalleryImage $galleryImage)
    {
        return redirect()->route('admin.gallery-images.edit', $galleryImage);
    }

    public function edit(GalleryImage $galleryImage)
    {
        $galleryImage->load('imageMedia');

        return view('admin.gallery-images.edit', compact('galleryImage'));
    }

    public function update(Request $request, GalleryImage $galleryImage)
    {
        $validated = $request->validate([
            'title_ar' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imageMediaId = $galleryImage->image_media_id;
        if ($request->hasFile('image_file')) {
            $imageMediaId = MediaUploader::uploadImage(
                $request->file('image_file'),
                'gallery',
                $validated['alt_text'] ?? null
            );
        } elseif ($galleryImage->imageMedia) {
            $galleryImage->imageMedia->update([
                'alt_text' => $validated['alt_text'] ?? null,
            ]);
        }

        $galleryImage->update([
            'title_ar' => $validated['title_ar'] ?? null,
            'image_media_id' => $imageMediaId,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.gallery-images.index')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(GalleryImage $galleryImage)
    {
        $galleryImage->delete();

        return redirect()->route('admin.gallery-images.index')->with('success', 'Gallery image deleted successfully.');
    }
}
