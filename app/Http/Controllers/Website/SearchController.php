<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = trim((string) $request->query('q', ''));

        if ($query === '') {
            return redirect()->route('website.home');
        }

        $results = $this->searchStaticPages($query)
            ->merge($this->searchBlogPosts($query))
            ->merge($this->searchFaqs($query))
            ->merge($this->searchTeamMembers($query))
            ->sortByDesc('score')
            ->values();

        if ($redirect = $this->resolveSingleResultRedirect($results)) {
            return $redirect;
        }

        return view('website.search-results', [
            'query' => $query,
            'results' => $results,
            'groupedResults' => $results->groupBy('type'),
        ]);
    }

    protected function resolveSingleResultRedirect(Collection $results): ?RedirectResponse
    {
        if ($results->count() === 1) {
            return redirect()->to($results->first()['url']);
        }

        $exactMatches = $results->where('exact', true)->values();
        if ($exactMatches->count() === 1) {
            return redirect()->to($exactMatches->first()['url']);
        }

        return null;
    }

    protected function searchStaticPages(string $query): Collection
    {
        $normalizedQuery = $this->normalize($query);

        $pages = collect([
            [
                'title' => 'الرئيسية',
                'url' => route('website.home'),
                'snippet' => 'العودة إلى الصفحة الرئيسية لموقع مركز حكاية.',
                'keywords' => ['الرئيسية', 'حكاية', 'home', 'index'],
                'type' => 'pages',
            ],
            [
                'title' => 'عن المركز',
                'url' => route('website.about'),
                'snippet' => 'معلومات عن مركز حكاية وفلسفة العلاج والتعافي.',
                'keywords' => ['عن المركز', 'معلومات عنا', 'المركز', 'about'],
                'type' => 'pages',
            ],
            [
                'title' => 'الخدمات',
                'url' => route('website.services'),
                'snippet' => 'برامج العلاج النفسي وعلاج الإدمان والخدمات العلاجية.',
                'keywords' => ['الخدمات', 'العلاج', 'برامج', 'التأهيل', 'services'],
                'type' => 'pages',
            ],
            [
                'title' => 'فريقنا العلاجي',
                'url' => route('website.team'),
                'snippet' => 'تعرف على أعضاء الفريق العلاجي والأطباء والمتخصصين.',
                'keywords' => ['الفريق', 'فريق العلاج', 'الأطباء', 'المعالجين', 'team'],
                'type' => 'pages',
            ],
            [
                'title' => 'صور المركز',
                'url' => route('website.gallery'),
                'snippet' => 'معرض صور مركز حكاية والبيئة العلاجية داخل المركز.',
                'keywords' => ['صور', 'الجاليري', 'المعرض', 'صور المركز', 'gallery'],
                'type' => 'pages',
            ],
            [
                'title' => 'الأسئلة الشائعة',
                'url' => route('website.faqs'),
                'snippet' => 'إجابات واضحة عن أكثر الأسئلة شيوعًا حول العلاج والتعافي.',
                'keywords' => ['الأسئلة الشائعة', 'الاسئلة الشائعة', 'الأسئلة', 'استفسارات', 'faq'],
                'type' => 'pages',
            ],
            [
                'title' => 'المقالات',
                'url' => route('website.blogs'),
                'snippet' => 'مقالات عن الصحة النفسية وعلاج الإدمان وخطوات التعافي.',
                'keywords' => ['المقالات', 'مدونة', 'مقالات', 'blog', 'blogs'],
                'type' => 'pages',
            ],
            [
                'title' => 'اتصل بنا',
                'url' => route('website.contact'),
                'snippet' => 'تواصل مع مركز حكاية واطلب المساعدة أو الاستشارة.',
                'keywords' => ['اتصل بنا', 'تواصل', 'رقم', 'عنوان', 'contact'],
                'type' => 'pages',
            ],
            [
                'title' => 'احجز استشارة',
                'url' => route('website.book-appointment'),
                'snippet' => 'احجز استشارتك أو موعدك من خلال صفحة الحجز.',
                'keywords' => [
                    'احجز استشارة',
                    'احجز استشاره',
                    'حجز استشارة',
                    'حجز استشاره',
                    'حجز موعد',
                    'موعد استشارة',
                    'استشارة',
                    'استشاره',
                    'فورم الحجز',
                    'نموذج الحجز',
                    'book appointment',
                    'appointment',
                    'book',
                ],
                'type' => 'pages',
            ],
        ]);

        return $pages
            ->map(function (array $page) use ($normalizedQuery) {
                $haystacks = [
                    $this->normalize($page['title']),
                    $this->normalize($page['snippet']),
                    $this->normalize(implode(' ', $page['keywords'])),
                ];

                $score = 0;
                $exact = false;

                foreach ($haystacks as $index => $haystack) {
                    if ($haystack === '') {
                        continue;
                    }

                    if ($haystack === $normalizedQuery) {
                        $score += $index === 0 ? 180 : 140;
                        $exact = true;
                        continue;
                    }

                    if (str_contains($haystack, $normalizedQuery)) {
                        $score += $index === 0 ? 110 : 70;
                    }
                }

                if ($score === 0) {
                    return null;
                }

                return [
                    'type' => $page['type'],
                    'label' => 'صفحة',
                    'title' => $page['title'],
                    'snippet' => $page['snippet'],
                    'url' => $page['url'],
                    'score' => $score,
                    'exact' => $exact,
                ];
            })
            ->filter()
            ->values();
    }

    protected function searchBlogPosts(string $query): Collection
    {
        $normalizedQuery = $this->normalize($query);

        return BlogPost::query()
            ->with(['category'])
            ->published()
            ->where(function ($builder) use ($query) {
                $builder
                    ->where('title_ar', 'like', "%{$query}%")
                    ->orWhere('excerpt_ar', 'like', "%{$query}%")
                    ->orWhere('content_ar', 'like', "%{$query}%");
            })
            ->latestPublished()
            ->take(8)
            ->get()
            ->map(function (BlogPost $post) use ($normalizedQuery) {
                $normalizedTitle = $this->normalize((string) $post->title_ar);
                $score = 40;
                $exact = false;

                if ($normalizedTitle === $normalizedQuery) {
                    $score += 120;
                    $exact = true;
                } elseif (str_contains($normalizedTitle, $normalizedQuery)) {
                    $score += 70;
                }

                return [
                    'type' => 'blogs',
                    'label' => 'مقال',
                    'title' => $post->title_ar,
                    'snippet' => $post->excerpt_ar ?: mb_substr(strip_tags((string) $post->content_ar), 0, 160),
                    'url' => route('website.blog-details', $post->slug),
                    'score' => $score,
                    'exact' => $exact,
                ];
            });
    }

    protected function searchFaqs(string $query): Collection
    {
        $normalizedQuery = $this->normalize($query);

        return Faq::query()
            ->active()
            ->where(function ($builder) use ($query) {
                $builder
                    ->where('question_ar', 'like', "%{$query}%")
                    ->orWhere('answer_ar', 'like', "%{$query}%");
            })
            ->take(8)
            ->get()
            ->map(function (Faq $faq) use ($normalizedQuery) {
                $normalizedQuestion = $this->normalize((string) $faq->question_ar);
                $score = 30;
                $exact = false;

                if ($normalizedQuestion === $normalizedQuery) {
                    $score += 100;
                    $exact = true;
                } elseif (str_contains($normalizedQuestion, $normalizedQuery)) {
                    $score += 60;
                }

                return [
                    'type' => 'faqs',
                    'label' => 'سؤال شائع',
                    'title' => $faq->question_ar,
                    'snippet' => $faq->answer_ar,
                    'url' => route('website.faqs') . '#faq-' . $faq->id,
                    'score' => $score,
                    'exact' => $exact,
                ];
            });
    }

    protected function searchTeamMembers(string $query): Collection
    {
        $normalizedQuery = $this->normalize($query);

        return TeamMember::query()
            ->with('departments')
            ->active()
            ->where(function ($builder) use ($query) {
                $builder
                    ->where('name_ar', 'like', "%{$query}%")
                    ->orWhere('title_ar', 'like', "%{$query}%")
                    ->orWhere('specialty_ar', 'like', "%{$query}%")
                    ->orWhere('bio_ar', 'like', "%{$query}%")
                    ->orWhereHas('departments', function ($departmentQuery) use ($query) {
                        $departmentQuery->where('name_ar', 'like', "%{$query}%");
                    });
            })
            ->take(8)
            ->get()
            ->map(function (TeamMember $member) use ($normalizedQuery) {
                $normalizedName = $this->normalize((string) $member->name_ar);
                $score = 30;
                $exact = false;

                if ($normalizedName === $normalizedQuery) {
                    $score += 100;
                    $exact = true;
                } elseif (str_contains($normalizedName, $normalizedQuery)) {
                    $score += 60;
                }

                return [
                    'type' => 'team',
                    'label' => 'عضو فريق',
                    'title' => $member->name_ar,
                    'snippet' => $member->title_ar ?: ($member->specialty_ar ?: $member->bio_ar),
                    'url' => route('website.team') . '#team-member-' . $member->id,
                    'score' => $score,
                    'exact' => $exact,
                ];
            });
    }

    protected function normalize(string $value): string
    {
        $value = mb_strtolower(trim($value), 'UTF-8');
        $value = str_replace(['أ', 'إ', 'آ'], 'ا', $value);
        $value = str_replace(['ى'], 'ي', $value);
        $value = str_replace(['ة'], 'ه', $value);
        $value = str_replace(['ؤ'], 'و', $value);
        $value = str_replace(['ئ'], 'ي', $value);
        $value = preg_replace('/[\x{064B}-\x{065F}\x{0670}\x{06D6}-\x{06ED}]/u', '', $value) ?: '';
        $value = preg_replace('/[^\p{L}\p{N}\s]+/u', ' ', $value) ?: '';
        $value = preg_replace('/\s+/u', ' ', $value) ?: '';

        return trim($value);
    }
}
