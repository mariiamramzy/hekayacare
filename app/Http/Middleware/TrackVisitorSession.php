<?php

namespace App\Http\Middleware;

use App\Models\VisitorSession;
use App\Support\GeoIpResolver;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackVisitorSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $startedAt = microtime(true);
        $response = $next($request);

        if (! $this->shouldTrack($request)) {
            return $response;
        }

        try {
            $this->storeVisit($request, $response, $startedAt);
        } catch (Throwable $exception) {
            report($exception);
        }

        return $response;
    }

    protected function shouldTrack(Request $request): bool
    {
        if (app()->runningInConsole()) {
            return false;
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return false;
        }

        if ($request->isMethod('OPTIONS')) {
            return false;
        }

        return true;
    }

    protected function storeVisit(Request $request, Response $response, float $startedAt): void
    {
        $now = Carbon::now();
        $sessionId = $request->session()->getId();
        $referrer = $request->headers->get('referer');
        $route = $request->route();
        $isPageView = in_array($request->method(), ['GET', 'HEAD'], true);

        $visitorSession = VisitorSession::query()->firstOrNew(['session_id' => $sessionId]);

        if (! $visitorSession->exists) {
            $geo = GeoIpResolver::resolve($request->ip());

            $visitorSession->fill([
                'ip_address' => $request->ip(),
                'country_code' => $geo?->country_code,
                'country_name' => $geo?->country_name,
                'city' => $geo?->city,
                'user_agent' => $request->userAgent(),
                'accept_language' => $request->header('accept-language'),
                'is_bot' => $this->isBot($request->userAgent()),
                'device_type' => $this->resolveDeviceType($request->userAgent()),
                'entry_url' => $request->fullUrl(),
                'entry_path' => '/'.ltrim($request->path(), '/'),
                'entry_referrer' => $referrer,
                'referrer_domain' => $this->parseDomain($referrer),
                'landing_route' => $route?->getName(),
                'utm_source' => $this->trimString($request->query('utm_source')),
                'utm_medium' => $this->trimString($request->query('utm_medium')),
                'utm_campaign' => $this->trimString($request->query('utm_campaign')),
                'utm_term' => $this->trimString($request->query('utm_term')),
                'utm_content' => $this->trimString($request->query('utm_content')),
                'first_visit_at' => $now,
            ]);
        }

        $visitorSession->fill([
            'last_visit_at' => $now,
            'visit_count' => (int) $visitorSession->visit_count + 1,
            'page_views' => (int) $visitorSession->page_views + ($isPageView ? 1 : 0),
        ]);

        if (! $visitorSession->entry_referrer && $referrer) {
            $visitorSession->entry_referrer = $referrer;
            $visitorSession->referrer_domain = $this->parseDomain($referrer);
        }

        if (! $visitorSession->country_name && $request->ip()) {
            $geo = GeoIpResolver::resolve($request->ip());
            if ($geo) {
                $visitorSession->country_code = $geo->country_code;
                $visitorSession->country_name = $geo->country_name;
                $visitorSession->city = $geo->city;
            }
        }

        if (! $visitorSession->landing_route && $route?->getName()) {
            $visitorSession->landing_route = $route->getName();
        }

        foreach (['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'] as $utmKey) {
            if (! $visitorSession->{$utmKey} && $request->filled($utmKey)) {
                $visitorSession->{$utmKey} = $this->trimString($request->query($utmKey));
            }
        }

        $visitorSession->save();

        $payload = $this->extractPayload($request);

        $visitorSession->events()->create([
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'path' => '/'.ltrim($request->path(), '/'),
            'query_string' => $request->getQueryString(),
            'route_name' => $route?->getName(),
            'controller_action' => $route?->getActionName(),
            'http_status' => $response->getStatusCode(),
            'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
            'referrer' => $referrer,
            'ip_address' => $request->ip(),
            'is_ajax' => $request->ajax(),
            'payload' => $payload,
            'visited_at' => $now,
        ]);
    }

    protected function trimString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $string = trim((string) $value);

        return $string === '' ? null : $string;
    }

    protected function parseDomain(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        return parse_url($url, PHP_URL_HOST) ?: null;
    }

    protected function resolveDeviceType(?string $userAgent): string
    {
        if (! $userAgent) {
            return 'unknown';
        }

        $ua = strtolower($userAgent);

        if (str_contains($ua, 'ipad') || str_contains($ua, 'tablet')) {
            return 'tablet';
        }

        if (str_contains($ua, 'mobile') || str_contains($ua, 'android') || str_contains($ua, 'iphone')) {
            return 'mobile';
        }

        if ($this->isBot($userAgent)) {
            return 'bot';
        }

        return 'desktop';
    }

    protected function isBot(?string $userAgent): bool
    {
        if (! $userAgent) {
            return false;
        }

        return (bool) preg_match('/bot|crawl|spider|slurp|facebookexternalhit|whatsapp|telegram/i', $userAgent);
    }

    protected function extractPayload(Request $request): ?array
    {
        if (in_array($request->method(), ['GET', 'HEAD', 'OPTIONS'], true)) {
            return null;
        }

        $input = $request->except([
            '_token',
            '_method',
            'password',
            'password_confirmation',
            'current_password',
        ]);

        return [
            'input_keys' => array_keys($input),
            'file_keys' => array_keys($request->allFiles()),
        ];
    }
}
