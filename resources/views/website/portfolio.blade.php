@extends('website.layout.layout')

@section('title', 'قصص شفاء | Hekaya')
@section('meta_description', 'حكايات تعافي وشفاء ملهمة من مركز حكاية، تعكس رحلة التغيير والدعم النفسي والتأهيل نحو حياة أكثر استقرارًا.')

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>حكاية تعافي</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li>حكاية تعافي</li>
            </ul>
        </div>
    </div>
</section>

<section class="portfolio-page-one">
    <div class="container">
        <div class="portfolio-page-one__bottom">
            <div class="row">
                @forelse ($portfolioCases as $portfolioCase)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="portfolio-one__single">
                            <div class="portfolio-one__img-box">
                                <div class="portfolio-one__img">
                                    <img src="{{ $portfolioCase->cover_image_url }}" alt="{{ $portfolioCase->card_title }}" loading="lazy" decoding="async">
                                </div>
                                <div class="portfolio-one__content">
                                    <div class="portfolio-one__content-inner">
                                        <p class="portfolio-one__sub-title">{{ $portfolioCase->card_title }}</p>
                                    </div>
                                    <div class="portfolio-one__arrow">
                                        <a href="{{ route('website.portfolio-details', $portfolioCase) }}" aria-label="{{ $portfolioCase->title_ar }}">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light text-center">لا توجد قصص شفاء مضافة حاليًا.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
