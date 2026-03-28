<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'question_ar',
        'answer_ar',
        'sort_order',
        'is_active',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(FaqCategory::class, 'faq_category_faq');
    }
}
