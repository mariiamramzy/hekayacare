@extends('website.layout.layout')

@section('title', 'فريقنا العلاجي | Hekaya')
@section('meta_description', 'تعرف على الفريق العلاجي في مركز حكاية من الأخصائيين والمعالجين والاستشاريين المتخصصين في الصحة النفسية وعلاج الإدمان.')

@push('styles')
<style>
    .team-page .team-one__single {
        height: 100%;
        background: #fff;
        box-shadow: 0 6px 22px rgba(16, 45, 87, 0.06);
    }

    .team-page .team-one__img {
        position: relative;
        height: 230px;
        overflow: hidden;
    }

    .team-page .team-one__img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
    }

    .team-page .team-one__content {
        margin-top: 0;
        padding: 22px 16px 18px;
        min-height: 250px;
        height: auto;
        text-align: center;
    }

    .team-page .team-one__name {
        font-size: 17px;
        line-height: 1.7;
        margin-bottom: 8px;
    }

    .team-page .team-one__name a {
        color: #0f2443;
    }

    .team-page .team-one__department {
        margin-bottom: 8px;
        color: #19776b;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.8;
    }

    .team-page .team-one__sub-title {
        font-size: 14px;
        line-height: 1.8;
        color: #183a66;
        word-break: break-word;
        overflow-wrap: anywhere;
    }

    .team-page .team-one__sub-title strong {
        display: block;
        margin-bottom: 4px;
        font-size: 15px;
        color: #183a66;
    }

    .team-page .team-one__social-two {
        right: 14px;
        bottom: 14px;
    }

    .team-page .team-one__social-two li a {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        font-size: 14px;
    }

    .team-page .team-one__social {
        right: 46px;
        bottom: 45px;
        padding: 12px 6px;
        border-radius: 10px 10px 0 0;
    }

    .team-page .team-one__social li a {
        width: 30px;
        height: 30px;
        font-size: 13px;
    }

    @media only screen and (max-width: 991px) {
        .team-page .team-one__content {
            min-height: 220px;
        }
    }

    @media only screen and (max-width: 767px) {
        .team-page .team-one__img {
            height: 260px;
        }

        .team-page .team-one__content {
            min-height: 200px;
        }
    }
</style>
@endpush

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>فريقنا العلاجي</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li>فريقنا العلاجي</li>
            </ul>
        </div>
    </div>
</section>

<section class="team-page">
    <div class="container">
        <div class="row">
            <div class="section-title text-center">
                <span class="section-title__tagline">يضم المركز فريقًا متخصصًا ومتكاملًا من</span>
                <h2 class="section-title__title">التعافي يقوم على ثلاثة عناصر أساسية: المريض، الفريق العلاجي، والأسرة. هذا التكامل يساعد على تغيير التفكير والسلوك وبناء حياة جديدة أكثر استقرارًا.</h2>
            </div>

            @forelse ($teamMembers as $index => $member)
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="{{ ($index + 1) * 100 }}ms" id="team-member-{{ $member->id }}">
                    @php
                        $memberPhone = preg_replace('/\D+/', '', (string) ($member->phone ?: '01554488501'));
                        $memberEmail = $member->email ?: 'needhelp@hekaya.com';
                    @endphp
                    <div class="team-one__single">
                        <div class="team-one__img">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name_ar }}" loading="lazy" decoding="async">
                            <ul class="list-unstyled team-one__social-two">
                                <li><a href="javascript:void(0)" aria-label="Team member links"><i class="fas fa-share-alt"></i></a></li>
                            </ul>
                            <ul class="list-unstyled team-one__social">
                                <li><a href="tel:{{ $memberPhone }}" aria-label="Call {{ $member->name_ar }}"><i class="fas fa-phone-alt"></i></a></li>
                                <li><a href="https://wa.me/2{{ $memberPhone }}" target="_blank" rel="noopener" aria-label="WhatsApp {{ $member->name_ar }}"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="mailto:{{ $memberEmail }}" aria-label="Email {{ $member->name_ar }}"><i class="fas fa-envelope"></i></a></li>
                                <li><a href="{{ route('website.contact') }}" aria-label="Contact center"><i class="fas fa-comment-medical"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-one__content">
                            <h4 class="team-one__name"><a href="{{ route('website.team') }}">{{ $member->name_ar }}</a></h4>
                            @if ($member->departments->isNotEmpty())
                                <p class="team-one__department">{{ $member->departments->pluck('name_ar')->join(' - ') }}</p>
                            @endif
                            <p class="team-one__sub-title">
                                @if ($member->title_ar)
                                    <strong>{{ $member->title_ar }}</strong>
                                @endif
                                {{ $member->specialty_ar ?: $member->bio_ar }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center" style="padding: 40px 0;">
                        <h3 style="margin-bottom: 12px;">لا يوجد أعضاء فريق منشورون حاليًا</h3>
                        <p>يمكنك إضافة أعضاء الفريق من لوحة التحكم وسيظهرون هنا تلقائيًا.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
