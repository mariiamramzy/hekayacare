@extends('website.layout.layout')

@section('title', 'اتصل بنا | Hekaya')
@section('meta_description', 'تواصل مع مركز حكاية للاستفسار عن خدمات علاج الإدمان والصحة النفسية واحجز استشارتك بسهولة.')

@push('styles')
<style>
    .contact-page__right .success,
    .contact-page__right .error {
        margin-bottom: 20px;
    }

    .contact-page__form-box .footer-widget__appointment-input-box input,
    .contact-page__form-box .footer-widget__appointment-input-box textarea {
        width: 100%;
    }

    .contact-page__form-box .footer-widget__appointment-input-box textarea {
        min-height: 180px;
    }
</style>
@endpush

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>اتصل بنا</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li>اتصل بنا</li>
            </ul>
        </div>
    </div>
</section>

<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="contact-page__left">
                    <div class="contact-page__contact-list-box">
                        <h3 class="contact-page__contact-title">اتصل بنا</h3>
                        <ul class="list-unstyled contact-page__contact-list">
                            <li>
                                <div class="contact-page__contact-list-icon">
                                    <span class="icon-map-pin"></span>
                                </div>
                                <div class="contact-page__contact-list-content">
                                    <h4 class="contact-page__contact-list-title">العنوان</h4>
                                    <p class="contact-page__contact-list-text">
                                        727 الحي الثاني، قسم أول أكتوبر،<br>
                                        مدينة السادس من أكتوبر، الجيزة.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-page__contact-list-icon">
                                    <span class="icon-call"></span>
                                </div>
                                <div class="contact-page__contact-list-content">
                                    <h4 class="contact-page__contact-list-title">التليفون</h4>
                                    <p class="contact-page__contact-list-text">
                                        <a href="tel:01554488501">(2+)015-5448-8501</a>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-page__contact-list-icon">
                                    <span class="icon-black-back-closed-envelope-shape"></span>
                                </div>
                                <div class="contact-page__contact-list-content">
                                    <h4 class="contact-page__contact-list-title">البريد الإلكتروني</h4>
                                    <p class="contact-page__contact-list-text">
                                        <a href="mailto:needhelp@hekaya.com">needhelp@hekaya.com</a>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-widget__social-box">
                        <div class="site-footer__social">
                            <a href="https://www.tiktok.com/@macarynaeem61?_r=1&_t=ZS-94yqJAdr8RY" target="_blank" rel="noopener" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                            <a href="https://www.facebook.com/share/1CWVhUREpY/?mibextid=wwXIfr" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/hekayacare?igsh=dzYzNDY5eXliY25x" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="contact-page__right">
                    <div class="footer-widget__appointment-box contact-page__form-box">
                        <p class="footer-widget__appointment-sub-title">لحياة أفضل</p>
                        <h5 class="footer-widget__appointment-title">احصل على استشارتك المجانية</h5>

                        @if (session('success'))
                            <div class="success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="error">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" action="{{ route('website.contact.store') }}" class="footer-widget__appointment-form">
                            @csrf
                            <div class="footer-widget__appointment-input-box">
                                <input type="text" placeholder="الاسم" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="footer-widget__appointment-input-box">
                                <input type="tel" placeholder="رقم التليفون" name="mobile" value="{{ old('mobile') }}" required>
                            </div>
                            <div class="footer-widget__appointment-input-box text-message-box">
                                <textarea name="message" placeholder="اكتب رسالتك أو استفسارك" required>{{ old('message') }}</textarea>
                            </div>
                            <div class="footer-widget__appointment-btn-box">
                                <button type="submit" class="thm-btn footer-widget__appointment-btn">إرسال الآن</button>
                            </div>
                        </form>
                        <div class="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-page-google-map">
    <iframe
        title="hekaya-care"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3457.0710390803824!2d30.922365400000004!3d29.9486352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458570473620747%3A0xedc5f3bfb341c97f!2z2KjZitiqINiz2YbYr9ip!5e0!3m2!1sen!2seg!4v1773625580712!5m2!1sen!2seg"
        width="800"
        height="600"
        style="border:0;"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        class="google-map__one"
        allowfullscreen
    ></iframe>
</section>
@endsection
