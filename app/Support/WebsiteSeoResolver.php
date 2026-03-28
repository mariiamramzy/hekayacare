<?php

namespace App\Support;

use App\Models\Page;
use App\Models\SeoMeta;
use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class WebsiteSeoResolver
{
    public static function resolve(Request $request): array
    {
        $cacheKey = (string) optional($request->route())->getName().'|'.$request->path();
        static $resolved = [];

        if (isset($resolved[$cacheKey])) {
            return $resolved[$cacheKey];
        }

        $meta = self::resolveMetaFromRoute($request);
        $siteSetting = self::siteSetting();

        $resolved[$cacheKey] = [
            'meta' => $meta,
            'siteSetting' => $siteSetting,
            'defaultTitle' => $siteSetting?->site_name_ar ?: config('app.name'),
            'defaultDescription' => $siteSetting?->tagline_ar,
            'defaultImageUrl' => $siteSetting?->logoMedia?->path ? asset('storage/'.$siteSetting->logoMedia->path) : null,
            'faviconUrl' => $siteSetting?->faviconMedia?->path ? asset('storage/'.$siteSetting->faviconMedia->path) : null,
        ];

        return $resolved[$cacheKey];
    }

    protected static function resolveMetaFromRoute(Request $request): ?SeoMeta
    {
        $route = $request->route();

        if (! $route) {
            return null;
        }

        foreach ($route->parameters() as $parameter) {
            if ($parameter instanceof Model && method_exists($parameter, 'seoMeta')) {
                return $parameter->seoMeta()->with(['ogImageMedia', 'twitterImageMedia'])->first();
            }
        }

        $slug = self::guessPageSlug($request);
        if (! $slug) {
            return null;
        }

        $registeredPage = WebsitePageRegistry::find($slug);
        if ($registeredPage) {
            Page::query()->updateOrCreate(
                ['slug' => $registeredPage['slug']],
                [
                    'title_ar' => $registeredPage['title_ar'],
                    'sort_order' => $registeredPage['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        $page = Page::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (! $page) {
            return null;
        }

        return $page->seoMeta()->with(['ogImageMedia', 'twitterImageMedia'])->first();
    }

    protected static function guessPageSlug(Request $request): ?string
    {
        $routeName = (string) optional($request->route())->getName();

        if ($routeName !== '' && str_starts_with($routeName, 'website.')) {
            $namePart = str_replace('website.', '', $routeName);
            $namePart = str_replace('.store', '', $namePart);
            $namePart = str_replace('.', '-', $namePart);

            return trim($namePart) !== '' ? $namePart : null;
        }

        $path = trim($request->path(), '/');
        if ($path === '') {
            return 'home';
        }

        return $path;
    }

    protected static function siteSetting(): ?SiteSetting
    {
        static $cached = null;
        static $loaded = false;

        if (! $loaded) {
            $cached = SiteSetting::query()
                ->with(['logoMedia', 'faviconMedia'])
                ->first();
            $loaded = true;
        }

        return $cached;
    }
}
