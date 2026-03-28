<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class VisitorEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_session_id',
        'method',
        'url',
        'path',
        'query_string',
        'route_name',
        'controller_action',
        'http_status',
        'duration_ms',
        'referrer',
        'ip_address',
        'is_ajax',
        'payload',
        'visited_at',
    ];

    protected function casts(): array
    {
        return [
            'http_status' => 'integer',
            'duration_ms' => 'integer',
            'is_ajax' => 'boolean',
            'payload' => 'array',
            'visited_at' => 'datetime',
        ];
    }

    public function visitorSession(): BelongsTo
    {
        return $this->belongsTo(VisitorSession::class);
    }
}
