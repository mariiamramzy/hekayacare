<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'slug',
        'name_ar',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'blog_category_id');
    }
}
