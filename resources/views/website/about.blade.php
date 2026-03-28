@extends('website.layout.layout')

@section('title', 'من نحن | Hekaya')
@section('meta_description', 'تعرف على مركز حكاية ورؤيتنا ورسالتنا وقيمنا في علاج الإدمان والصحة النفسية داخل بيئة علاجية آمنة وداعمة.')

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>من نحن</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li>من نحن</li>
            </ul>
        </div>
    </div>
</section>

<section class="about-five">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-five__left">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">مركز حكاية</span>
                    </div>
                    <p class="about-one__text-1">
                        نحن مركز متخصص في علاج الإدمان والصحة النفسية، نقدم برامج علاجية متكاملة مبنية على أسس علمية وخبرة عملية في مجال التعافي.
                        نؤمن أن التعافي ليس فقط التوقف عن التعاطي، بل هو رحلة شاملة لاستعادة التوازن النفسي وبناء نمط حياة صحي ومستقر.
                        نهدف إلى توفير بيئة آمنة وداعمة تساعد الأفراد على فهم أنفسهم، مواجهة صعوباتهم، واكتساب مهارات حياتية تمكنهم من العودة لحياة طبيعية منتجة ومستقرة.
                        نرافق الأفراد في رحلة التعافي خطوة بخطوة، لأن الدعم الإنساني المستمر هو أساس الشفاء الحقيقي.
                    </p>
                    <ul class="list-unstyled about-one__points">
                        <li>
                            <div class="icon" style="background-image: url({{ asset('images/shapes/about-one-points-shape-2.webp') }});">
                                <span class="icon-counseling"></span>
                            </div>
                            <div class="content">
                                <h4>رؤيتنا</h4>
                                <p>بناء مجتمع واعٍ ومتوازن نفسيًا، يستطيع فيه كل فرد فهم نفسه، والتعامل مع ضغوطه اليومية، والتعافي من أي تجارب مؤلمة.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon" style="background-image: url({{ asset('images/shapes/about-one-points-shape-2.webp') }});">
                                <span class="icon-healthcare"></span>
                            </div>
                            <div class="content">
                                <h4>رسالتنا</h4>
                                <p>مساعدة الأفراد على فهم مشاعرهم وأفكارهم، دعم التوازن في الحياة اليومية والعلاقات، مساندة المدمنين في رحلة التعافي بخطوات عملية، تقديم الدعم النفسي المستمر خلال العلاج وبعده، ونشر الوعي لبناء مجتمع آمن وداعم للجميع.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon" style="background-image: url({{ asset('images/shapes/about-one-points-shape-2.webp') }});">
                                <span class="icon-conversation"></span>
                            </div>
                            <div class="content">
                                <h4>قيمنا الأساسية</h4>
                                <p>السرية والخصوصية التامة، الاحترام الكامل لكل حالة، التعامل الإنساني قبل الطبي، العمل بروح الفريق، والمتابعة المستمرة بعد التعافي.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-five__right">
                    <div class="about-five__img-box wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="about-five__img">
                            <img src="{{ asset('images/resources/about-five-img-1.webp') }}" alt="about-bg">
                        </div>
                        <div class="about-five__img-two">
                            <div class="about-five__img-two-box">
                                <img src="{{ asset('images/resources/faq-one-img-2.webp') }}" alt="about-bg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-one about-page-feature">
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">لماذا نحن؟</span>
            <h2 class="section-title__title">ليه تختار مركزنا بالذات؟</h2>
            <p>قسم خاص للبنات: نوفر بيئة علاجية منفصلة تماماً ومجهزة بأعلى معايير الأمان والخصوصية، بإشراف طاقم متخصص للتعامل مع احتياجات المرأة.</p>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                <div class="feature-one__single">
                    <div class="feature-one__title-box">
                        <h3 class="feature-one__title"><a href="{{ route('website.team') }}">فريق متكامل</a></h3>
                    </div>
                    <div class="feature-one__text-box">
                        <p class="feature-one__text">عندنا أطباء ومعالجين ومشرفين، مش مجرد استشارات سطحية.</p>
                        <div class="feature-one__read-more">
                            <a href="{{ route('website.book-appointment') }}">المزيد</a>
                        </div>
                    </div>
                    <div class="feature-one__icon"><span class="icon-crm"></span></div>
                    <div class="feature-one__count"></div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                <div class="feature-one__single feature-one__single--two">
                    <div class="feature-one__title-box">
                        <h3 class="feature-one__title"><a href="{{ route('website.about') }}">خصوصية تامة</a></h3>
                    </div>
                    <div class="feature-one__text-box">
                        <p class="feature-one__text">نضمن لك سرية معلوماتك ومحادثاتك، ونلتزم بأعلى معايير الأمان.</p>
                        <div class="feature-one__read-more">
                            <a href="{{ route('website.book-appointment') }}">المزيد</a>
                        </div>
                    </div>
                    <div class="feature-one__icon"><span class="icon-healthcare"></span></div>
                    <div class="feature-one__count"></div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                <div class="feature-one__single">
                    <div class="feature-one__title-box">
                        <h3 class="feature-one__title"><a href="{{ route('website.about') }}">برامج فردية</a></h3>
                    </div>
                    <div class="feature-one__text-box">
                        <p class="feature-one__text">كل مريض له خطة علاجية خاصة به، حسب حالته وظروفه.</p>
                        <div class="feature-one__read-more">
                            <a href="{{ route('website.book-appointment') }}">المزيد</a>
                        </div>
                    </div>
                    <div class="feature-one__icon"><span class="icon-patient"></span></div>
                    <div class="feature-one__count"></div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                <div class="feature-one__single feature-one__single--four">
                    <div class="feature-one__title-box">
                        <h3 class="feature-one__title"><a href="{{ route('website.about') }}">بيئة داعمة</a></h3>
                    </div>
                    <div class="feature-one__text-box">
                        <p class="feature-one__text">مكان آمن ومريح نفسيًا، بعيد عن أي توتر أو قلق.</p>
                        <div class="feature-one__read-more">
                            <a href="{{ route('website.book-appointment') }}">المزيد</a>
                        </div>
                    </div>
                    <div class="feature-one__icon"><span class="icon-meditation"></span></div>
                    <div class="feature-one__count"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
