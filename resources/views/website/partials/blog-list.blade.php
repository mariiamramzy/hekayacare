<div class="row" id="blog-results">
    @forelse ($blogPosts as $index => $blogPost)
        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="{{ (($index % 9) + 1) * 100 }}ms">
            <div class="blog-three__right">
                <div class="blog-three__right-img">
                    <img src="{{ $blogPost->cover_image_url }}" alt="{{ $blogPost->title_ar }}" loading="lazy" decoding="async">
                </div>
                <div class="blog-three__right-content">
                    @if ($blogPost->category?->name_ar)
                        <p style="margin-bottom: 10px; color: #19776b; font-weight: 700;">{{ $blogPost->category->name_ar }}</p>
                    @endif

                    <h3 class="blog-three__title-one">
                        <a href="{{ route('website.blog-details', $blogPost->slug) }}">{{ $blogPost->title_ar }}</a>
                    </h3>

                    @if ($blogPost->excerpt_ar)
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($blogPost->excerpt_ar), 140) }}</p>
                    @endif

                    <ul class="blog-three__meta list-unstyled">
                        <li>
                            <span>
                                <i class="fas fa-calendar-alt"></i>
                                {{ optional($blogPost->published_at)->format('Y-m-d') ?: $blogPost->created_at?->format('Y-m-d') }}
                            </span>
                        </li>
                        <li>
                            <a href="{{ route('website.blog-details', $blogPost->slug) }}"><i class="fas fa-wave-square"></i>المزيد</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center" style="padding: 40px 0;">
                <h3 style="margin-bottom: 12px;">لا توجد مقالات منشورة حاليًا</h3>
                <p>يمكنك العودة لاحقًا أو تعديل البحث لتجربة كلمات أخرى.</p>
            </div>
        </div>
    @endforelse

    @if ($blogPosts->hasPages())
        <div class="blog-page__pagination" id="blog-pagination">
            <ul class="pg-pagination list-unstyled">
                @if ($blogPosts->onFirstPage())
                    <li class="prev"><span aria-label="prev">Prev</span></li>
                @else
                    <li class="prev"><a href="{{ $blogPosts->previousPageUrl() }}" aria-label="prev">Prev</a></li>
                @endif

                @foreach ($blogPosts->getUrlRange(1, $blogPosts->lastPage()) as $page => $url)
                    <li class="count">
                        <a href="{{ $url }}" class="{{ $page === $blogPosts->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($blogPosts->hasMorePages())
                    <li class="next"><a href="{{ $blogPosts->nextPageUrl() }}" aria-label="Next">Next</a></li>
                @else
                    <li class="next"><span aria-label="Next">Next</span></li>
                @endif
            </ul>
        </div>
    @endif
</div>
