@extends('website.layout.layout')

@section('title', 'الرئيسية | Hekaya')
@section('meta_description', 'مركز حكاية هو مركز متخصص في علاج الإدمان والصحة النفسية. نقدم برامج إقامة كاملة، جلسات أونلاين، ودعم نفسي مستمر.')

@section('content_container')
<section class="main-slider-two">
    <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView":1,"loop":true,"effect":"fade","pagination":{"el":"#main-slider-pagination","type":"bullets","clickable":true},"navigation":{"nextEl":"#main-slider__swiper-button-next","prevEl":"#main-slider__swiper-button-prev"},"autoplay":{"delay":5000}}'>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="image-layer-two" style="background-image: url({{ asset('images/backgrounds/main-slider-2-1.webp') }});"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="main-slider-two__content">
                                <h1 class="main-slider-two__sub-title">مركز متخصص في علاج الإدمان والصحة النفسية</h1>
                                <h2 class="main-slider-two__title">الإدمان أو الاضطرابات النفسية مش نهاية الطريق، لكنها لحظة محتاجة قرار صح ودعم حقيقي.</h2>
                                <div class="main-slider-two__btn-box">
                                    <a href="{{ route('website.book-appointment') }}" class="thm-btn main-slider-two__btn-two">ابدأ رحلتك وتواصل معنا</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="image-layer-two" style="background-image: url({{ asset('images/backgrounds/main-slider-2-1.webp') }});"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="main-slider-two__content">
                                <h1 class="main-slider-two__sub-title">اكتشف حياتك نحو التعافي والصحة النفسية</h1>
                                <h2 class="main-slider-two__title">في مركز حكاية بنقدم دعم حقيقي مبني على فهم واحتياج كل شخص.</h2>
                                <div class="main-slider-two__btn-box">
                                    <a href="{{ route('website.book-appointment') }}" class="thm-btn main-slider-two__btn-two">ابدأ رحلتك وتواصل معنا</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination" id="main-slider-pagination"></div>
    </div>
</section>

