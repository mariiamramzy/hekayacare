@extends('website.layout.layout')

@section('title', 'صور المركز | Hekaya')
@section('meta_description', 'استكشف صور مركز حكاية والبيئة العلاجية والمساحات الداخلية والخارجية من خلال معرض الصور.')

@push('styles')
<style>
    .gallery-page {
        padding: 120px 0 90px;
    }

    .gallery-page .row {
        margin-bottom: 0;
    }

    .gallery-page__single {
        position: relative;
        display: block;
        margin-bottom: 30px;
    }

    .gallery-page__img {
        position: relative;
        display: block;
        overflow: hidden;
        border-radius: 20px;
        background: #f5f5f5;
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.08);
    }

    .gallery-page__img::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(25, 119, 107, 0.04), rgba(25, 119, 107, 0.42));
        opacity: 0;
        transition: opacity 0.35s ease;
        z-index: 1;
    }

    .gallery-page__img img {
        width: 100%;
        height: 340px;
        object-fit: cover;
        transition: transform 0.45s ease;
    }

    .gallery-page__icon {
        position: absolute;
        left: 24px;
        bottom: 24px;
        z-index: 2;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.35s ease;
    }

    .gallery-page__icon a {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--hekaya-white);
        color: var(--hekaya-primary);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        font-size: 18px;
    }

    .gallery-page__single:hover .gallery-page__img::before {
        opacity: 1;
    }

    .gallery-page__single:hover .gallery-page__img img {
        transform: scale(1.06);
    }

    .gallery-page__single:hover .gallery-page__icon {
        opacity: 1;
        transform: translateY(0);
    }

    .gallery-page__empty {
        text-align: center;
        padding: 30px 0 10px;
    }

    @media (max-width: 991px) {
        .gallery-page__img img {
            height: 300px;
        }
    }

    @media (max-width: 767px) {
        .gallery-page {
            padding: 90px 0 60px;
        }

        .gallery-page__img img {
            height: 260px;
        }
    }
</style>
@endpush

@section('content_container')
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>صور المركز</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                    <li><span>/</span></li>
                    <li>صور المركز</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="gallery-page">
        <div class="container">
            <div class="row masonary-layout img-popup">
                @forelse ($galleryImages as $image)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="gallery-page__single">
                            <div class="gallery-page__img">
                                <img src="{{ $image->image_url }}" alt="{{ $image->image_alt }}" loading="lazy" decoding="async">
                                <div class="gallery-page__icon">
                                    <a class="img-popup" href="{{ $image->image_url }}" aria-label="عرض الصورة بالحجم الكامل"><span class="icon-plus"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="gallery-page__empty">
                            <p>لا توجد صور منشورة حاليًا.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
