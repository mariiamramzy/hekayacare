<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Support\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::with(['category', 'tags'])
            ->orderByDesc('id')
            ->get();

        return view('admin.blog-posts.index', compact('blogPosts'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();
        $tags = BlogTag::orderBy('name_ar')->get();

        return view('admin.blog-posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'excerpt_ar' => ['nullable', 'string'],
            'content_ar' => ['required', 'string'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'blog_category_id' => ['nullable', 'integer', 'exists:blog_categories,id'],
            'status' => ['required', Rule::in(['draft', 'published', 'scheduled'])],
            'published_at' => ['nullable', 'date'],
            'meta_title_ar' => ['nullable', 'string', 'max:255'],
            'meta_description_ar' => ['nullable', 'string', 'max:255'],
            'meta_keywords_ar' => ['nullable', 'string', 'max:255'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'robots' => ['nullable', 'string', 'max:100'],
            'og_title_ar' => ['nullable', 'string', 'max:255'],
            'og_description_ar' => ['nullable', 'string', 'max:255'],
            'og_type' => ['nullable', 'string', 'max:100'],
            'og_url' => ['nullable', 'url', 'max:255'],
            'og_site_name' => ['nullable', 'string', 'max:255'],
            'og_image' => ['nullable', 'image', 'max:5120'],
            'twitter_card' => ['nullable', 'string', 'max:100'],
            'twitter_title_ar' => ['nullable', 'string', 'max:255'],
            'twitter_description_ar' => ['nullable', 'string', 'max:255'],
            'twitter_image' => ['nullable', 'image', 'max:5120'],
            'schema_json_text' => ['nullable', 'json'],
        ]);

        $coverMediaId = null;
        if ($request->hasFile('cover_image')) {
            $coverMediaId = MediaUploader::uploadImage($request->file('cover_image'), 'blog');
        }

        $slug = $this->generateUniqueSlug($validated['title_ar']);

        $post = BlogPost::create([
            'slug' => $slug,
            'title_ar' => $validated['title_ar'],
            'excerpt_ar' => $validated['excerpt_ar'] ?? null,
            'content_ar' => $validated['content_ar'],
            'cover_media_id' => $coverMediaId,
            'blog_category_id' => $validated['blog_category_id'] ?? null,
            'status' => $validated['status'],
            'published_at' => $validated['published_at'] ?? null,
            'reading_time' => $this->estimateReadingTime($validated['content_ar']),
            'views' => 0,
        ]);

        $post->tags()->sync($this->generateTagIdsFromContent($validated['title_ar'], $validated['content_ar']));
        $this->syncSeoMeta($request, $post, $validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully.');
    }

    public function show(BlogPost $blogPost)
    {
        return redirect()->route('admin.blog-posts.edit', $blogPost);
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::orderBy('sort_order')->orderBy('id')->get();
        $tags = BlogTag::orderBy('name_ar')->get();
        $blogPost->load(['tags', 'seoMeta.ogImageMedia', 'seoMeta.twitterImageMedia']);

        return view('admin.blog-posts.edit', compact('blogPost', 'categories', 'tags'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'excerpt_ar' => ['nullable', 'string'],
            'content_ar' => ['required', 'string'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'blog_category_id' => ['nullable', 'integer', 'exists:blog_categories,id'],
            'status' => ['required', Rule::in(['draft', 'published', 'scheduled'])],
            'published_at' => ['nullable', 'date'],
            'reading_time' => ['nullable', 'integer', 'min:1'],
            'views' => ['nullable', 'integer', 'min:0'],
            'meta_title_ar' => ['nullable', 'string', 'max:255'],
            'meta_description_ar' => ['nullable', 'string', 'max:255'],
            'meta_keywords_ar' => ['nullable', 'string', 'max:255'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'robots' => ['nullable', 'string', 'max:100'],
            'og_title_ar' => ['nullable', 'string', 'max:255'],
            'og_description_ar' => ['nullable', 'string', 'max:255'],
            'og_type' => ['nullable', 'string', 'max:100'],
            'og_url' => ['nullable', 'url', 'max:255'],
            'og_site_name' => ['nullable', 'string', 'max:255'],
            'og_image' => ['nullable', 'image', 'max:5120'],
            'twitter_card' => ['nullable', 'string', 'max:100'],
            'twitter_title_ar' => ['nullable', 'string', 'max:255'],
            'twitter_description_ar' => ['nullable', 'string', 'max:255'],
            'twitter_image' => ['nullable', 'image', 'max:5120'],
            'schema_json_text' => ['nullable', 'json'],
        ]);

        $coverMediaId = $blogPost->cover_media_id;
        if ($request->hasFile('cover_image')) {
            $coverMediaId = MediaUploader::uploadImage($request->file('cover_image'), 'blog');
        }

        $slug = $this->generateUniqueSlug($validated['title_ar'], $blogPost->id);

        $blogPost->update([
            'slug' => $slug,
            'title_ar' => $validated['title_ar'],
            'excerpt_ar' => $validated['excerpt_ar'] ?? null,
            'content_ar' => $validated['content_ar'],
            'cover_media_id' => $coverMediaId,
            'blog_category_id' => $validated['blog_category_id'] ?? null,
            'status' => $validated['status'],
            'published_at' => $validated['published_at'] ?? null,
            'reading_time' => $validated['reading_time'] ?? $this->estimateReadingTime($validated['content_ar']),
            'views' => $validated['views'] ?? 0,
        ]);

        $blogPost->tags()->sync($this->generateTagIdsFromContent($validated['title_ar'], $validated['content_ar']));
        $this->syncSeoMeta($request, $blogPost, $validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }

    private function syncSeoMeta(Request $request, BlogPost $post, array $validated): void
    {
        $categoryName = $post->category?->name_ar;
        $tags = $post->tags()->pluck('name_ar')->filter()->values()->all();
        $descriptionSource = $validated['excerpt_ar'] ?: Str::limit(trim(strip_tags($validated['content_ar'])), 155, '');
        $generatedKeywords = collect([$validated['title_ar'], $categoryName, ...$tags])
            ->filter()
            ->unique()
            ->implode(', ');
        $canonicalUrl = url('/blogs/'.$post->slug);

        $payload = [
            'meta_title_ar' => $validated['meta_title_ar'] ?: $validated['title_ar'],
            'meta_description_ar' => $validated['meta_description_ar'] ?: $descriptionSource,
            'meta_keywords_ar' => $validated['meta_keywords_ar'] ?: $generatedKeywords,
            'canonical_url' => $validated['canonical_url'] ?: $canonicalUrl,
            'robots' => $validated['robots'] ?: 'index,follow',
            'og_title_ar' => $validated['og_title_ar'] ?: $validated['title_ar'],
            'og_description_ar' => $validated['og_description_ar'] ?: $descriptionSource,
            'og_type' => $validated['og_type'] ?: 'article',
            'og_url' => $validated['og_url'] ?: $canonicalUrl,
            'og_site_name' => $validated['og_site_name'] ?: config('app.name'),
            'twitter_card' => $validated['twitter_card'] ?: 'summary_large_image',
            'twitter_title_ar' => $validated['twitter_title_ar'] ?: $validated['title_ar'],
            'twitter_description_ar' => $validated['twitter_description_ar'] ?: $descriptionSource,
            'schema_json' => isset($validated['schema_json_text']) && $validated['schema_json_text'] !== ''
                ? json_decode($validated['schema_json_text'], true)
                : [
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => $validated['title_ar'],
                    'description' => $descriptionSource,
                    'url' => $canonicalUrl,
                ],
        ];

        $existingSeo = $post->seoMeta;
        if ($request->hasFile('og_image')) {
            $payload['og_image_media_id'] = MediaUploader::uploadImage($request->file('og_image'), 'seo');
        } elseif ($existingSeo?->og_image_media_id) {
            $payload['og_image_media_id'] = $existingSeo->og_image_media_id;
        }

        if ($request->hasFile('twitter_image')) {
            $payload['twitter_image_media_id'] = MediaUploader::uploadImage($request->file('twitter_image'), 'seo');
        } elseif ($existingSeo?->twitter_image_media_id) {
            $payload['twitter_image_media_id'] = $existingSeo->twitter_image_media_id;
        }

        $hasContent = collect($payload)->filter(function ($value) {
            if (is_array($value)) {
                return !empty($value);
            }

            return !is_null($value) && $value !== '';
        })->isNotEmpty();

        if ($hasContent) {
            $post->seoMeta()->updateOrCreate([], $payload);
        }
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($this->transliterateArabic($title));
        if ($baseSlug === '') {
            $baseSlug = 'blog-post';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            BlogPost::query()
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    private function transliterateArabic(string $value): string
    {
        return strtr($value, [
            'ا' => 'a', 'أ' => 'a', 'إ' => 'i', 'آ' => 'aa',
            'ب' => 'b', 'ت' => 't', 'ث' => 'th', 'ج' => 'j',
            'ح' => 'h', 'خ' => 'kh', 'د' => 'd', 'ذ' => 'dh',
            'ر' => 'r', 'ز' => 'z', 'س' => 's', 'ش' => 'sh',
            'ص' => 's', 'ض' => 'd', 'ط' => 't', 'ظ' => 'z',
            'ع' => 'a', 'غ' => 'gh', 'ف' => 'f', 'ق' => 'q',
            'ك' => 'k', 'ل' => 'l', 'م' => 'm', 'ن' => 'n',
            'ه' => 'h', 'و' => 'w', 'ؤ' => 'w', 'ي' => 'y',
            'ى' => 'a', 'ئ' => 'y', 'ة' => 'h', 'ء' => '',
        ]);
    }

    private function estimateReadingTime(string $content): int
    {
        $text = trim(strip_tags($content));
        if ($text === '') {
            return 1;
        }

        preg_match_all('/[\p{Arabic}\p{L}\p{N}]+/u', $text, $matches);
        $wordCount = count($matches[0]);

        return max(1, (int) ceil($wordCount / 200));
    }

    private function generateTagIdsFromContent(string $title, string $content): array
    {
        $text = trim($title.' '.strip_tags($content));
        preg_match_all('/[\p{Arabic}\p{L}]{3,}/u', $text, $matches);

        $stopWords = [
            'هذا', 'هذه', 'ذلك', 'التي', 'الذي', 'على', 'من', 'الى', 'إلى', 'في', 'عن', 'مع', 'كما', 'لكن',
            'لدى', 'أو', 'ثم', 'تم', 'وقد', 'كان', 'تكون', 'يكون', 'اذا', 'إذا', 'عند', 'بين', 'ضمن', 'بعد',
            'قبل', 'حول', 'أكثر', 'اقل', 'أقل', 'جدا', 'جداً', 'مثل', 'يمكن', 'مركز', 'حكاية', 'علاج', 'العلاج',
            'المرض', 'المرضى', 'المريض', 'والتي', 'والذي', 'there', 'with', 'from', 'that', 'this', 'have',
        ];

        $candidates = collect($matches[0] ?? [])
            ->map(fn (string $word) => trim(mb_strtolower($word)))
            ->filter(fn (string $word) => mb_strlen($word) >= 3)
            ->reject(fn (string $word) => in_array($word, $stopWords, true))
            ->countBy()
            ->sortDesc()
            ->keys()
            ->take(8);

        $tagIds = [];

        foreach ($candidates as $word) {
            $tag = BlogTag::query()->firstOrCreate(
                ['slug' => Str::slug($this->transliterateArabic($word)) ?: 'tag-'.Str::random(6)],
                ['name_ar' => $word]
            );

            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }
}
