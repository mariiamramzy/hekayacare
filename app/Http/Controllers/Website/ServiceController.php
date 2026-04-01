<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Support\WebsiteServiceCatalog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('website.services', [
            'services' => $this->services(),
        ]);
    }

    public function show(string $service): View
    {
        $serviceData = collect($this->services())->firstWhere('slug', $service);

        abort_unless($serviceData, 404);

        return view('website.service-details', [
            'service' => $serviceData,
            'services' => $this->services(),
            'galleryImages' => $serviceData['gallery_images'],
        ]);
    }

    protected function services(): array
    {
        if (Schema::hasTable('services')) {
            $services = Cache::remember('website.services.all', now()->addMinutes(15), function () {
                return Service::query()
                    ->with([
                        'imageMedia',
                        'galleryImageOneMedia',
                        'galleryImageTwoMedia',
                        'galleryImageThreeMedia',
                    ])
                    ->active()
                    ->ordered()
                    ->get()
                    ->map(fn (Service $service) => $this->transformService($service))
                    ->all();
            });

            if ($services !== []) {
                return $services;
            }
        }

        return collect(WebsiteServiceCatalog::all())
            ->map(function (array $service) {
                $service['gallery_images'] = [
                    ['url' => asset('images/services/services-1-1.webp'), 'alt' => $service['title']],
                    ['url' => asset('images/services/services-1-2.webp'), 'alt' => $service['title']],
                    ['url' => asset('images/services/services-1-3.webp'), 'alt' => $service['title']],
                ];

                return $service;
            })
            ->all();
    }

    protected function transformService(Service $service): array
    {
        return [
            'slug' => $service->slug,
            'title' => $service->title_ar,
            'page_title' => $service->page_title,
            'short_description' => $service->short_description,
            'meta_description' => $service->meta_description_ar ?: $service->short_description,
            'image' => $service->image_url,
            'icon' => $service->icon_class ?: 'icon-crm',
            'service_type' => $service->service_type,
            'has_gallery_section' => $service->has_gallery_section,
            'highlights_intro' => $service->highlights_intro,
            'card_points' => $service->card_points ?? [],
            'highlights' => $service->highlights ?? [],
            'tabs' => $service->tabs ?? [],
            'gallery_images' => $service->has_gallery_section ? $service->gallery_images : [],
        ];
    }
}
