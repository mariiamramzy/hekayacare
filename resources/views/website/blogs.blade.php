@extends('website.layout.layout')

@section('title', 'المقالات | Hekaya')
@section('meta_description', 'مقالات حكاية عن علاج الإدمان والصحة النفسية والتعافي وبناء حياة أكثر توازنًا ووعيًا.')

@push('styles')
<style>
    .blog-live-search-wrapper {
        position: relative;
    }

    .blog-live-search-loading {
        display: none;
        text-align: center;
        margin-top: 16px;
        color: #5f6f89;
        font-weight: 600;
    }

    .blog-live-search-wrapper.is-loading .blog-live-search-loading {
        display: block;
    }
</style>
@endpush

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>المقالات</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li>المقالات</li>
            </ul>
        </div>
    </div>
</section>

<section class="blog-three">
    <div class="container">
        <div class="section-title-three text-center">
            <span class="section-title-three__tagline">مدونة حكاية</span>
            <h2 class="section-title-three__title">مقالات تهمك في رحلة التغيير</h2>
        </div>

        <div class="row justify-content-center" style="margin-bottom: 40px;">
            <div class="col-xl-6 col-lg-8">
                <form action="{{ route('website.blogs') }}" method="get" class="sidebar__search-form" id="blog-live-search-form" autocomplete="off">
                    <input type="search" name="q" id="blog-live-search-input" value="{{ $search }}" placeholder="ابحث في المقالات...">
                    <button type="submit" aria-label="search"><i class="icon-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

        <div class="blog-live-search-wrapper" id="blog-live-search-wrapper" data-endpoint="{{ route('website.blogs') }}">
            @include('website.partials.blog-list', ['blogPosts' => $blogPosts])
            <div class="blog-live-search-loading">جاري البحث...</div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    (function () {
        const form = document.getElementById('blog-live-search-form');
        const input = document.getElementById('blog-live-search-input');
        const wrapper = document.getElementById('blog-live-search-wrapper');

        if (!form || !input || !wrapper) {
            return;
        }

        const endpoint = wrapper.dataset.endpoint;
        let debounceTimer = null;
        let activeController = null;

        const loadingMarkup = '<div class="blog-live-search-loading">جاري البحث...</div>';

        const loadResults = (url) => {
            if (activeController) {
                activeController.abort();
            }

            activeController = new AbortController();
            wrapper.classList.add('is-loading');

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                signal: activeController.signal
            })
                .then((response) => response.json())
                .then((data) => {
                    wrapper.innerHTML = data.html + loadingMarkup;
                    wrapper.classList.remove('is-loading');
                })
                .catch((error) => {
                    if (error.name !== 'AbortError') {
                        wrapper.classList.remove('is-loading');
                    }
                });
        };

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const query = input.value.trim();
            loadResults(query ? `${endpoint}?q=${encodeURIComponent(query)}` : endpoint);
        });

        input.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                const query = input.value.trim();
                loadResults(query ? `${endpoint}?q=${encodeURIComponent(query)}` : endpoint);
            }, 300);
        });

        wrapper.addEventListener('click', function (event) {
            const link = event.target.closest('#blog-pagination a');
            if (!link) {
                return;
            }

            event.preventDefault();
            loadResults(link.href);
        });
    })();
</script>
@endpush