<section class="feature-three">
    <div class="container">
        <div class="section-title section-title-two text-center">
            <span class="section-title__tagline">مركز حكاية</span>
            <h2 class="section-title__title">لماذا نحن</h2>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                <div class="feature-three__single">
                    <div class="feature-three__icon"><span class="icon-thinking"></span></div>
                    <div class="feature-three__content">
                        <p class="feature-three__sub-title">متابعة بعد العلاج</p>
                        <h4 class="feature-three__title"><a href="{{ route('website.book-appointment') }}">مش بنسيبك بعد ما تخلص. بنوفرلك خطط متابعة لمنع الانتكاسة.</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                <div class="feature-three__single">
                    <div class="feature-three__icon"><span class="icon-psychologist"></span></div>
                    <div class="feature-three__content">
                        <p class="feature-three__sub-title">فريق طبي متكامل</p>
                        <h4 class="feature-three__title"><a href="{{ route('website.team') }}">أطباء نفسيين، أخصائيين، معالجين سلوكيين، ومشرفي تعافي.</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
                <div class="feature-three__single">
                    <div class="feature-three__icon"><span class="icon-mental-health-1"></span></div>
                    <div class="feature-three__content">
                        <p class="feature-three__sub-title">خصوصية وأمان تام</p>
                        <h4 class="feature-three__title"><a href="{{ route('website.contact') }}">نضمن لك بيئة علاجية سرية ومريحة تحترم خصوصيتك بالكامل.</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-two" id="about">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-two__left">
                    <div class="about-two__img-box wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="about-two__img"><img src="{{ asset('images/resources/about-two-img-1.webp') }}" alt="about-us" loading="lazy" decoding="async"></div>
                        <div class="about-two__img-two"><img src="{{ asset('images/resources/about-two-img-2.webp') }}" alt="about-us" loading="lazy" decoding="async"></div>
                        <div class="about-two__tretments">
                            <div class="about-two__tretments-icon"><span class="icon-dissociative-identity-disorder"></span></div>
                            <h4 class="about-two__tretments-title">التعافي ممكن <br> والخطوة الأولى تبدأ بالتواصل</h4>
                            <div class="about-two__tretments-big-text">0</div>
                            <div class="about-two__tretments-shape-1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-two__right">
                    <div class="section-title section-title-two text-right">
                        <span class="section-title__tagline">من نحن</span>
                        <h2 class="section-title__title">قصة تعافيك تبدأ بقرار، ونحن نمهد لك الطريق</h2>
                    </div>
                    <p class="about-two__text">نحن مركز متخصص في علاج الإدمان والصحة النفسية، نقدم برامج علاجية متكاملة مبنية على أسس علمية وخبرة عملية في مجال التعافي. نؤمن أن التعافي ليس فقط التوقف عن التعاطي، بل هو رحلة شاملة لاستعادة التوازن النفسي وبناء نمط حياة صحي ومستقر.</p>
                    <div class="about-two__points-box">
                        <ul class="list-unstyled about-two__points">
                            <li><div class="icon"><span class="icon-checked"></span></div><div class="text"><h5>فريق متكامل: عندنا أطباء ومعالجين ومشرفين، مش مجرد استشارات سطحية.</h5></div></li>
                            <li><div class="icon"><span class="icon-checked"></span></div><div class="text"><h5>خصوصية تامة: نضمن لك سرية معلوماتك ومحادثاتك، ونلتزم بأعلى معايير الأمان.</h5></div></li>
                            <li><div class="icon"><span class="icon-checked"></span></div><div class="text"><h5>برامج فردية: كل مريض له خطة علاجية خاصة به، حسب حالته وظروفه.</h5></div></li>
                        </ul>
                    </div>
                    <div class="about-two__bottom">
                        <div class="about-two__user-box">
                            <div class="about-two__user-img"><img src="{{ asset('images/backgrounds/logo-1.svg') }}" alt="logo-hekaya" loading="lazy" decoding="async"></div>
                        </div>
                        <div class="about-two__bottom-text-box">
                            <p>التعافي لا يعني أن حياتك أصبحت بلا ألم، بل يعني أنك أصبحت أقوى في مواجهة الألم.</p>
                            <div class="about-two__user-content"><h4 class="about-two__user-name">#حكايتك_مهمة</h4></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="counter-two">
    <div class="container">
        <ul class="list-unstyled counter-two__list">
            <li class="counter-two__single wow fadeInUp" data-wow-delay="100ms"><div class="counter-two__icon"><span class="icon-medal"></span></div><h3 class="odometer" data-count="16">00</h3><span class="counter-number-suffix">+</span><p class="counter-two__text">سنوات الخبرة</p></li>
            <li class="counter-two__single wow fadeInUp" data-wow-delay="200ms"><div class="counter-two__icon"><span class="icon-psychologist-1"></span></div><h3 class="odometer" data-count="67">00</h3><p class="counter-two__text">عدد أفراد الفريق الطبي</p></li>
            <li class="counter-two__single wow fadeInUp" data-wow-delay="300ms"><div class="counter-two__icon"><span class="icon-patient"></span></div><h3 class="odometer" data-count="96">00</h3><span class="counter-number-suffix">%</span><p class="counter-two__text">نسبة التعافي</p></li>
            <li class="counter-two__single wow fadeInUp" data-wow-delay="400ms"><div class="counter-two__icon"><span class="icon-mental-health-1"></span></div><h3 class="odometer" data-count="4000">00</h3><span class="counter-number-suffix">+</span><p class="counter-two__text">حالات تعافي ناجحة</p></li>
        </ul>
    </div>
</section>

