<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\PortfolioCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $payload = Cache::remember('website.sitemap.xml', now()->addMinutes(30), function (): array {
            $now = now();

            $staticUrls = [
                [
                    'loc' => route('website.home'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'daily',
                    'priority' => '1.0',
                ],
                [
                    'loc' => route('website.about'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => route('website.services'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.9',
                ],
                [
                    'loc' => route('website.team'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => route('website.gallery'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => route('website.portfolio'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.9',
                ],
                [
                    'loc' => route('website.blogs'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'daily',
                    'priority' => '0.9',
                ],
                [
                    'loc' => route('website.faqs'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => route('website.contact'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ],
                [
                    'loc' => route('website.book-appointment'),
                    'lastmod' => $now->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ],
            ];

            $blogUrls = BlogPost::query()
                ->published()
                ->select(['slug', 'updated_at', 'published_at'])
                ->get()
                ->map(function (BlogPost $post): array {
                    return [
                        'loc' => route('website.blog-details', $post),
                        'lastmod' => ($post->updated_at ?? $post->published_at ?? now())->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.8',
                    ];
                })
                ->all();

            $portfolioUrls = PortfolioCase::query()
                ->active()
                ->select(['slug', 'updated_at'])
                ->get()
                ->map(function (PortfolioCase $case): array {
                    return [
                        'loc' => route('website.portfolio-details', $case),
                        'lastmod' => ($case->updated_at ?? now())->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.8',
                    ];
                })
                ->all();

            return [
                'urls' => array_merge($staticUrls, $blogUrls, $portfolioUrls),
            ];
        });

        return response()
            ->view('website.sitemap', $payload)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
