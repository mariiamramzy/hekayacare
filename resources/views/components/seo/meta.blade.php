@props([
    'meta' => null,
    'defaultTitle' => null,
    'defaultDescription' => null,
    'defaultImageUrl' => null,
    'url' => null,
])

@php
    $currentUrl = $url ?: url()->current();
    $title = $meta?->meta_title_ar ?: $defaultTitle;
    $description = $meta?->meta_description_ar ?: $defaultDescription;
    $keywords = $meta?->meta_keywords_ar;
    $canonical = $meta?->canonical_url ?: $currentUrl;
    $robots = $meta?->robots ?: 'index,follow';
    $ogTitle = $meta?->og_title_ar ?: $title;
    $ogDescription = $meta?->og_description_ar ?: $description;
    $ogType = $meta?->og_type ?: 'website';
    $ogUrl = $meta?->og_url ?: $currentUrl;
    $ogSiteName = $meta?->og_site_name ?: config('app.name');
    $ogImage = $defaultImageUrl;
    if ($meta?->ogImageMedia?->path) {
        $ogImage = asset('storage/'.$meta->ogImageMedia->path);
    }
    $twitterCard = $meta?->twitter_card ?: 'summary_large_image';
    $twitterTitle = $meta?->twitter_title_ar ?: $ogTitle;
    $twitterDescription = $meta?->twitter_description_ar ?: $ogDescription;
    $twitterImage = $ogImage;
    if ($meta?->twitterImageMedia?->path) {
        $twitterImage = asset('storage/'.$meta->twitterImageMedia->path);
    }
@endphp

@if($title)<title>{{ $title }}</title>@endif
@if($description)<meta name="description" content="{{ $description }}">@endif
@if($keywords)<meta name="keywords" content="{{ $keywords }}">@endif
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">

@if($ogTitle)<meta property="og:title" content="{{ $ogTitle }}">@endif
@if($ogDescription)<meta property="og:description" content="{{ $ogDescription }}">@endif
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $ogUrl }}">
@if($ogSiteName)<meta property="og:site_name" content="{{ $ogSiteName }}">@endif
@if($ogImage)<meta property="og:image" content="{{ $ogImage }}">@endif

<meta name="twitter:card" content="{{ $twitterCard }}">
@if($twitterTitle)<meta name="twitter:title" content="{{ $twitterTitle }}">@endif
@if($twitterDescription)<meta name="twitter:description" content="{{ $twitterDescription }}">@endif
@if($twitterImage)<meta name="twitter:image" content="{{ $twitterImage }}">@endif

@if($meta?->schema_json)
<script type="application/ld+json">
{!! json_encode($meta->schema_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endif
