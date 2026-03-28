<?php

namespace App\Providers;

use App\Support\WebsiteSeoResolver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('website.*', function ($view): void {
            $request = request();
            $seoCacheKey = 'website.seo.' . md5(($request->route()?->getName() ?? 'no-route') . '|' . $request->fullUrl());
            $seo = Cache::remember($seoCacheKey, now()->addMinutes(15), function () use ($request) {
                return WebsiteSeoResolver::resolve($request);
            });

            $view->with('websiteSeoMeta', $seo['meta']);
            $view->with('websiteSeoSiteSetting', $seo['siteSetting']);
            $view->with('websiteSeoDefaultTitle', $seo['defaultTitle']);
            $view->with('websiteSeoDefaultDescription', $seo['defaultDescription']);
            $view->with('websiteSeoDefaultImageUrl', $seo['defaultImageUrl']);
            $view->with('websiteSeoFaviconUrl', $seo['faviconUrl']);
        });
    }
}
