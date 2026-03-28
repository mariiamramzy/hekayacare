@extends('website.layout.layout')

@section('title', 'نتائج البحث | Hekaya')
@section('meta_description', 'نتائج البحث داخل موقع مركز حكاية.')

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>نتائج البحث</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li>نتائج البحث</li>
            </ul>
        </div>
    </div>
</section>

<section class="blog-three" style="padding-top: 120px; padding-bottom: 120px;">
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 40px;">
            <div class="col-xl-7 col-lg-9">
                <form action="{{ route('website.search') }}" method="get" class="sidebar__search-form">
                    <input type="search" name="q" value="{{ $query }}" placeholder="ابحث في الموقع كله...">
                    <button type="submit"><i class="icon-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

        <div class="section-title-three text-center">
            <span class="section-title-three__tagline">بحث الموقع</span>
            <h2 class="section-title-three__title">نتائج البحث عن: "{{ $query }}"</h2>
        </div>

        @if($results->isEmpty())
            <div class="text-center" style="padding: 40px 0;">
                <h3 style="margin-bottom: 12px;">لا توجد نتائج مطابقة</h3>
                <p>جرّب كلمات أخرى أو ابحث باسم الخدمة أو المقال أو السؤال الشائع.</p>
            </div>
        @else
            <div class="row">
                @foreach($results as $result)
                    <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="{{ (($loop->index % 6) + 1) * 100 }}ms">
                        <div class="blog-three__right" style="margin-bottom: 24px;">
                            <div class="blog-three__right-content" style="min-height: 100%;">
                                <p style="margin-bottom: 10px; color: #19776b; font-weight: 700;">{{ $result['label'] }}</p>
                                <h3 class="blog-three__title-one">
                                    <a href="{{ $result['url'] }}">{{ $result['title'] }}</a>
                                </h3>
                                @if(!empty($result['snippet']))
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($result['snippet']), 170) }}</p>
                                @endif
                                <ul class="blog-three__meta list-unstyled">
                                    <li>
                                        <a href="{{ $result['url'] }}"><i class="fas fa-wave-square"></i>اذهب إلى الصفحة</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
