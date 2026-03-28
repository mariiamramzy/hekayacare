@extends('website.layout.layout')

@section('title', ($blogPost->seoMeta?->meta_title_ar ?: $blogPost->title_ar) . ' | Hekaya')
@section('meta_description', $blogPost->seoMeta?->meta_description_ar ?: ($blogPost->excerpt_ar ?: \Illuminate\Support\Str::limit(strip_tags($blogPost->content_ar), 160)))

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>المقالات</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('website.blogs') }}">المقالات</a></li>
                <li><span>/</span></li>
                <li>{{ $blogPost->title_ar }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="blog-details__left">
                    <div class="blog-details__img-box">
                        <div class="blog-details__img">
                            <img src="{{ $blogPost->cover_image_url }}" alt="{{ $blogPost->title_ar }}" decoding="async">
                        </div>
                        <div class="blog-details__date">
                            <p>
                                {{ optional($blogPost->published_at)->format('d') ?: $blogPost->created_at?->format('d') }} <br>
                                {{ optional($blogPost->published_at)->format('M') ?: $blogPost->created_at?->format('M') }}
                            </p>
                        </div>
                    </div>
                    <ul class="list-unstyled blog-details__meta">
                        <li><span><i class="fas fa-user-circle"></i> فريق حكاية</span></li>
                        @if ($blogPost->reading_time)
                            <li><span><i class="fas fa-clock"></i> {{ $blogPost->reading_time }} دقيقة قراءة</span></li>
                        @endif
                        <li><span><i class="fas fa-eye"></i> {{ $blogPost->views }} مشاهدة</span></li>
                    </ul>
                    <h3 class="blog-details__title-1">{{ $blogPost->title_ar }}</h3>

                    @if ($blogPost->excerpt_ar)
                        <p class="blog-details__text-1">{{ $blogPost->excerpt_ar }}</p>
                    @endif

                    <div class="blog-details__text-6" style="white-space: pre-line;">
                        {!! nl2br(e($blogPost->content_ar)) !!}
                    </div>

                    @php
                        $shareUrl = route('website.blog-details', $blogPost->slug);
                        $shareTitle = $blogPost->title_ar;
                        $encodedShareUrl = urlencode($shareUrl);
                        $encodedShareTitle = urlencode($shareTitle);
                    @endphp

                    <div class="blog-details__bottom">
                        <p class="blog-details__tags">
                            @if ($blogPost->category?->name_ar)
                                <a href="{{ route('website.blogs', ['q' => $blogPost->category->name_ar]) }}">{{ $blogPost->category->name_ar }}</a>
                            @endif
                            @foreach ($blogPost->tags as $tag)
                                <a href="{{ route('website.blogs', ['q' => $tag->name_ar]) }}">{{ $tag->name_ar }}</a>
                            @endforeach
                        </p>
                        <div class="blog-details__social-list">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedShareUrl }}" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ $encodedShareUrl }}&text={{ $encodedShareTitle }}" target="_blank" rel="noopener" aria-label="Share on X"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($shareTitle . ' ' . $shareUrl) }}" target="_blank" rel="noopener" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://pinterest.com/pin/create/button/?url={{ $encodedShareUrl }}&description={{ $encodedShareTitle }}" target="_blank" rel="noopener" aria-label="Share on Pinterest"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>

                    <div class="blog-details__comment-and-form">
                        <div class="comment-form">
                            <h3 class="comment-form__title">تحتاج استشارة متخصصة؟</h3>
                            <p style="margin-bottom: 20px;">يمكنك التواصل معنا مباشرة إذا كنت تريد تقييمًا مبدئيًا أو مساعدة في اختيار البرنامج العلاجي المناسب.</p>
                            <div class="comment-form__btn-box">
                                <a href="{{ route('website.contact') }}" class="comment-form__btn">اتصل بنا الآن</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar">
                    <div class="sidebar__single sidebar__search">
                        <form action="{{ route('website.blogs') }}" class="sidebar__search-form">
                            <input type="search" name="q" placeholder="ابحث...">
                            <button type="submit"><i class="icon-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="sidebar__single sidebar__category">
                        <div class="sidebar__title-box">
                            <h3 class="sidebar__title">التصنيفات</h3>
                        </div>
                        <ul class="sidebar__category-list list-unstyled">
                            @forelse ($categories as $category)
                                <li>
                                    <a href="{{ route('website.blogs', ['q' => $category->name_ar]) }}">
                                        {{ $category->name_ar }}<span>({{ $category->posts_count }})</span>
                                    </a>
                                </li>
                            @empty
                                <li><span>لا توجد تصنيفات منشورة حاليًا</span></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="sidebar__single sidebar__post">
                        <div class="sidebar__title-box">
                            <h3 class="sidebar__title">أحدث المقالات</h3>
                        </div>
                        <ul class="sidebar__post-list list-unstyled">
                            @forelse ($latestPosts as $post)
                                <li>
                                    <div class="sidebar__post-image">
                                        <img src="{{ $post->cover_image_url }}" alt="{{ $post->title_ar }}" loading="lazy" decoding="async">
                                    </div>
                                    <h3 class="sidebar__post-title">
                                        <a href="{{ route('website.blog-details', $post->slug) }}">{{ $post->title_ar }}</a>
                                    </h3>
                                </li>
                            @empty
                                <li><span>لا توجد مقالات أخرى حاليًا</span></li>
                            @endforelse
                        </ul>
                    </div>
                    @if ($tags->isNotEmpty())
                        <div class="sidebar__single sidebar__tag">
                            <div class="sidebar__title-box">
                                <h3 class="sidebar__title">الكلمات المفتاحية</h3>
                            </div>
                            <div class="sidebar__tag-list">
                                @foreach ($tags as $tag)
                                    <a href="{{ route('website.blogs', ['q' => $tag->name_ar]) }}">{{ $tag->name_ar }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
