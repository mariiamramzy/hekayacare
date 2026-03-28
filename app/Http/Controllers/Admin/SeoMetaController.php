<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\SeoMeta;
use App\Support\MediaUploader;
use App\Support\WebsitePageRegistry;
use Illuminate\Http\Request;

class SeoMetaController extends Controller
{
    public function index()
    {
        WebsitePageRegistry::sync();

        $pages = Page::query()
            ->with('seoMeta')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $blogPosts = BlogPost::query()
            ->with('seoMeta')
            ->orderByDesc('id')
            ->limit(100)
            ->get();

        return view('admin.seo.index', compact('pages', 'blogPosts'));
    }

    public function editPage(Page $page)
    {
        $metaable = $page;
        $seoMeta = $page->seoMeta;

        return view('admin.seo.edit', [
            'metaable' => $metaable,
            'seoMeta' => $seoMeta,
            'title' => "SEO: Page {$page->slug}",
            'backRoute' => route('admin.pages.edit', $page),
            'saveRoute' => route('admin.pages.seo.update', $page),
        ]);
    }

    public function updatePage(Request $request, Page $page)
    {
        $this->saveSeoMeta($request, $page);

        return redirect()->route('admin.pages.seo.edit', $page)->with('success', 'SEO meta updated successfully.');
    }

    public function editBlogPost(BlogPost $blogPost)
    {
        $metaable = $blogPost;
        $seoMeta = $blogPost->seoMeta;

        return view('admin.seo.edit', [
            'metaable' => $metaable,
            'seoMeta' => $seoMeta,
            'title' => "SEO: Blog Post {$blogPost->slug}",
            'backRoute' => route('admin.blog-posts.edit', $blogPost),
            'saveRoute' => route('admin.blog-posts.seo.update', $blogPost),
        ]);
    }

    public function updateBlogPost(Request $request, BlogPost $blogPost)
    {
        $this->saveSeoMeta($request, $blogPost);

        return redirect()->route('admin.blog-posts.seo.edit', $blogPost)->with('success', 'SEO meta updated successfully.');
    }

    private function saveSeoMeta(Request $request, Page|BlogPost $metaable): SeoMeta
    {
        $validated = $request->validate([
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

        $payload = $validated;
        unset($payload['schema_json_text']);
        $payload['schema_json'] = isset($validated['schema_json_text']) && $validated['schema_json_text'] !== ''
            ? json_decode($validated['schema_json_text'], true)
            : null;

        if ($request->hasFile('og_image')) {
            $payload['og_image_media_id'] = MediaUploader::uploadImage($request->file('og_image'), 'seo');
        }

        if ($request->hasFile('twitter_image')) {
            $payload['twitter_image_media_id'] = MediaUploader::uploadImage($request->file('twitter_image'), 'seo');
        }

        return $metaable->seoMeta()->updateOrCreate([], $payload);
    }
}
