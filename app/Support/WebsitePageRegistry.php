<?php

namespace App\Support;

use App\Models\Page;

class WebsitePageRegistry
{
    public static function pages(): array
    {
        return [
            ['slug' => 'home', 'title_ar' => 'الرئيسية', 'sort_order' => 1],
            ['slug' => 'about', 'title_ar' => 'من نحن', 'sort_order' => 2],
            ['slug' => 'services', 'title_ar' => 'الخدمات', 'sort_order' => 3],
            ['slug' => 'team', 'title_ar' => 'فريقنا العلاجي', 'sort_order' => 4],
            ['slug' => 'gallery', 'title_ar' => 'صور المركز', 'sort_order' => 5],
            ['slug' => 'faqs', 'title_ar' => 'الأسئلة الشائعة', 'sort_order' => 6],
            ['slug' => 'blogs', 'title_ar' => 'المقالات', 'sort_order' => 7],
            ['slug' => 'portfolio', 'title_ar' => 'قصص شفاء', 'sort_order' => 8],
            ['slug' => 'contact', 'title_ar' => 'اتصل بنا', 'sort_order' => 9],
            ['slug' => 'book-appointment', 'title_ar' => 'احجز موعد', 'sort_order' => 10],
        ];
    }

    public static function sync(): void
    {
        $pages = self::pages();
        $allowedSlugs = collect($pages)->pluck('slug')->all();

        Page::query()
            ->with('seoMeta')
            ->whereNotIn('slug', $allowedSlugs)
            ->get()
            ->each(function (Page $page): void {
                $page->seoMeta()?->delete();
                $page->delete();
            });

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'title_ar' => $page['title_ar'],
                    'sort_order' => $page['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }

    public static function find(string $slug): ?array
    {
        foreach (self::pages() as $page) {
            if ($page['slug'] === $slug) {
                return $page;
            }
        }

        return null;
    }
}
