<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PortfolioCase extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'slug',
        'title_ar',
        'card_sub_title',
        'excerpt_ar',
        'cover_media_id',
        'main_media_id',
        'intro_heading',
        'intro_text',
        'secondary_media_id',
        'points_heading',
        'points_text',
        'point_one_ar',
        'point_two_ar',
        'point_three_ar',
        'closing_text',
        'case_label',
        'started_at',
        'location_ar',
        'client_name_ar',
        'duration_ar',
        'sidebar_media_id',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'date',
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

    public function coverMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'cover_media_id');
    }

    public function mainMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'main_media_id');
    }

    public function secondaryMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'secondary_media_id');
    }

    public function sidebarMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'sidebar_media_id');
    }

    public function getCardTitleAttribute(): string
    {
        return $this->card_sub_title ?: $this->title_ar;
    }

    public function getCoverImageUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->coverMedia, 'images/project/portfolio-2-3.webp');
    }

    public function getMainImageUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->mainMedia, 'images/services/services-1-3.webp');
    }

    public function getSecondaryImageUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->secondaryMedia, 'images/services/services-2-1.webp');
    }

    public function getSidebarImageUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->sidebarMedia, 'images/project/portfolio-2-3.webp');
    }

    protected function resolveMediaUrl(?Media $media, string $fallbackAsset): string
    {
        if ($media?->path && Storage::disk($media->disk ?: 'public')->exists($media->path)) {
            $encodedPath = collect(explode('/', $media->path))
                ->map(fn (string $segment) => rawurlencode($segment))
                ->implode('/');

            return '/storage/'.$encodedPath;
        }

        return asset($fallbackAsset);
    }
}
