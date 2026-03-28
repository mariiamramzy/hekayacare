<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'site_name_ar',
        'tagline_ar',
        'logo_media_id',
        'favicon_media_id',
        'primary_phone',
        'whatsapp_number',
        'primary_email',
        'address_ar',
        'google_maps_url',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'working_hours_ar',
    ];

    public function logoMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'logo_media_id');
    }

    public function faviconMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'favicon_media_id');
    }
}
