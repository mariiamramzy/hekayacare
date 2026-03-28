@extends('website.layout.layout')

@section('title', '404 | الصفحة غير موجودة | Hekaya')
@section('meta_description', 'الصفحة التي تبحث عنها غير موجودة أو تم نقلها. يمكنك العودة إلى الرئيسية أو تصفح صفحات موقع حكاية.')
@section('body_class', 'error-page')

@push('styles')
<style>
    .error-page-section {
        position: relative;
        padding: 120px 0;
        background:
            linear-gradient(rgba(16, 45, 87, 0.92), rgba(16, 45, 87, 0.92)),
            url('{{ asset('images/backgrounds/page-header-bg.webp') }}') center/cover no-repeat;
    }

    .error-page-card {
        max-width: 760px;
        margin: 0 auto;
        padding: 56px 40px;
        background: rgba(255, 255, 255, 0.96);
        border-radius: 24px;
        text-align: center;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.12);
    }

    .error-page-code {
        margin: 0 0 12px;
        font-size: clamp(72px, 12vw, 132px);
        line-height: 1;
        font-weight: 700;
        color: var(--hekaya-primary);
    }

    .error-page-title {
        margin: 0 0 18px;
        font-size: clamp(30px, 4vw, 46px);
        line-height: 1.35;
        color: var(--hekaya-base);
    }

    .error-page-text {
        margin: 0 auto 28px;
        max-width: 560px;
        font-size: 17px;
        line-height: 2;
        color: #5b6473;
    }

    .error-page-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .error-page-actions .thm-btn {
        min-width: 200px;
        text-align: center;
    }

    .error-page-actions .thm-btn--secondary {
        background: transparent;
        border: 1px solid rgba(16, 45, 87, 0.18);
        color: var(--hekaya-base);
    }

    .error-page-actions .thm-btn--secondary:hover {
        color: var(--hekaya-white);
    }

    @media (max-width: 767px) {
        .error-page-section {
            padding: 90px 0;
        }

        .error-page-card {
            padding: 40px 22px;
            border-radius: 18px;
        }

        .error-page-actions .thm-btn {
            width: 100%;
            min-width: 0;
        }
    }
</style>
@endpush

@section('content_container')
    <section class="error-page-section">
        <div class="container">
            <div class="error-page-card">
                <p class="error-page-code">404</p>
                <h1 class="error-page-title">الصفحة غير موجودة</h1>
                <p class="error-page-text">
                    الرابط الذي أدخلته غير صحيح أو أن الصفحة تم نقلها أو حذفها. يمكنك العودة إلى الصفحة الرئيسية أو الانتقال إلى صفحة التواصل.
                </p>
                <div class="error-page-actions">
                    <a href="{{ route('website.home') }}" class="thm-btn">العودة إلى الرئيسية</a>
                    <a href="{{ route('website.contact') }}" class="thm-btn thm-btn--secondary">تواصل معنا</a>
                </div>
            </div>
        </div>
    </section>
@endsection
