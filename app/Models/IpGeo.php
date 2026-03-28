<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpGeo extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'country_code',
        'country_name',
        'region',
        'city',
        'timezone',
        'latitude',
        'longitude',
        'source',
        'last_lookup_at',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'last_lookup_at' => 'datetime',
        ];
    }
}
