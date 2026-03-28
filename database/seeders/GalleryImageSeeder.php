<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'WhatsApp Image 2026-03-14 at 3.28.34 PM_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.35 PM_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.35 PM (1)_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.35 PM (2)_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.36 PM_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.36 PM (1)_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.36 PM (2)_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.36 PM (3)_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.37 PM_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.37 PM (1)_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.37 PM (2)_result.webp',
            'WhatsApp Image 2026-03-14 at 3.28.38 PM_result.webp',
        ];

        foreach ($images as $index => $filename) {
            $sourcePath = public_path('images/op-gallery/'.$filename);

            if (! File::exists($sourcePath)) {
                continue;
            }

            $targetPath = 'gallery/seeded/'.$filename;

            if (! Storage::disk('public')->exists($targetPath)) {
                Storage::disk('public')->put($targetPath, File::get($sourcePath));
            }

            $media = Media::query()->firstOrCreate(
                ['disk' => 'public', 'path' => $targetPath],
                [
                    'filename' => $filename,
                    'mime_type' => File::mimeType($sourcePath),
                    'size' => File::size($sourcePath),
                ]
            );

            GalleryImage::query()->updateOrCreate(
                ['image_media_id' => $media->id],
                [
                    'title_ar' => null,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
