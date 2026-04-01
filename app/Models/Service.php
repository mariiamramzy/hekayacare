<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'slug',
        'title_ar',
        'page_title_ar',
        'short_description',
        'meta_description_ar',
        'icon_class',
        'service_type',
        'image_media_id',
        'gallery_image_one_media_id',
        'gallery_image_two_media_id',
        'gallery_image_three_media_id',
        'has_gallery_section',
        'highlights_intro',
        'card_points',
        'highlights',
        'tabs',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'card_points' => 'array',
            'highlights' => 'array',
            'tabs' => 'array',
            'has_gallery_section' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function imageMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_media_id');
    }

    public function galleryImageOneMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'gallery_image_one_media_id');
    }

    public function galleryImageTwoMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'gallery_image_two_media_id');
    }

    public function galleryImageThreeMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'gallery_image_three_media_id');
    }

    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'metaable');
    }

    public function getPageTitleAttribute(): string
    {
        return $this->page_title_ar ?: $this->title_ar;
    }

    public function getImageUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->imageMedia, $this->fallbackMainImage());
    }

    public function getGalleryImagesAttribute(): array
    {
        $items = [
            ['media' => $this->galleryImageOneMedia, 'fallback' => asset('images/services/services-1-1.webp')],
            ['media' => $this->galleryImageTwoMedia, 'fallback' => asset('images/services/services-1-2.webp')],
            ['media' => $this->galleryImageThreeMedia, 'fallback' => asset('images/services/services-1-3.webp')],
        ];

        return collect($items)
            ->map(function (array $item): array {
                $media = $item['media'];

                return [
                    'url' => $this->resolveMediaUrl($media, $item['fallback']),
                    'alt' => $media?->alt_text ?: $this->title_ar,
                ];
            })
            ->all();
    }

    protected function fallbackMainImage(): string
    {
        return match ($this->slug) {
            'addiction-residential' => asset('images/services/services-1-3.webp'),
            'mental-health-residential' => asset('images/services/services-1-1.webp'),
            'psychological-counseling' => asset('images/services/services-1-2.webp'),
            'training-workshops' => asset('images/services/services-2-1.webp'),
            default => asset('images/services/services-1-3.webp'),
        };
    }

    protected function resolveMediaUrl(?Media $media, string $fallbackUrl): string
    {
        if ($media?->path && Storage::disk($media->disk ?: 'public')->exists($media->path)) {
            $encodedPath = collect(explode('/', $media->path))
                ->map(fn (string $segment) => rawurlencode($segment))
                ->implode('/');

            return '/storage/'.$encodedPath;
        }

        return $fallbackUrl;
    }
}
