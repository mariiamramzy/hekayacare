<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T7ESS24F34"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-T7ESS24F34');
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WXPRS4FS');</script>
    <!-- End Google Tag Manager -->
    @include('website.layout.head')
</head>
<body class="@yield('body_class')">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WXPRS4FS"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="loader-wrap">
        <div class="preloader">
            <div id="handle-preloader" class="handle-preloader">
                <div class="layer layer-one"><span class="overlay"></span></div>
                <div class="layer layer-two"><span class="overlay"></span></div>
                <div class="layer layer-three"><span class="overlay"></span></div>
                <div class="animation-preloader">
                    <img class="logo-load" src="{{ asset('images/backgrounds/favicon.svg') }}" alt="favicon-logo">
                    <div class="spinner"></div>
                    <div class="txt-loading" dir="ltr">
                        @foreach (['H', 'E', 'K', 'A', 'Y', 'A'] as $letter)
                            <span data-text-preloader="{{ $letter }}" class="letters-loading">{{ $letter }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        @include('website.layout.header')

        @hasSection('content_container')
            @yield('content_container')
        @else
            <main class="container--page">
                @yield('content')
            </main>
        @endif

        @include('website.layout.footer')
    </div>

    @include('website.layout.scripts')
</body>
</html>
