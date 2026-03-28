<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Support\WebsitePageRegistry;
use Illuminate\Database\Seeder;

class WebsiteSeoMetaSeeder extends Seeder
{
    public function run(): void
    {
        WebsitePageRegistry::sync();

        $baseUrl = rtrim((string) config('app.url', 'https://hekayacare.com'), '/');
        $siteName = 'حكاية';

        $pages = [
            'home' => [
                'title' => 'الرئيسية | Hekaya',
                'description' => 'مركز حكاية هو مركز متخصص في علاج الإدمان والصحة النفسية. نقدم برامج إقامة كاملة، جلسات أونلاين، ودعم نفسي مستمر.',
                'keywords' => 'حكاية, مركز حكاية, علاج الإدمان, الصحة النفسية, علاج نفسي, جلسات أونلاين, التعافي, استشارات نفسية',
                'path' => '/',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'MedicalBusiness',
                    'name' => 'حكاية',
                    'url' => $baseUrl.'/',
                    'description' => 'مركز متخصص في علاج الإدمان والصحة النفسية وتقديم الدعم والاستشارات وبرامج التعافي.',
                ],
            ],
            'about' => [
                'title' => 'من نحن | Hekaya',
                'description' => 'تعرف على مركز حكاية ورؤيتنا ورسالتنا وقيمنا في علاج الإدمان والصحة النفسية داخل بيئة علاجية آمنة وداعمة.',
                'keywords' => 'من نحن, مركز حكاية, رؤية حكاية, رسالة حكاية, علاج الإدمان, الصحة النفسية, بيئة علاجية آمنة',
                'path' => '/about',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'AboutPage',
                    'name' => 'من نحن - حكاية',
                    'url' => $baseUrl.'/about',
                    'description' => 'تعرف على مركز حكاية ورؤيته ورسالة الدعم والتعافي والصحة النفسية.',
                ],
            ],
            'services' => [
                'title' => 'الخدمات | Hekaya',
                'description' => 'تعرف على خدمات مركز حكاية العلاجية وبرامج الإقامة والعلاج النفسي وورش العمل والدعم المتكامل.',
                'keywords' => 'الخدمات, خدمات حكاية, برامج الإقامة, العلاج النفسي, علاج الإدمان, ورش العمل, الدعم النفسي',
                'path' => '/services',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'CollectionPage',
                    'name' => 'الخدمات العلاجية - حكاية',
                    'url' => $baseUrl.'/services',
                    'description' => 'استعراض الخدمات العلاجية وبرامج التعافي والدعم النفسي في مركز حكاية.',
                ],
            ],
            'team' => [
                'title' => 'فريقنا العلاجي | Hekaya',
                'description' => 'تعرف على الفريق العلاجي في مركز حكاية من الأخصائيين والمعالجين والاستشاريين المتخصصين في الصحة النفسية وعلاج الإدمان.',
                'keywords' => 'فريقنا العلاجي, فريق حكاية, أخصائيين نفسيين, معالجين, استشاريين, علاج الإدمان, الصحة النفسية',
                'path' => '/team',
                'type' => 'profile',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'ProfilePage',
                    'name' => 'فريقنا العلاجي - حكاية',
                    'url' => $baseUrl.'/team',
                    'description' => 'تعرف على أعضاء الفريق العلاجي في مركز حكاية.',
                ],
            ],
            'gallery' => [
                'title' => 'صور المركز | Hekaya',
                'description' => 'استكشف صور مركز حكاية والبيئة العلاجية والمساحات الداخلية والخارجية من خلال معرض الصور.',
                'keywords' => 'صور المركز, معرض الصور, صور حكاية, البيئة العلاجية, مركز علاج الإدمان, الصحة النفسية',
                'path' => '/gallery',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'ImageGallery',
                    'name' => 'صور المركز - حكاية',
                    'url' => $baseUrl.'/gallery',
                    'description' => 'معرض صور لمركز حكاية وبيئته العلاجية.',
                ],
            ],
            'faqs' => [
                'title' => 'الأسئلة الشائعة | Hekaya',
                'description' => 'إجابات واضحة على أكثر الأسئلة شيوعًا حول العلاج النفسي وعلاج الإدمان وخطوات التعافي في مركز حكاية.',
                'keywords' => 'الأسئلة الشائعة, FAQ, علاج الإدمان, العلاج النفسي, خطوات التعافي, مركز حكاية',
                'path' => '/faqs',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'name' => 'الأسئلة الشائعة - حكاية',
                    'url' => $baseUrl.'/faqs',
                    'description' => 'إجابات على الأسئلة الشائعة عن خدمات مركز حكاية.',
                ],
            ],
            'blogs' => [
                'title' => 'المقالات | Hekaya',
                'description' => 'مقالات حكاية عن علاج الإدمان والصحة النفسية والتعافي وبناء حياة أكثر توازنًا ووعيًا.',
                'keywords' => 'المقالات, مقالات حكاية, علاج الإدمان, الصحة النفسية, التعافي, الوعي النفسي',
                'path' => '/blogs',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'Blog',
                    'name' => 'مقالات حكاية',
                    'url' => $baseUrl.'/blogs',
                    'description' => 'مقالات مركز حكاية عن الصحة النفسية والتعافي.',
                ],
            ],
            'portfolio' => [
                'title' => 'قصص شفاء | Hekaya',
                'description' => 'حكايات تعافي وشفاء ملهمة من مركز حكاية، تعكس رحلة التغيير والدعم النفسي والتأهيل نحو حياة أكثر استقرارًا.',
                'keywords' => 'قصص شفاء, حكايات تعافي, قصص نجاح, التعافي, مركز حكاية, الدعم النفسي, التأهيل',
                'path' => '/portfolio',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'CollectionPage',
                    'name' => 'قصص شفاء - حكاية',
                    'url' => $baseUrl.'/portfolio',
                    'description' => 'قصص تعافي وشفاء ملهمة من مركز حكاية.',
                ],
            ],
            'contact' => [
                'title' => 'اتصل بنا | Hekaya',
                'description' => 'تواصل مع مركز حكاية للاستفسار عن خدمات علاج الإدمان والصحة النفسية واحجز استشارتك بسهولة.',
                'keywords' => 'اتصل بنا, تواصل مع حكاية, حجز استشارة, مركز حكاية, علاج الإدمان, الصحة النفسية',
                'path' => '/contact',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'ContactPage',
                    'name' => 'اتصل بنا - حكاية',
                    'url' => $baseUrl.'/contact',
                    'description' => 'صفحة التواصل مع مركز حكاية لحجز استشارة أو الاستفسار عن الخدمات.',
                ],
            ],
            'book-appointment' => [
                'title' => 'احجز موعد | Hekaya',
                'description' => 'احجز موعدك مع مركز حكاية بسهولة واترك بياناتك ليتم التواصل معك وبدء رحلة الدعم والعلاج المناسبة.',
                'keywords' => 'احجز موعد, حجز استشارة, مركز حكاية, علاج الإدمان, الصحة النفسية, نموذج الحجز',
                'path' => '/book-appointment',
                'type' => 'website',
                'schema' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebPage',
                    'name' => 'احجز موعد - حكاية',
                    'url' => $baseUrl.'/book-appointment',
                    'description' => 'صفحة حجز موعد في مركز حكاية.',
                ],
            ],
        ];

        foreach ($pages as $slug => $data) {
            $page = Page::query()->firstWhere('slug', $slug);

            if (! $page) {
                continue;
            }

            $url = $baseUrl.$data['path'];

            $page->seoMeta()->updateOrCreate([], [
                'meta_title_ar' => $data['title'],
                'meta_description_ar' => $data['description'],
                'meta_keywords_ar' => $data['keywords'],
                'canonical_url' => $url,
                'robots' => 'index,follow',
                'og_title_ar' => $data['title'],
                'og_description_ar' => $data['description'],
                'og_type' => $data['type'],
                'og_url' => $url,
                'og_site_name' => $siteName,
                'twitter_card' => 'summary_large_image',
                'twitter_title_ar' => $data['title'],
                'twitter_description_ar' => $data['description'],
                'schema_json' => $data['schema'],
            ]);
        }
    }
}
