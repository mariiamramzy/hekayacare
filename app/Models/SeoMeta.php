<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $table = 'seo_meta';

    protected $fillable = [
        'meta_title_ar',
        'meta_description_ar',
        'meta_keywords_ar',
        'canonical_url',
        'robots',
        'og_title_ar',
        'og_description_ar',
        'og_type',
        'og_url',
        'og_site_name',
        'og_image_media_id',
        'twitter_card',
        'twitter_title_ar',
        'twitter_description_ar',
        'twitter_image_media_id',
        'schema_json',
    ];

    protected function casts(): array
    {
        return [
            'schema_json' => 'array',
        ];
    }

    public function metaable(): MorphTo
    {
        return $this->morphTo();
    }

    public function ogImageMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'og_image_media_id');
    }

    public function twitterImageMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'twitter_image_media_id');
    }
}
