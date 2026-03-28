<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class GalleryImage extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title_ar',
        'image_media_id',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function imageMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_media_id');
    }

    public function getImageUrlAttribute(): string
    {
        $media = $this->imageMedia;

        if ($media?->path && Storage::disk($media->disk ?: 'public')->exists($media->path)) {
            $encodedPath = collect(explode('/', $media->path))
                ->map(fn (string $segment) => rawurlencode($segment))
                ->implode('/');

            return '/storage/'.$encodedPath;
        }

        return asset('images/backgrounds/page-header-bg.webp');
    }

    public function getImageAltAttribute(): string
    {
        return $this->imageMedia?->alt_text
            ?: $this->title_ar
            ?: 'Gallery image';
    }
}
