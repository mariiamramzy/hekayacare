@extends('website.layout.layout')

@section('title', $service['page_title'].' | Hekaya')
@section('meta_description', $service['meta_description'])

@push('styles')
<style>
    .page-header__inner h2 {
        font-size: clamp(32px, 4.8vw, 56px);
        line-height: 1.2;
        max-width: 820px;
        margin: 0 auto 18px;
    }

    .thm-breadcrumb li,
    .thm-breadcrumb li a {
        font-size: 15px;
    }

    .services-details {
        padding: 120px 0;
    }

    .services-details__left {
        padding-inline-end: 22px;
    }

    .services-details__img {
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 24px 70px rgba(21, 33, 52, 0.12);
        margin-bottom: 34px;
    }

    .services-details__img img {
        min-height: 360px;
        object-fit: cover;
    }

    .services-details__title {
        font-size: clamp(28px, 3vw, 42px);
        line-height: 1.35;
        margin-bottom: 18px;
        color: #16243b;
    }

    .services-details__text-1,
    .services-details__tab-content-text {
        font-size: 18px;
        line-height: 2;
        color: #4b5568;
    }

    .services-details__text-1 {
        margin-bottom: 28px;
    }

    .services-details__points li {
        align-items: flex-start;
        gap: 12px;
        padding: 12px 18px;
        border: 1px solid rgba(25, 119, 107, 0.12);
        border-radius: 16px;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbfb 100%);
    }

    .services-details__points li + li {
        margin-top: 14px;
    }

    .services-details__points li .icon {
        flex: 0 0 40px;
        width: 40px;
        height: 40px;
        margin-top: 0;
        background: rgba(25, 119, 107, 0.1);
    }

    .services-details__points li .icon span {
        font-size: 15px;
        color: #19776b;
    }

    .services-details__points li .text p {
        line-height: 1.6;
    }

    .services-details__points li .text p,
    .services-details__points-two-text p,
    .services-details__sidebar-category-list li a,
    .services-details__input-box input,
    .services-details__input-box textarea {
        font-size: 16px;
        line-height: 1.9;
    }

    .services-details__points li .text p,
    .services-details__points-two-text p,
    .services-details__sidebar-category-list li a {
        color: #2f3d55;
    }

    .services-details__tab-box {
        margin-top: 42px;
    }

    .services-details__tab-box .tab-buttons {
        gap: 12px;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-bottom: 24px;
    }

    .services-details__tab-box .tab-buttons .tab-btn {
        margin: 0;
        width: 100%;
        max-width: 100%;
    }

    .services-details__tab-box .tab-buttons .tab-btn span {
        width: 100%;
        min-width: 0;
        padding: 14px 12px;
        font-size: 15px;
        line-height: 1.5;
        border-radius: 14px;
        border: 1px solid #e3e8ef;
        background: #f5f8f8;
        color: #6f788b;
        box-shadow: 0 8px 20px rgba(16, 24, 40, 0.05);
    }

    .services-details__tab-box .tab-buttons .tab-btn span:before {
        display: none !important;
        content: none !important;
    }

    .services-details__tab-box .tab-buttons .tab-btn.active-btn span {
        color: #fff;
        background: #12366a;
        border-color: #12366a;
        box-shadow: 0 12px 26px rgba(18, 54, 106, 0.28);
    }

    .services-details__tab-box .tabs-content {
        padding: 34px 34px 20px;
        border-radius: 28px;
        box-shadow: 0 18px 55px rgba(16, 24, 40, 0.08);
        background: #fff;
    }

    .services-details__points-two li {
        align-items: flex-start;
        gap: 14px;
    }

    .services-details__points-two li + li {
        margin-top: 18px;
    }

    .services-details__points-two-shape-1 {
        margin-top: 12px;
        flex: 0 0 10px;
    }

    .services-details__sidebar {
        position: sticky;
        top: 120px;
    }

    .services-details__sidebar-single {
        border-radius: 24px;
        box-shadow: 0 18px 55px rgba(16, 24, 40, 0.08);
        overflow: hidden;
    }

    .services-details__sidebar-title {
        font-size: 24px;
        line-height: 1.5;
        margin-bottom: 18px;
    }

    .services-details__sidebar-search,
    .services-details__sidebar-category,
    .services-details__have-your-question {
        padding: 30px 28px;
    }

    .services-details__sidebar-search-form {
        position: relative;
    }

    .services-details__sidebar-search-form input[type="search"],
    .services-details__input-box input[type="text"],
    .services-details__input-box input[type="tel"],
    .services-details__input-box input[type="email"],
    .services-details__input-box textarea {
        border-radius: 16px;
        font-size: 16px;
        line-height: 1.7;
        padding-right: 22px;
        padding-left: 60px;
    }

    .services-details__sidebar-search-form button[type="submit"] {
        position: absolute;
        left: 10px;
        right: auto;
        top: 50%;
        transform: translateY(-50%);
        width: 42px;
        height: 42px;
        border: 0;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f1f6f5;
        color: #19776b;
        font-size: 15px;
        padding: 0;
        z-index: 2;
    }

    .services-details__sidebar-search-form button[type="submit"]:hover {
        background: #19776b;
        color: #fff;
    }

    .services-details__input-box textarea {
        min-height: 160px;
        padding-top: 18px;
    }

    .services-details__select-box .nice-select,
    .services-details__select-box select {
        width: 100%;
        height: 64px;
        border: 1px solid #e3e8ef;
        border-radius: 16px;
        padding: 0 20px;
        font-size: 16px;
        color: #5f6980;
        background: #fff;
    }

    .services-details__select-box .nice-select {
        display: flex;
        align-items: center;
    }

    .services-details__radio-label {
        display: block;
        margin-bottom: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #16243b;
    }

    .services-details__radio-group {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .services-details__radio-option {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        border: 1px solid #e3e8ef;
        border-radius: 14px;
        font-size: 15px;
        color: #42526b;
        background: #fff;
        cursor: pointer;
    }

    .services-details__radio-option input {
        margin: 0;
    }

    .services-details__sidebar-category-list li a {
        padding: 16px 20px;
        border-radius: 16px;
    }

    .services-details__sidebar-category-list li a span {
        position: absolute;
        left: 20px;
        right: auto;
        top: 50%;
        transform: translateY(-50%);
        font-size: 17px;
        color: var(--hekaya-black);
        font-weight: 600;
        transition: all 500ms ease;
    }

    .services-details__sidebar-category-list li + li {
        margin-top: 12px;
    }

    .services-details__btn-box {
        margin-top: 20px;
    }

    .services-details__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 58px;
        padding: 14px 28px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0;
    }

    .services-details__btn span {
        position: static;
        font-size: 14px;
    }

    .services-details__gallery-grid .gallery-page__img {
        box-shadow: 0 16px 45px rgba(16, 24, 40, 0.1);
    }

    .services-details__gallery-section {
        margin-top: 44px;
        padding: 34px;
        border-radius: 28px;
        background: #fff;
        box-shadow: 0 18px 55px rgba(16, 24, 40, 0.08);
    }

    .services-details__gallery-title {
        margin: 0 0 12px;
        font-size: clamp(24px, 2.2vw, 34px);
        line-height: 1.4;
        color: #16243b;
    }

    .services-details__gallery-text {
        margin: 0 0 26px;
        font-size: 17px;
        line-height: 1.9;
        color: #5f6980;
    }

    .services-details__gallery-grid .gallery-page__img img {
        width: 100%;
        height: 390px;
        object-fit: cover;
        border-radius: 28px;
    }

    .services-details__gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        margin: 0;
    }

    .services-details__gallery-grid > [class*="col-"] {
        width: 100%;
        max-width: 100%;
        padding: 0;
    }

    .services-details__gallery-grid .gallery-page__single {
        margin-bottom: 0;
    }

    .services-details__gallery-grid .gallery-page__img {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        box-shadow: none;
    }

    .services-details__gallery-grid .gallery-page__icon {
        display: none;
    }

    .services-details__gallery-grid .gallery-page__icon a {
        width: 52px;
        height: 52px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #ffffff;
        color: var(--hekaya-base, #19776b);
    }

    .services-details__gallery-grid .gallery-page__img:hover .gallery-page__icon {
        opacity: 1;
    }

    .services-details__sidebar-search-form input[type="search"]::placeholder,
    .services-details__input-box input::placeholder,
    .services-details__input-box textarea::placeholder {
        color: #5b6472;
    }

    /* Service details form look-and-feel aligned with site style */
    .services-details__have-your-question {
        background: linear-gradient(180deg, #0f2c56 0%, #12366a 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .services-details__have-your-question .services-details__sidebar-title {
        color: #fff;
        margin-bottom: 22px;
    }

    .services-details__comment-form .services-details__input-box {
        margin-bottom: 12px;
    }

    .services-details__comment-form .services-details__input-box input[type="text"],
    .services-details__comment-form .services-details__input-box input[type="tel"],
    .services-details__comment-form .services-details__input-box input[type="email"],
    .services-details__comment-form .services-details__input-box textarea,
    .services-details__comment-form .services-details__select-box .nice-select,
    .services-details__comment-form .services-details__select-box select {
        width: 100%;
        border: 1px solid rgba(255, 255, 255, 0.18);
        background: rgba(255, 255, 255, 0.96);
        border-radius: 12px;
        color: #1f2d46;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.6;
    }

    .services-details__comment-form .services-details__input-box input[type="text"],
    .services-details__comment-form .services-details__input-box input[type="tel"],
    .services-details__comment-form .services-details__input-box input[type="email"] {
        height: 56px;
        padding: 0 48px 0 16px;
    }

    .services-details__comment-form .services-details__input-box input[type="tel"] {
        text-align: right;
        direction: rtl;
    }

    .services-details__comment-form .services-details__input-box.text-message-box textarea {
        min-height: 124px;
        height: 124px;
        resize: vertical;
        padding: 12px 48px 12px 16px;
    }

    .services-details__comment-form .services-details__input-box.text-message-box {
        margin-top: 8px;
    }

    .services-details__comment-form .services-details__input-box-icon,
    .services-details__comment-form .services-details__input-box-icon-2 {
        position: absolute;
        right: 14px;
        left: auto;
        width: 20px;
        height: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #4e607e;
        pointer-events: none;
    }

    .services-details__comment-form .services-details__input-box-icon {
        top: 50%;
        transform: translateY(-50%);
    }

    .services-details__comment-form .services-details__input-box-icon-2 {
        top: 14px;
        transform: none;
    }

    .services-details__comment-form .services-details__input-box-icon span,
    .services-details__comment-form .services-details__input-box-icon-2 span {
        color: inherit;
        font-size: 15px;
        line-height: 1;
    }

    .services-details__comment-form .services-details__select-box .nice-select,
    .services-details__comment-form .services-details__select-box select {
        height: 56px;
        padding: 0 16px;
        line-height: 56px;
    }

    .services-details__comment-form .services-details__select-box .nice-select:after {
        left: 14px;
        right: auto;
        margin-top: -3px;
    }

    .services-details__comment-form .services-details__select-box .nice-select .current {
        line-height: 56px;
    }

    .services-details__comment-form .services-details__service-type-row {
        margin-top: 8px;
    }

    .services-details__comment-form .services-details__radio-label {
        color: #fff;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .services-details__comment-form .services-details__radio-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .services-details__comment-form .services-details__radio-option {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.28);
        border-radius: 12px;
        color: #fff;
        padding: 10px 12px;
        min-height: 44px;
    }

    .services-details__comment-form .services-details__radio-option input[type="radio"] {
        margin: 0;
        accent-color: #67b9ad;
    }

    .services-details__comment-form .services-details__radio-option-label {
        font-size: 14px;
        line-height: 1.4;
    }

    .services-details__comment-form .services-details__btn {
        width: 100%;
        min-height: 52px;
        border-radius: 12px;
        border: 0;
        background: linear-gradient(90deg, #19776b 0%, #2a9f8f 100%);
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        box-shadow: 0 12px 28px rgba(10, 28, 55, 0.35);
    }

    .services-details__comment-form .services-details__btn:hover {
        background: linear-gradient(90deg, #1e8a7c 0%, #34b3a1 100%);
        transform: translateY(-1px);
    }

    .services-details__comment-form .services-details__form-alert-wrap .success,
    .services-details__comment-form .services-details__form-alert-wrap .error {
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    @media (max-width: 991px) {
        .services-details {
            padding: 90px 0;
        }

        .services-details__left {
            padding-inline-end: 0;
            margin-bottom: 34px;
        }

        .services-details__sidebar {
            position: static;
        }

        .services-details__tab-box .tabs-content {
            padding: 24px 22px 14px;
        }

        .services-details__gallery-section {
            padding: 24px 22px;
        }

        .services-details__gallery-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .services-details__gallery-grid .gallery-page__img img {
            height: 260px;
            border-radius: 18px;
        }
    }

    @media (max-width: 767px) {
        .page-header__inner h2 {
            font-size: 30px;
            line-height: 1.35;
        }

        .services-details__title {
            font-size: 26px;
        }

        .services-details__text-1,
        .services-details__tab-content-text {
            font-size: 16px;
            line-height: 1.9;
        }

        .services-details__points li {
            padding: 16px 16px;
            gap: 14px;
        }

        .services-details__points li .icon {
            flex-basis: 44px;
            width: 44px;
            height: 44px;
        }

        .services-details__points li .text p,
        .services-details__points-two-text p,
        .services-details__sidebar-category-list li a,
        .services-details__input-box input,
        .services-details__select-box .nice-select,
        .services-details__select-box select,
        .services-details__input-box textarea {
            font-size: 15px;
            line-height: 1.85;
        }

        .services-details__tab-box .tab-buttons {
            gap: 10px;
            grid-template-columns: 1fr;
        }

        .services-details__tab-box .tab-buttons .tab-btn {
            max-width: 100%;
            width: 100%;
        }

        .services-details__tab-box .tab-buttons .tab-btn span {
            width: 100%;
            text-align: center;
            padding: 14px 16px;
            font-size: 15px;
        }

        .services-details__sidebar-title {
            font-size: 21px;
        }

        .services-details__sidebar-search-form button[type="submit"] {
            left: 8px;
            width: 38px;
            height: 38px;
        }

        .services-details__sidebar-search,
        .services-details__sidebar-category,
        .services-details__have-your-question {
            padding: 24px 18px;
        }

        .services-details__comment-form .services-details__radio-option {
            width: 100%;
        }

        .services-details__btn {
            width: 100%;
            font-size: 15px;
            min-height: 54px;
        }

        .services-details__radio-option {
            width: 100%;
            justify-content: flex-start;
        }

        .services-details__gallery-text {
            font-size: 15px;
        }

        .services-details__gallery-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .services-details__gallery-grid .gallery-page__img img {
            height: 150px;
            border-radius: 14px;
        }
    }
</style>
@endpush

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>{{ $service['title'] }}</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('website.services') }}">الخدمات</a></li>
                <li><span>/</span></li>
                <li>{{ $service['title'] }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="services-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="services-details__left">
                    <div class="services-details__img">
                        <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}">
                    </div>
                    <h3 class="services-details__title">{{ $service['page_title'] }}</h3>
                    <p class="services-details__text-1">{{ $service['highlights_intro'] }}</p>

                    <ul class="services-details__points list-unstyled">
                        @foreach ($service['highlights'] as $highlight)
                            <li>
                                <div class="icon">
                                    <span class="icon-tick"></span>
                                </div>
                                <div class="text">
                                    <p>{{ $highlight }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="services-details__tab-box tabs-box">
                        <ul class="tab-buttons clearfix list-unstyled">
                            @foreach ($service['tabs'] as $tab)
                                <li data-tab="#{{ $tab['id'] }}" class="tab-btn {{ $loop->first ? 'active-btn' : '' }}">
                                    <span>{{ $tab['label'] }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tabs-content">
                            @foreach ($service['tabs'] as $tab)
                                <div class="tab {{ $loop->first ? 'active-tab' : '' }}" id="{{ $tab['id'] }}">
                                    <div class="services-details__tab-content-box">
                                        <p class="services-details__tab-content-text">{{ $tab['intro'] }}</p>

                                        @if (! empty($tab['points']))
                                            <ul class="services-details__points-two list-unstyled">
                                                @foreach ($tab['points'] as $point)
                                                    <li>
                                                        <div class="services-details__points-two-shape-1"></div>
                                                        <div class="services-details__points-two-text">
                                                            <p>{{ $point }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if (false && ! empty($service['has_gallery_section']) && ! empty($galleryImages))
                        <div class="services-details__gallery-section">
                            <h3 class="services-details__gallery-title">معرض صور الخدمة</h3>
                            <p class="services-details__gallery-text">بعض الصور من أجواء المركز والخدمة، ويمكنك مشاهدة المزيد من صور المركز بالكامل من المعرض.</p>

                            <div class="services-details__gallery-grid">
                                @foreach ($galleryImages as $image)
                                    <div class="col-xl-4 col-md-6">
                                        <div class="gallery-page__single">
                                            <div class="gallery-page__img">
                                                <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" loading="lazy" decoding="async">
                                                <div class="gallery-page__icon">
                                                    <a class="img-popup" href="{{ $image['url'] }}" aria-label="عرض الصورة بالحجم الكامل"><span class="icon-plus"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-12">
                                    <div class="services-details__btn-box text-center">
                                        <a href="{{ route('website.gallery') }}" class="services-details__btn">
                                            المزيد من صور المركز
                                            <span class="icon-right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="services-details__sidebar">
                    <div class="services-details__sidebar-single services-details__sidebar-search">
                        <form action="{{ route('website.search') }}" method="GET" class="services-details__sidebar-search-form">
                            <input type="search" name="q" placeholder="ابحث في الموقع..." value="{{ request('q') }}">
                            <button type="submit" aria-label="بحث في الموقع"><i class="icon-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <div class="services-details__sidebar-single services-details__sidebar-category">
                        <h3 class="services-details__sidebar-title">المزيد من الخدمات</h3>
                        <ul class="services-details__sidebar-category-list list-unstyled">
                            @foreach ($services as $serviceItem)
                                <li class="{{ $serviceItem['slug'] === $service['slug'] ? 'active' : '' }}">
                                    <a href="{{ route('website.service-details', $serviceItem['slug']) }}">
                                        {{ $serviceItem['title'] }}
                                        <span class="icon-right-arrow1"></span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="services-details__sidebar-single services-details__have-your-question">
                        <h3 class="services-details__sidebar-title">احجز استشارة الخدمة الآن</h3>
                        <div class="services-details__comment-form">
                            <div class="services-details__form-alert-wrap">
                                @if (session('success'))
                                    <div class="success">{{ session('success') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div class="error">{{ $errors->first() }}</div>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('website.contact.store') }}" id="service-contact-form">
                                @csrf

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="services-details__input-box">
                                            <input type="text" placeholder="الاسم" name="name" value="{{ old('name') }}">
                                            <div class="services-details__input-box-icon">
                                                <span class="icon-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="services-details__input-box">
                                            <input type="tel" placeholder="رقم التليفون" name="mobile" value="{{ old('mobile') }}">
                                            <div class="services-details__input-box-icon">
                                                <span class="icon-telephone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="services-details__input-box">
                                            <input type="text" placeholder="العنوان (المحافظة)" name="address" value="{{ old('address') }}">
                                            <div class="services-details__input-box-icon">
                                                <span class="fas fa-map-marker-alt"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="services-details__input-box services-details__select-box">
                                            <select class="wide" name="gender">
                                                <option data-display="النوع"></option>
                                                <option value="1" @selected(old('gender') === '1')>ذكر</option>
                                                <option value="2" @selected(old('gender') === '2')>أنثى</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="services-details__input-box" style="padding: 0; background: transparent;">
                                            <label class="services-details__radio-label">هل أنت المريض؟</label>
                                            <div class="services-details__radio-group">
                                                <label class="services-details__radio-option">
                                                    <input type="radio" name="is_patient" value="1" @checked(old('is_patient') === '1')>
                                                    <span class="services-details__radio-option-label">نعم</span>
                                                </label>
                                                <label class="services-details__radio-option">
                                                    <input type="radio" name="is_patient" value="2" @checked(old('is_patient') === '2')>
                                                    <span class="services-details__radio-option-label">شخص ينوب عنه</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row services-details__service-type-row">
                                    <div class="col-xl-12">
                                        <div class="services-details__input-box services-details__select-box">
                                            <select class="wide" name="service_type">
                                                <option data-display="نوع الخدمة"></option>
                                                <option value="detox" @selected(old('service_type', $service['service_type']) === 'detox')>سحب السموم (Detox)</option>
                                                <option value="behavioral_addiction" @selected(old('service_type', $service['service_type']) === 'behavioral_addiction')>علاج الإدمان السلوكي</option>
                                                <option value="rehabilitation" @selected(old('service_type', $service['service_type']) === 'rehabilitation')>التأهيل النفسي والإقامة الكاملة</option>
                                                <option value="dual_diagnosis" @selected(old('service_type', $service['service_type']) === 'dual_diagnosis')>علاج التشخيص المزدوج (Dual Diagnosis)</option>
                                                <option value="consultations" @selected(old('service_type', $service['service_type']) === 'consultations')>الاستشارات النفسية والأسرية</option>
                                                <option value="relapse_prevention" @selected(old('service_type', $service['service_type']) === 'relapse_prevention')>برامج منع الانتكاسة</option>
                                                <option value="workshops" @selected(old('service_type', $service['service_type']) === 'workshops')>برامج التدريب وورش العمل</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="services-details__input-box text-message-box">
                                            <textarea name="message" placeholder="ملاحظات">{{ old('message') }}</textarea>
                                            <div class="services-details__input-box-icon-2">
                                                <span class="icon-message"></span>
                                            </div>
                                        </div>
                                        <div class="services-details__btn-box">
                                            <button type="submit" class="services-details__btn">
                                                احجز موعد الآن
                                                <span class="icon-right"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (! empty($service['has_gallery_section']) && ! empty($galleryImages))
            <div class="services-details__gallery-section">
                <h3 class="services-details__gallery-title">معرض صور الخدمة</h3>
                <p class="services-details__gallery-text">بعض الصور من أجواء المركز والخدمة، ويمكنك مشاهدة المزيد من صور المركز بالكامل من المعرض.</p>

                <div class="services-details__gallery-grid">
                    @foreach ($galleryImages as $image)
                        <div class="col-xl-4 col-md-6">
                            <div class="gallery-page__single">
                                <div class="gallery-page__img">
                                    <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" loading="lazy" decoding="async">
                                    <div class="gallery-page__icon">
                                        <a class="img-popup" href="{{ $image['url'] }}" aria-label="عرض الصورة بالحجم الكامل"><span class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-12">
                        <div class="services-details__btn-box text-center">
                            <a href="{{ route('website.gallery') }}" class="services-details__btn">
                                المزيد من صور المركز
                                <span class="icon-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    (function () {
        const form = document.getElementById('service-contact-form');
        if (!form) {
            return;
        }

        const alertWrap = form.parentElement.querySelector('.services-details__form-alert-wrap');
        const submitButton = form.querySelector('button[type="submit"]');
        const serviceTypeSelect = form.querySelector('select[name="service_type"]');

        if (serviceTypeSelect) {
            const servicesFromDb = @json($services);
            const selectedValue = serviceTypeSelect.value || '{{ old('service_type', $service['service_type']) }}';
            const placeholderText = 'نوع الخدمة';

            serviceTypeSelect.innerHTML = '';

            const placeholderOption = document.createElement('option');
            placeholderOption.setAttribute('data-display', placeholderText);
            placeholderOption.textContent = placeholderText;
            serviceTypeSelect.appendChild(placeholderOption);

            servicesFromDb.forEach(function (serviceOption) {
                const optionValue = serviceOption.service_type || serviceOption.slug;
                const option = document.createElement('option');
                option.value = optionValue;
                option.textContent = serviceOption.title;

                if (selectedValue && selectedValue === optionValue) {
                    option.selected = true;
                }

                serviceTypeSelect.appendChild(option);
            });

            if (window.jQuery && window.jQuery.fn && window.jQuery.fn.niceSelect) {
                window.jQuery(serviceTypeSelect).niceSelect('update');
            }
        }

        const renderAlert = function (type, message) {
            if (!alertWrap) {
                return;
            }

            alertWrap.innerHTML = '<div class="' + type + '">' + message + '</div>';
        };

        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            if (submitButton) {
                submitButton.disabled = true;
            }

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(form),
                });

                const data = await response.json();

                if (!response.ok) {
                    const firstError = data.errors ? Object.values(data.errors)[0][0] : 'حدث خطأ أثناء الإرسال.';
                    renderAlert('error', firstError);
                    return;
                }

                form.reset();
                renderAlert('success', data.message || 'تم إرسال البيانات للمركز وسيتم التواصل معك في أقرب وقت.');

                if (window.jQuery && window.jQuery.fn && window.jQuery.fn.niceSelect) {
                    window.jQuery(form).find('select').niceSelect('update');
                }
            } catch (error) {
                renderAlert('error', 'حدث خطأ أثناء الإرسال. حاول مرة أخرى.');
            } finally {
                if (submitButton) {
                    submitButton.disabled = false;
                }
            }
        });
    })();
</script>
@endpush
