<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@php
    $fallbackTitle = trim($__env->yieldContent('title')) ?: ($websiteSeoDefaultTitle ?? config('app.name'));
    $fallbackDescription = trim($__env->yieldContent('meta_description'))
        ?: ($websiteSeoDefaultDescription ?? 'مركز حكاية متخصص في علاج الإدمان والصحة النفسية وتقديم الدعم والاستشارات وبرامج التعافي.');
@endphp

<x-seo.meta
    :meta="$websiteSeoMeta ?? null"
    :default-title="$fallbackTitle"
    :default-description="$fallbackDescription"
    :default-image-url="$websiteSeoDefaultImageUrl ?? null"
    :url="url()->current()"
/>
<link rel="apple-touch-icon" sizes="180x180" href="{{ $websiteSeoFaviconUrl ?? asset('images/backgrounds/favicon.svg') }}">
<link rel="icon" type="image/svg+xml" sizes="32x32" href="{{ $websiteSeoFaviconUrl ?? asset('images/backgrounds/favicon.svg') }}">
<link rel="icon" type="image/svg+xml" sizes="16x16" href="{{ $websiteSeoFaviconUrl ?? asset('images/backgrounds/favicon.svg') }}">
<link rel="manifest" href="{{ $websiteSeoFaviconUrl ?? asset('images/backgrounds/favicon.svg') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/animate/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/animate/custom-animate.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/jarallax/jarallax.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/nouislider/nouislider.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/nouislider/nouislider.pips.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/odometer/odometer.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/swiper/swiper.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/hekaya-icons/style.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/tiny-slider/tiny-slider.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/bxslider/jquery.bxslider.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/bootstrap-select/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/vegas/vegas.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/jquery-ui/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/timepicker/timePicker.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/nice-select/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('css/hekaya.css') }}">
<link rel="stylesheet" href="{{ asset('css/hekaya-responsive.css') }}">

<style>
    body { font-family: "Noto Kufi Arabic", sans-serif; }
    .container--page { width: min(900px, 94%); margin: 60px auto; }
    .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 18px; }
    .title { margin: 0 0 6px; }
    .muted { color: #6b7280; margin: 0 0 14px; }
    .field { margin-bottom: 12px; }
    .field label { display: block; font-weight: 600; margin-bottom: 6px; }
    .field input, .field select, .field textarea { width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 10px; box-sizing: border-box; font-size: 14px; }
    .field textarea { min-height: 120px; resize: vertical; }
    .btn { border: 0; border-radius: 8px; padding: 10px 14px; background: #0f766e; color: #fff; cursor: pointer; }
    .success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; border-radius: 8px; padding: 10px; margin-bottom: 10px; }
    .error { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; border-radius: 8px; padding: 10px; margin-bottom: 10px; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    @media (max-width: 700px) { .grid-2 { grid-template-columns: 1fr; } }
</style>
@stack('styles')
