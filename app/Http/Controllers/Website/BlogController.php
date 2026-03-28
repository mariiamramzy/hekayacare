<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        $blogPosts = BlogPost::query()
            ->with(['category', 'coverMedia', 'tags'])
            ->published()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder
                        ->where('title_ar', 'like', "%{$search}%")
                        ->orWhere('excerpt_ar', 'like', "%{$search}%")
                        ->orWhere('content_ar', 'like', "%{$search}%");
                });
            })
            ->latestPublished()
            ->paginate(9)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('website.partials.blog-list', compact('blogPosts'))->render(),
            ]);
        }

        return view('website.blogs', compact('blogPosts', 'search'));
    }

    public function show(BlogPost $blogPost)
    {
        $blogPost->load(['category', 'tags', 'coverMedia', 'seoMeta']);

        if (
            $blogPost->status !== 'published' ||
            ($blogPost->published_at && $blogPost->published_at->isFuture())
        ) {
            throw new NotFoundHttpException();
        }

        $latestPosts = Cache::remember('website.blog.latest_posts.' . $blogPost->id, now()->addMinutes(15), function () use ($blogPost) {
            return BlogPost::query()
                ->with(['coverMedia'])
                ->published()
                ->whereKeyNot($blogPost->id)
                ->latestPublished()
                ->take(3)
                ->get();
        });

        $categories = Cache::remember('website.blog.sidebar.categories', now()->addMinutes(15), function () {
            return BlogCategory::query()
                ->where('is_active', true)
                ->whereHas('posts', function ($query) {
                    $query->published();
                })
                ->withCount(['posts' => function ($query) {
                    $query->published();
                }])
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();
        });

        $tags = Cache::remember('website.blog.sidebar.tags', now()->addMinutes(15), function () {
            return BlogTag::query()
                ->whereHas('posts', function ($query) {
                    $query->published();
                })
                ->orderBy('name_ar')
                ->get();
        });

        $blogPost->increment('views');
        $blogPost->views = (int) $blogPost->views + 1;

        return view('website.blog-details', compact('blogPost', 'latestPosts', 'categories', 'tags'));
    }
}
