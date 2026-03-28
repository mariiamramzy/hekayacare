@extends('website.layout.layout')

@section('title', $portfolioCase->title_ar . ' | Hekaya')
@section('meta_description', $portfolioCase->excerpt_ar ?: 'تفاصيل حالة تعافي ملهمة من مركز حكاية توضح أهمية الرعاية الشخصية والدعم المستمر وخطط التعافي طويلة الأمد.')

@php
    $shareUrl = urlencode(url()->current());
    $shareTitle = urlencode($portfolioCase->title_ar);
@endphp

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>{{ $portfolioCase->title_ar }}</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('website.portfolio') }}">قصص شفاء</a></li>
                <li><span>/</span></li>
                <li>{{ $portfolioCase->title_ar }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="portfolio-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="portfolio-details__left">
                    <div class="portfolio-details__img">
                        <img src="{{ $portfolioCase->main_image_url }}" alt="{{ $portfolioCase->title_ar }}" loading="eager" decoding="async">
                    </div>

                    @if ($portfolioCase->intro_heading)
                        <h3 class="portfolio-details__title-1">{{ $portfolioCase->intro_heading }}</h3>
                    @endif

                    @if ($portfolioCase->intro_text)
                        <p class="portfolio-details__text-1">{!! nl2br(e($portfolioCase->intro_text)) !!}</p>
                    @endif

                    @if ($portfolioCase->secondary_media_id || $portfolioCase->points_heading || $portfolioCase->points_text || $portfolioCase->point_one_ar || $portfolioCase->point_two_ar || $portfolioCase->point_three_ar)
                        <div class="portfolio-details__img-and-points">
                            <div class="portfolio-details__img-two">
                                <img src="{{ $portfolioCase->secondary_image_url }}" alt="{{ $portfolioCase->points_heading ?: $portfolioCase->title_ar }}" loading="lazy" decoding="async">
                            </div>
                            <div class="portfolio-details__points-box">
                                @if ($portfolioCase->points_heading)
                                    <h3 class="portfolio-details__points-title">{{ $portfolioCase->points_heading }}</h3>
                                @endif

                                @if ($portfolioCase->points_text)
                                    <p class="portfolio-details__points-text">{{ $portfolioCase->points_text }}</p>
                                @endif

                                @if ($portfolioCase->point_one_ar || $portfolioCase->point_two_ar || $portfolioCase->point_three_ar)
                                    <ul class="portfolio-details__points-list list-unstyled">
                                        @foreach ([$portfolioCase->point_one_ar, $portfolioCase->point_two_ar, $portfolioCase->point_three_ar] as $point)
                                            @if ($point)
                                                <li>
                                                    <div class="icon">
                                                        <span class="icon-tick"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>{{ $point }}</p>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($portfolioCase->closing_text)
                        <p class="portfolio-details__text-3">{!! nl2br(e($portfolioCase->closing_text)) !!}</p>
                    @endif
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="portfolio-details__sidebar">
                    <div class="portfolio-details__info">
                        <h3 class="portfolio-details__info-title">تفاصيل دراسة الحالة</h3>
                        <ul class="portfolio-details__info-list list-unstyled">
                            <li>
                                <div class="portfolio-details__info-left">
                                    <p>دراسة الحالة :</p>
                                </div>
                                <div class="portfolio-details__info-right">
                                    <span>{{ $portfolioCase->case_label ?: $portfolioCase->title_ar }}</span>
                                </div>
                            </li>
                            @if ($portfolioCase->started_at)
                                <li>
                                    <div class="portfolio-details__info-left">
                                        <p>تاريخ البدء :</p>
                                    </div>
                                    <div class="portfolio-details__info-right">
                                        <span>{{ $portfolioCase->started_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                </li>
                            @endif
                            @if ($portfolioCase->location_ar)
                                <li>
                                    <div class="portfolio-details__info-left">
                                        <p>الموقع :</p>
                                    </div>
                                    <div class="portfolio-details__info-right">
                                        <span>{{ $portfolioCase->location_ar }}</span>
                                    </div>
                                </li>
                            @endif
                            @if ($portfolioCase->client_name_ar)
                                <li>
                                    <div class="portfolio-details__info-left">
                                        <p>اسم العميل :</p>
                                    </div>
                                    <div class="portfolio-details__info-right">
                                        <span>{{ $portfolioCase->client_name_ar }}</span>
                                    </div>
                                </li>
                            @endif
                            @if ($portfolioCase->duration_ar)
                                <li>
                                    <div class="portfolio-details__info-left">
                                        <p>المدة الإجمالية :</p>
                                    </div>
                                    <div class="portfolio-details__info-right">
                                        <span>{{ $portfolioCase->duration_ar }}</span>
                                    </div>
                                </li>
                            @endif
                            <li style="background: #0e2c54;">
                                <div class="portfolio-details__info-left">
                                    <p>شارك :</p>
                                </div>
                                <div class="portfolio-details__info-right">
                                    <div class="site-footer__social">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fab fa-facebook"></i></a>
                                        <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                                        <a href="https://www.instagram.com/hekayacare?igsh=dzYzNDY5eXliY25x" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="portfolio-details__sidebar-img">
                        <img src="{{ $portfolioCase->sidebar_image_url }}" alt="{{ $portfolioCase->title_ar }}" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
