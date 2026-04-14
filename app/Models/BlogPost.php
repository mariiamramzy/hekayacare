<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BlogPost extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'slug',
        'title_ar',
        'excerpt_ar',
        'content_ar',
        'cover_media_id',
        'blog_category_id',
        'status',
        'published_at',
        'reading_time',
        'views',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', 'published')
            ->where(function (Builder $builder) {
                $builder
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->orderByDesc('id');
    }

    public function getCoverImageUrlAttribute(): string
    {
        if ($this->coverMedia?->path) {
            return Storage::disk($this->coverMedia->disk ?: 'public')->url($this->coverMedia->path);
        }

        return asset('images/blog/blog-page-1-1.webp');
    }

    public function getRenderedContentAttribute(): string
    {
        $content = trim((string) $this->content_ar);

        if ($content === '') {
            return '';
        }

        if ($content !== strip_tags($content)) {
            return $this->sanitizeHtmlContent($content);
        }

        return nl2br(e($content));
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag');
    }

    public function coverMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'cover_media_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'metaable');
    }

    private function sanitizeHtmlContent(string $content): string
    {
        $sanitized = preg_replace('/<(script|style)\b[^>]*>.*?<\/\1>/is', '', $content) ?? $content;
        $sanitized = preg_replace('/\son\w+=(["\']).*?\1/iu', '', $sanitized) ?? $sanitized;
        $sanitized = preg_replace('/\sstyle=(["\']).*?\1/iu', '', $sanitized) ?? $sanitized;
        $sanitized = preg_replace('/<p>\s*(?:&nbsp;|\s|<br\s*\/?>)*<\/p>/iu', '', $sanitized) ?? $sanitized;

        return trim($sanitized);
    }
}
