@php($currentRoute = request()->route()?->getName())
@php($isBlogRoute = in_array($currentRoute, ['website.blogs', 'website.blog-details'], true))
@php($isAboutMenuRoute = in_array($currentRoute, ['website.about', 'website.team', 'website.gallery', 'website.portfolio'], true))
@php($isServicesRoute = in_array($currentRoute, ['website.services', 'website.service-details'], true))

<header class="main-header-two">
    <div class="main-header-two__top">
        <div class="main-header-two__top-wrapper">
            <div class="main-header-two__top-inner">
                <p class="main-header-two__top-text">كل رحلة تعافي ليها حكاية</p>
                <ul class="list-unstyled main-header-two__contact-list">
                    <li>
                        <div class="icon"><i class="far fa-clock"></i></div>
                        <div class="text"><p>ساعات العمل من السبت للخميس</p></div>
                    </li>
                    <li>
                        <div class="icon"><i class="fas fa-envelope"></i></div>
                        <div class="text"><p><a href="mailto:needhelp@hekaya.com">needhelp@hekaya.com</a></p></div>
                    </li>
                    <li>
                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="text"><p>٦ أكتوبر - الحي الخامس</p></div>
                    </li>
                </ul>
                <div class="main-header-two__top-btn">
                    <a href="{{ route('website.book-appointment') }}">احجز استشارة الآن</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="main-menu main-menu-two">
        <div class="main-menu-two__wrapper">
            <div class="main-menu-two__wrapper-inner">
                <div class="main-menu-two__logo">
                    <a href="{{ route('website.home') }}">
                        <img class="logo" src="{{ asset('images/backgrounds/logo-1.svg') }}" alt="logo-hekaya">
                    </a>
                </div>
                <div class="main-menu-two__main-menu-box">
                    <a href="#" class="mobile-nav__toggler" aria-label="فتح القائمة"><i class="fa fa-bars"></i></a>
                    <ul class="main-menu__list">
                        <li class="{{ $currentRoute === 'website.home' ? 'current' : '' }}">
                            <a href="{{ route('website.home') }}">الرئيسية<span class="main-menu-border"></span></a>
                        </li>
                        <li class="dropdown {{ $isAboutMenuRoute ? 'current' : '' }}">
                            <a href="#">عن المركز<span class="main-menu-border"></span></a>
                            <ul>
                                <li><a href="{{ route('website.about') }}">معلومات عنا</a></li>
                                <li><a href="{{ route('website.team') }}">فريق العلاج</a></li>
                                <li><a href="{{ route('website.gallery') }}">صور المركز</a></li>
                                <li><a href="{{ route('website.portfolio') }}">قصص شفاء</a></li>
                            </ul>
                        </li>
                        <li class="{{ $isServicesRoute ? 'current' : '' }}">
                            <a href="{{ route('website.services') }}">الخدمات<span class="main-menu-border"></span></a>
                        </li>
                        <li class="{{ $currentRoute === 'website.faqs' ? 'current' : '' }}">
                            <a href="{{ route('website.faqs') }}">الأسئلة الشائعة<span class="main-menu-border"></span></a>
                        </li>
                        <li class="{{ $isBlogRoute ? 'current' : '' }}">
                            <a href="{{ route('website.blogs') }}">المقالات<span class="main-menu-border"></span></a>
                        </li>
                        <li class="{{ $currentRoute === 'website.contact' ? 'current' : '' }}">
                            <a href="{{ route('website.contact') }}">اتصل بنا<span class="main-menu-border"></span></a>
                        </li>
                    </ul>
                </div>
                <div class="main-menu-two__search-box">
                    <a href="#" class="main-menu-two__search search-toggler icon-magnifying-glass" aria-label="فتح البحث"></a>
                </div>
                <div class="main-menu-two__right">
                    <div class="main-menu-two__search-call">
                        <div class="main-menu-two__call">
                            <div class="main-menu-two__call-icon"><span class="icon-telephone"></span></div>
                            <div class="main-menu-two__call-content">
                                <p class="main-menu-two__call-sub-title">اتصل الآن</p>
                                <h5 class="main-menu-two__call-number"><a href="tel:01554488501">(2+)015-5448-8501</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="stricky-header stricked-menu main-menu main-menu-two">
    <div class="sticky-header__content"></div>
</div>
