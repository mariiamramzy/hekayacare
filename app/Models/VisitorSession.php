<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class VisitorSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'ip_address',
        'country_code',
        'country_name',
        'city',
        'user_agent',
        'accept_language',
        'is_bot',
        'device_type',
        'entry_url',
        'entry_path',
        'entry_referrer',
        'referrer_domain',
        'landing_route',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'visit_count',
        'page_views',
        'first_visit_at',
        'last_visit_at',
    ];

    protected function casts(): array
    {
        return [
            'is_bot' => 'boolean',
            'visit_count' => 'integer',
            'page_views' => 'integer',
            'first_visit_at' => 'datetime',
            'last_visit_at' => 'datetime',
        ];
    }

    public function events(): HasMany
    {
        return $this->hasMany(VisitorEvent::class);
    }
}