<section class="services-two" id="services">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="services-two__left">
                    <div class="section-title section-title-two text-left">
                        <span class="section-title__tagline">خدماتنا</span>
                        <h2 class="section-title__title">العلاج الفعال هو الطريق للعودة</h2>
                    </div>
                    <p class="services-two__text-1">في مركز حكاية، يتجاوز هدفنا العلاج الفوري؛ نحن نقدم بنية تحتية للشفاء مصممة لتحويل حياتك، مع التركيز على الاستقرار طويل الأمد.</p>
                        <a href="{{ route('website.services') }}" class="thm-btn main-slider-two__btn-two">احجز الخدمة المناسبة</a>
                    <div class="services-two__single wow fadeInUp" data-wow-delay="100ms">
                        <div class="services-two__img"><img src="{{ asset('images/services/services-2-1.webp') }}" alt="service-section" loading="lazy" decoding="async"></div>
                        <div class="services-two__content">
                                <h3 class="services-two__title"><a href="{{ route('website.services') }}">برامج الإقامة الكاملة للأمراض النفسية</a></h3>
                            <p class="services-two__text-2">نقدم برامج علاجية شاملة للحالات النفسية التي تحتاج متابعة دقيقة وبيئة مستقرة.</p>
                                <a href="{{ route('website.services') }}" class="services-two__read-more">اعرف المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="services-two__right">
                    <div class="services-two__single wow fadeInUp" data-wow-delay="200ms">
                        <div class="services-two__img"><img src="{{ asset('images/services/services-2-2.webp') }}" alt="service-section" loading="lazy" decoding="async"></div>
                        <div class="services-two__content">
                                <h3 class="services-two__title"><a href="{{ route('website.services') }}">جلسات المشورة والعلاج النفسي</a></h3>
                            <p class="services-two__text-2">نوفر جلسات مشورة وعلاج نفسي فردي بالحضور داخل المركز أو أونلاين، لتناسب احتياجات كل شخص وظروفه.</p>
                                <a href="{{ route('website.services') }}" class="services-two__read-more">اعرف المزيد</a>
                        </div>
                    </div>
                    <div class="services-two__single wow fadeInUp" data-wow-delay="300ms">
                        <div class="services-two__img"><img src="{{ asset('images/services/services-2-3.webp') }}" alt="service-section" loading="lazy" decoding="async"></div>
                        <div class="services-two__content">
                                <h3 class="services-two__title"><a href="{{ route('website.services') }}">برامج الإقامة الكاملة لعلاج الإدمان</a></h3>
                            <p class="services-two__text-2">نقدم برامج علاجية متكاملة داخل بيئة علاجية آمنة.</p>
                                <a href="{{ route('website.services') }}" class="services-two__read-more">اعرف المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-one" id="faq">
    <div class="container">
        <div class="section-title section-title-two text-center">
            <span class="section-title__tagline">ما يجب أن تعرفه (FAQ)</span>
            <h2 class="section-title__title">أسئلة شائعة حول علاجنا</h2>
        </div>
        <div class="row">
            <div class="col-xl-5 col-lg-6">
                <div class="faq-one__left">
                    <div class="faq-one__img-box wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="faq-one__img"><img src="{{ asset('images/resources/faq-one-img-1.webp') }}" alt="faq-section" loading="lazy" decoding="async"></div>
                        <div class="faq-one__img-2"><img src="{{ asset('images/resources/faq-one-img-2.webp') }}" alt="faq-section" loading="lazy" decoding="async"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <div class="faq-one__right">
                    <div class="faq-one__faq">
                        <div class="faq-one-accrodion accrodion-grp" data-grp-name="faq-one-accrodion">
                            @forelse ($featuredFaqs as $faqIndex => $faq)
                                <div class="accrodion {{ $faqIndex === 1 ? 'active' : '' }}">
                                    <div class="accrodion-title"><h4>{{ $faq->question_ar }}</h4></div>
                                    <div class="accrodion-content">
                                        <div class="inner"><p>{{ $faq->answer_ar }}</p></div>
                                    </div>
                                </div>
                            @empty
                                <div class="accrodion active">
                                    <div class="accrodion-title"><h4>لا توجد أسئلة مميزة حالياً</h4></div>
                                    <div class="accrodion-content">
                                        <div class="inner"><p>يمكنك إضافة أسئلة مميزة من لوحة التحكم وستظهر هنا تلقائيًا.</p></div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="skill-one">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="skill-one__left">
                    <div class="section-title section-title-two text-left">
                        <span class="section-title__tagline">حكاية تعافي</span>
                        <h2 class="section-title__title">لماذا يثق بنا عملاؤنا؟</h2>
                    </div>
                    <p class="skill-one__text">في مركز حكاية، نحن لا نقدم مجرد علاج، بل نبني جسراً من الثقة والاحترافية. نعتمد على أدق المعايير الطبية والنفسية لضمان رحلة تعافي آمنة، ونفخر بكوننا الشريك الأول للأسر في استعادة أبنائهم وبناء مستقبل مشرق بعيداً عن الإدمان.</p>
                    <div class="skill-one__progress-ber">
                        <div class="skill-one__progress-single"><div class="skill-one__progress-box"><div class="circle-progress" data-options='{ "value": 0.95,"thickness": 3,"emptyFill": "#ffffff","lineCap": "square", "size": 102, "fill": { "color": "#19776b" } }'></div><div class="skill-one__pack"><p>95%</p></div></div><p class="skill-one__progress-text">نسبة التعافي المستدام</p></div>
                        <div class="skill-one__progress-single"><div class="skill-one__progress-box"><div class="circle-progress" data-options='{ "value": 1.0,"thickness": 3,"emptyFill": "#ffffff","lineCap": "square", "size": 102, "fill": { "color": "#19776b" } }'></div><div class="skill-one__pack"><p>100%</p></div></div><p class="skill-one__progress-text">السرية والأمان</p></div>
                        <div class="skill-one__progress-single"><div class="skill-one__progress-box"><div class="circle-progress" data-options='{ "value": 0.9,"thickness": 3,"emptyFill": "#ffffff","lineCap": "square", "size": 102, "fill": { "color": "#19776b" } }'></div><div class="skill-one__pack"><p>90%</p></div></div><p class="skill-one__progress-text">رضا وثقة أسر المتعافين</p></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="skill-one__right">
                    <div class="skill-one__img-box">
                        <div class="skill-one__img"><img src="{{ asset('images/resources/skill-one-img-1.webp') }}" alt="why-choose-us" loading="lazy" decoding="async"></div>
                        <div class="skill-one__img-2"><img src="{{ asset('images/resources/skill-one-img-2.webp') }}" alt="why-choose-us" loading="lazy" decoding="async"></div>
                        <div class="skill-one__trusted">
                            <div class="skill-one__trusted-shape-1"></div>
                            <div class="skill-one__trusted-icon"><span class="icon-healthcare"></span></div>
                            <p class="skill-one__trusted-text">أكثر من <span class="odometer" data-count="1500">00</span> قصة تعافي ناجحة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="portfolio-two">
    <div class="container">
        <div class="section-title section-title-two text-center">
            <span class="section-title__tagline">قصص من سبقوك</span>
            <h2 class="section-title__title">تحولات حقيقية.. دليل على كفاءتنا</h2>
        </div>
        <ul class="portfolio-two__bottom list-unstyled filter-layout">
            @forelse ($latestPortfolioCases as $index => $portfolioCase)
                <li class="portfolio-two__single portfolio-two__single-{{ $index + 1 }} filter-item">
                    <div class="portfolio-two__img-box">
                        <div class="portfolio-two__img">
                            <img src="{{ $portfolioCase->cover_image_url }}" alt="{{ $portfolioCase->card_title }}" loading="lazy" decoding="async">
                        </div>
                        <div class="portfolio-two__content">
                            <p class="portfolio-two__sub-title">{{ $portfolioCase->card_title }}</p>
                            <h3 class="portfolio-two__title">
                                <a href="{{ route('website.portfolio-details', $portfolioCase) }}">الحكاية</a>
                            </h3>
                        </div>
                    </div>
                </li>
            @empty
                <li class="portfolio-two__single filter-item" style="width:100%;">
                    <div class="portfolio-two__img-box" style="padding: 24px; text-align: center;">
                        <div class="portfolio-two__content">
                            <p class="portfolio-two__sub-title">لا توجد قصص شفاء منشورة حاليًا</p>
                            <h3 class="portfolio-two__title"><a href="{{ route('website.portfolio') }}">عرض صفحة قصص الشفاء</a></h3>
                        </div>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
