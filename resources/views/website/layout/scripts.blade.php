<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
        <div class="logo-box">
            <a href="{{ route('website.home') }}" aria-label="logo image">
                <img src="{{ asset('images/backgrounds/logo-1.svg') }}" width="145" alt="logo-hekaya">
            </a>
        </div>
        <div class="mobile-nav__container"></div>
        <ul class="mobile-nav__contact list-unstyled">
            <li><i class="fa fa-envelope"></i><a href="mailto:needhelp@hekaya.com">needhelp@hekaya.com</a></li>
            <li><i class="fa fa-phone-alt"></i><a href="tel:01554488501">(2+)015-5448-8501</a></li>
        </ul>
        <div class="mobile-nav__top">
            <div class="mobile-nav__social">
                <a href="https://www.tiktok.com/@macarynaeem61?_r=1&_t=ZS-94yqJAdr8RY" target="_blank" rel="noopener" class="fab fa-tiktok" aria-label="TikTok"></a>
                <a href="https://www.facebook.com/share/1CWVhUREpY/?mibextid=wwXIfr" target="_blank" rel="noopener" class="fab fa-facebook-square" aria-label="Facebook"></a>
                <a href="https://www.instagram.com/hekayacare?igsh=dzYzNDY5eXliY25x" target="_blank" rel="noopener" class="fab fa-instagram" aria-label="Instagram"></a>
            </div>
        </div>
    </div>
</div>

<div class="search-popup">
    <div class="search-popup__overlay search-toggler"></div>
    <div class="search-popup__content">
        <form action="{{ route('website.search') }}" method="GET">
            <label for="search" class="sr-only">ابحث هنا ...</label>
            <input type="text" id="search" name="q" placeholder="ابحث هنا ..." dir="rtl">
            <button type="submit" aria-label="search submit" class="thm-btn">
                <i class="icon-magnifying-glass"></i>
            </button>
        </form>
    </div>
</div>

<div class="floating-contact-buttons">
    <a href="https://wa.me/201554488501" target="_blank" rel="noopener" class="floating-contact-buttons__link floating-contact-buttons__link--whatsapp" aria-label="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="tel:01554488501" class="floating-contact-buttons__link floating-contact-buttons__link--phone" aria-label="Call">
        <i class="fas fa-phone-alt"></i>
    </a>
</div>

<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

<script src="{{ asset('vendors/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendors/jarallax/jarallax.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-appear/jquery.appear.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendors/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('vendors/odometer/odometer.min.js') }}"></script>
<script src="{{ asset('vendors/swiper/swiper.min.js') }}"></script>
<script src="{{ asset('vendors/tiny-slider/tiny-slider.min.js') }}"></script>
<script src="{{ asset('vendors/wnumb/wNumb.min.js') }}"></script>
<script src="{{ asset('vendors/wow/wow.js') }}"></script>
<script src="{{ asset('vendors/isotope/isotope.js') }}"></script>
<script src="{{ asset('vendors/countdown/countdown.min.js') }}"></script>
<script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('vendors/bxslider/jquery.bxslider.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('vendors/vegas/vegas.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-ui/jquery-ui.js') }}"></script>
@if (file_exists(public_path('vendors/timepicker/timePicker.js')))
<script src="{{ asset('vendors/timepicker/timePicker.js') }}"></script>
@endif
<script src="{{ asset('vendors/circleType/jquery.circleType.js') }}"></script>
<script src="{{ asset('vendors/circleType/jquery.lettering.min.js') }}"></script>
<script src="{{ asset('vendors/sidebar-content/jquery-sidebar-content.js') }}"></script>
<script src="{{ asset('vendors/tweenmax/TweenMax.min.js') }}"></script>
<script src="{{ asset('vendors/nice-select/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/hekaya.js') }}"></script>
@stack('scripts')
