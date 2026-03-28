<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'page_id',
        'key',
        'title_ar',
        'subtitle_ar',
        'body_ar',
        'media_id',
        'data',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'data' => 'array',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SectionItem::class)->orderBy('sort_order')->orderBy('id');
    }
}