</section>

<section class="team-two" id="team">
    <div class="container">
        <div class="section-title section-title-two text-center">
            <span class="section-title__tagline">فريقنا العلاجي</span>
            <h2 class="section-title__title">يضم المركز فريقًا متخصصًا ومتكاملًا</h2>
        </div>
        <div class="row">
            @forelse ($teamMembers as $index => $member)
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="{{ ($index + 1) * 100 }}ms">
                    <div class="team-two__single">
                        <div class="team-two__img-box">
                            <div class="team-two__img">
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name_ar }}" loading="lazy" decoding="async">
                            </div>
                        </div>
                        <div class="team-two__content">
                            <h3 class="team-two__name"><a href="{{ route('website.team') }}">{{ $member->name_ar }}</a></h3>
                            @if ($member->departments->isNotEmpty())
                                <p style="margin-bottom: 8px; color: #19776b; font-weight: 700;">
                                    {{ $member->departments->pluck('name_ar')->join(' - ') }}
                                </p>
                            @endif
                            <p class="team-two__sub-title">{{ $member->title_ar ?: $member->specialty_ar }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center" style="padding-top: 20px;">
                        <p>لا يوجد أعضاء فريق منشورون حاليًا.</p>
                    </div>
                </div>
            @endforelse
            <div class="col-md-12 text-center"><a href="{{ route('website.team') }}" class="thm-btn main-slider-two__btn-two">تعرف على جميع الأعضاء</a></div>
        </div>
    </div>
</section>

<section class="testimonial-three">
    <div class="testimonial-three__bg" style="background-image: url({{ asset('images/backgrounds/bg1.webp') }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div class="testimonial-three__left">
                    <div class="section-title-three text-left"><h2 class="section-title-three__title">شهادات العملاء</h2></div>
                    <p class="testimonial-three__text-1">رحلات تغيير الحياة التي يرويها عملاؤنا</p>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="testimonial-three__right">
                    <div class="testimonial-three__carousel thm-owl__carousel owl-theme owl-carousel" data-owl-options='{"items":1,"margin":38,"smartSpeed":700,"loop":true,"autoplay":true,"autoplayTimeout":6000,"autoplayHoverPause":true,"mouseDrag":true,"touchDrag":true,"rtl":true,"nav":true,"dots":false,"navText":["<span class=\"icon-right1\"></span>","<span class=\"icon-down\"></span>"],"responsive":{"0":{"items":1},"768":{"items":2},"992":{"items":2}}}'>
                        @foreach ([['text' => 'لم أكن أعرف أن إدماني كان مجرد عرض جانبي لاكتئاب شديد وقلق مزمن. الفضل يعود لفريق التشخيص المزدوج؛ لقد عالجوا جذور المشكلة النفسية التي لم أكن أدركها.', 'name' => 'س.م', 'title' => 'التشخيص المزدوج'], ['text' => 'بعد الانتهاء من الإقامة الداخلية، كنت قلقاً بشأن العودة للحياة العملية والاجتماعية. برنامج المتابعة والعيادات الخارجية كان طوق النجاة.', 'name' => 'ط.ق', 'title' => 'استدامة التعافي والدعم الخارجي'], ['text' => 'كنت أخشى بشدة مرحلة سحب السموم، لكن المنظومة الطبية الاحترافية جعلت التجربة آمنة ومطمئنة.', 'name' => 'ي.أ', 'title' => 'تجربة سحب السموم'], ['text' => 'الخوف من الوصم وفقدان السمعة كان أكبر عائق، لكن السرية المطلقة والاحتواء غير المشروط منحاني الثقة للبدء في العلاج.', 'name' => 'ف.س', 'title' => 'السرية والاحترام والاحتواء']] as $testimonial)
                            <div class="item">
                                <div class="testimonila-three__single">
                                    <div class="testimonila-three__single-inner">
                                        <div class="testimonila-three__single-bg" style="background-image: url({{ asset('images/backgrounds/review-bg.webp') }});"></div>
                                        <div class="testimonila-three__shape-1"><img src="{{ asset('images/shapes/testimonial-three-shape-1.webp') }}" alt="shape" loading="lazy" decoding="async"></div>
                                        <p class="testimonila-three__text-2">"{{ $testimonial['text'] }}"</p>
                                        <div class="testimonila-three__client-info-box">
                                            <div class="testimonila-three__client-img-box">
                                                <div class="testimonila-three__client-img"><div class="testimonila-three__client-img-inner"><img src="{{ asset('images/testimonial/testimonial-2-1_result.webp') }}" alt="client-review" loading="lazy" decoding="async"></div></div>
                                                <div class="testimonila-three__quote"><span class="icon-quote"></span></div>
                                            </div>
                                            <div class="testimonila-three__client-content">
                                                <h4 class="testimonila-three__client-name">{{ $testimonial['name'] }}</h4>
                                                <p class="testimonila-three__client-sub-title">{{ $testimonial['title'] }}</p>
                                                <div class="testimonila-three__client-review"><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star-1"></span><span class="icon-star-1"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-two" id="blog">
    <div class="container">
        <div class="section-title section-title-two text-center">
            <span class="section-title__tagline">أحدث المقالات</span>
            <h2 class="section-title__title">نحو وعي أفضل</h2>
        </div>
        <div class="row">
            @forelse ($latestBlogPosts as $index => $article)
                <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="{{ ($index + 1) * 100 }}ms">
                    <div class="blog-two__single">
                        <div class="blog-two__img-box"><div class="blog-two__img"><img src="{{ $article->cover_image_url }}" alt="{{ $article->title_ar }}" loading="lazy" decoding="async"></div></div>
                        <div class="blog-two__content-box">
                            <div class="blog-two__content">
                                    <h3 class="blog-two__title"><a href="{{ route('website.blog-details', $article->slug) }}">{{ $article->title_ar }}</a></h3>
                                <ul class="blog-two__meta list-unstyled">
                                    <li><a href="{{ route('website.blog-details', $article->slug) }}"><i class="fas fa-calendar"></i> {{ optional($article->published_at)->format('Y-m-d') ?: $article->created_at?->format('Y-m-d') }}</a></li>
                                    <li><a href="{{ route('website.blogs', ['q' => $article->category?->name_ar]) }}"><i class="fas fa-tag"></i> {{ $article->category?->name_ar ?: 'المقالات' }}</a></li>
                                </ul>
                                <div class="blog-two__date"><p>{{ optional($article->published_at)->format('Y-m-d') ?: $article->created_at?->format('Y-m-d') }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center" style="padding-top: 20px;">
                        <p>لا توجد مقالات منشورة حاليًا.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
