<?php

namespace App\Support;

use App\Models\IpGeo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class GeoIpResolver
{
    public static function resolve(?string $ipAddress): ?IpGeo
    {
        if (! $ipAddress || ! filter_var($ipAddress, FILTER_VALIDATE_IP) || ! self::isPublicIp($ipAddress)) {
            return null;
        }

        $cached = IpGeo::query()->where('ip_address', $ipAddress)->first();
        if ($cached) {
            return $cached;
        }

        $response = Http::timeout(2)->acceptJson()->get('https://ipwho.is/'.urlencode($ipAddress));
        if (! $response->successful()) {
            return null;
        }

        $data = $response->json();
        if (! is_array($data) || ! ($data['success'] ?? false)) {
            return null;
        }

        return IpGeo::query()->create([
            'ip_address' => $ipAddress,
            'country_code' => self::nullIfEmpty($data['country_code'] ?? null),
            'country_name' => self::nullIfEmpty($data['country'] ?? null),
            'region' => self::nullIfEmpty($data['region'] ?? null),
            'city' => self::nullIfEmpty($data['city'] ?? null),
            'timezone' => self::nullIfEmpty($data['timezone']['id'] ?? null),
            'latitude' => isset($data['latitude']) ? (float) $data['latitude'] : null,
            'longitude' => isset($data['longitude']) ? (float) $data['longitude'] : null,
            'source' => 'ipwho.is',
            'last_lookup_at' => Carbon::now(),
        ]);
    }

    protected static function nullIfEmpty(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim((string) $value);

        return $trimmed === '' ? null : $trimmed;
    }

    protected static function isPublicIp(string $ipAddress): bool
    {
        return filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
    }
}
