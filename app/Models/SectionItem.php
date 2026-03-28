<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class SectionItem extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'page_section_id',
        'title_ar',
        'body_ar',
        'icon',
        'media_id',
        'link_type',
        'link_value',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}
