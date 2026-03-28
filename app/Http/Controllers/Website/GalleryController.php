<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleryImages = collect();

        if (Schema::hasTable('gallery_images')) {
            $galleryImages = Cache::remember('website.gallery.images', now()->addMinutes(15), function () {
                return GalleryImage::query()
                    ->with('imageMedia')
                    ->active()
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            });
        }

        return view('website.gallery', compact('galleryImages'));
    }
}
