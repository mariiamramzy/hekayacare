<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'title_ar',
        'specialty_ar',
        'bio_ar',
        'photo_media_id',
        'phone',
        'email',
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
        return $query
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photoMedia?->path) {
            return asset('storage/'.$this->photoMedia->path);
        }

        return asset('images/team/mkary-naem.webp');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(TeamDepartment::class, 'team_department_member');
    }

    public function photoMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'photo_media_id');
    }
}
