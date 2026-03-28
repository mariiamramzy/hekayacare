<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('website.layout.head')
</head>
<body class="@yield('body_class')">
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
