@extends('website.layout.layout')

@section('title', 'الأسئلة الشائعة | Hekaya')
@section('meta_description', 'إجابات واضحة على أكثر الأسئلة شيوعًا حول العلاج النفسي وعلاج الإدمان وخطوات التعافي في مركز حكاية.')

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>الأسئلة الشائعة</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li>الأسئلة الشائعة</li>
            </ul>
        </div>
    </div>
</section>

<section class="faq-one faq-page-custom">
    <div class="container">
        <div class="section-title section-title-two text-center">
            <h2 class="section-title__title">أسئلة شائعة حول علاجنا</h2>
        </div>

        <div class="row align-items-start">
            <div class="col-xl-7 col-lg-6">
                <div class="faq-one__right">
                    @if ($allFaqs->isNotEmpty())
                        <div class="faq-one__faq">
                            <div class="faq-one-accrodion accrodion-grp" data-grp-name="faq-page-accrodion">
                                @foreach ($allFaqs as $faqIndex => $faq)
                                    <div class="accrodion {{ $faqIndex === 1 ? 'active' : '' }}" id="faq-{{ $faq->id }}">
                                        <div class="accrodion-title">
                                            <h4>{{ $faq->question_ar }}</h4>
                                        </div>
                                        <div class="accrodion-content">
                                            <div class="inner">
                                                <p>{{ $faq->answer_ar }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="faq-one__faq">
                            <div class="faq-one-accrodion accrodion-grp" data-grp-name="faq-one-empty">
                                <div class="accrodion active">
                                    <div class="accrodion-title">
                                        <h4>لا توجد أسئلة شائعة منشورة حاليًا</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <p>يمكنك التواصل معنا مباشرة وسنساعدك في أي استفسار يخص البرامج العلاجية أو خطوات الحجز.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-5 col-lg-6">
                <div class="faq-page-custom__image-wrap wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <div class="faq-page-custom__image">
                        <img src="{{ asset('images/resources/faq-one-img-1.webp') }}" alt="faq" loading="lazy" decoding="async">
                    </div>
                    <div class="faq-page-custom__image-small">
                        <img src="{{ asset('images/resources/faq-one-img-2.webp') }}" alt="faq" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .faq-page-custom .section-title {
        margin-bottom: 55px;
    }

    .faq-page-custom .section-title__title {
        font-size: 60px;
        line-height: 1.2;
        color: var(--hekaya-black);
    }

    .faq-page-custom .faq-one__right {
        margin-left: 0;
        margin-right: 0;
    }

    .faq-page-custom__image-wrap {
        position: relative;
        display: block;
    }

    .faq-page-custom__image img {
        width: 100%;
        object-fit: cover;
    }

    .faq-page-custom__image-small {
        position: absolute;
        right: 50%;
        bottom: -78px;
        width: 210px;
        transform: translateX(50%);
        border-radius: 50%;
    }

    .faq-page-custom__image-small img {
        width: 100%;
        border-radius: 50%;
        border: 10px solid var(--hekaya-white);
    }

    @media (max-width: 1199px) {
        .faq-page-custom .section-title__title {
            font-size: 46px;
        }
    }

    @media (max-width: 991px) {
        .faq-page-custom .row {
            row-gap: 50px;
        }

        .faq-page-custom__image-small {
            bottom: -58px;
            width: 170px;
        }
    }

    @media (max-width: 767px) {
        .faq-page-custom .section-title__title {
            font-size: 34px;
        }
    }
</style>
@endpush
