<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'disk',
        'path',
        'filename',
        'mime_type',
        'size',
        'alt_text',
    ];

    public function logoForSettings(): HasMany
    {
        return $this->hasMany(SiteSetting::class, 'logo_media_id');
    }

    public function faviconForSettings(): HasMany
    {
        return $this->hasMany(SiteSetting::class, 'favicon_media_id');
    }

    public function seoOgImageFor(): HasMany
    {
        return $this->hasMany(SeoMeta::class, 'og_image_media_id');
    }

    public function seoTwitterImageFor(): HasMany
    {
        return $this->hasMany(SeoMeta::class, 'twitter_image_media_id');
    }
}
