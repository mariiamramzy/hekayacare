@extends('website.layout.layout')

@section('title', 'الخدمات | Hekaya')
@section('meta_description', 'تعرف على خدمات مركز حكاية العلاجية وبرامج الإقامة والعلاج النفسي وورش العمل والدعم المتكامل.')

@section('content_container')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.webp') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>خدماتنا العلاجية</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                <li><span>/</span></li>
                <li>خدماتنا</li>
            </ul>
        </div>
    </div>
</section>

<section class="services-one services-page">
    <div class="services-one__bg" style="background-image: url({{ asset('images/backgrounds/bg1.webp') }});"></div>
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">خدماتنا</span>
            <h2 class="section-title__title">منظومة علاجية متكاملة.. دقة في التشخيص وريادة في العلاج</h2>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                <div class="services-one__single">
                    <div class="services-one__content">
                        <h3 class="services-one__title"><a href="{{ route('website.services') }}">برامج الإقامة الكاملة للأمراض النفسية</a></h3>
                        <p class="services-one__text"><strong>نقدم برامج علاجية شاملة للحالات النفسية التي تحتاج متابعة دقيقة وبيئة مستقرة، وتشمل:</strong></p>
                        <ul class="two-columns-list">
                            <li>التقييم النفسي والتشخيص الدقيق</li>
                            <li>المتابعة الدوائية بإشراف طبي</li>
                            <li>جلسات العلاج النفسي الفردي والجماعي والدعم النفسي</li>
                            <li>التدريب على المهارات الحياتية وإعادة التأهيل الاجتماعي</li>
                            <li>المتابعة المستمرة بعد الخروج</li>
                        </ul>
                    </div>
                    <div class="services-one__img-box">
                        <div class="services-one__img">
                            <img src="{{ asset('images/services/services-1-1.webp') }}" alt="services-image">
                        </div>
                        <div class="services-one__icon">
                            <span class="icon-happy"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                <div class="services-one__single">
                    <div class="services-one__content">
                        <h3 class="services-one__title"><a href="{{ route('website.services') }}">جلسات المشورة والعلاج النفسي (أونلاين وحضور)</a></h3>
                        <p class="services-one__text"><strong>نوفر جلسات مشورة وعلاج نفسي بالحضور داخل المركز أو أونلاين، لتناسب احتياجات الكل. تشمل الجلسات:</strong></p>
                        <ul class="two-columns-list">
                            <li>جلسات علاج نفسي فردي</li>
                            <li>جلسات دعم نفسي أثناء الأزمات</li>
                            <li>جلسات تحسين العلاقات والتواصل</li>
                            <li>جلسات علاج القلق والتوتر</li>
                            <li>جلسات علاج الاكتئاب والضغوط النفسية</li>
                            <li>جلسات تطوير الذات وفهم النفس</li>
                        </ul>
                    </div>
                    <div class="services-one__img-box">
                        <div class="services-one__img">
                            <img src="{{ asset('images/services/services-1-2.webp') }}" alt="services-image">
                        </div>
                        <div class="services-one__icon">
                            <span class="icon-dissociative-identity-disorder"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
                <div class="services-one__single">
                    <div class="services-one__content">
                        <h3 class="services-one__title"><a href="{{ route('website.services') }}">برامج الإقامة الكاملة لعلاج الإدمان</a></h3>
                        <p class="services-one__text"><strong>نقدم برامج علاجية متكاملة داخل بيئة علاجية آمنة، تشمل:</strong></p>
                        <ul class="two-columns-list">
                            <li>التقييم الطبي والنفسي الشامل</li>
                            <li>سحب السموم تحت إشراف طبي 24 ساعة</li>
                            <li>جلسات علاج نفسي فردي وجماعي (CBT & ACT & DBT)</li>
                            <li>تعديل السلوكيات الإدمانية</li>
                            <li>برنامج الـ 12 خطوة</li>
                            <li>دعم أسري وإرشاد عائلي</li>
                            <li>تأهيل اجتماعي ومهاري</li>
                            <li>خطة متابعة بعد التعافي ومنع الانتكاسة</li>
                        </ul>
                    </div>
                    <div class="services-one__img-box">
                        <div class="services-one__img">
                            <img src="{{ asset('images/services/services-1-3.webp') }}" alt="services-image">
                        </div>
                        <div class="services-one__icon">
                            <span class="icon-crm"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="counter-one counter-three">
    <div class="container">
        <ul class="list-unstyled counter-one__list">
            <li>
                <div class="counter-one__icon"><span class="icon-report"></span></div>
                <h4 class="counter-one__title">سنة خبرة وتميز في المجال</h4>
                <div class="counter-one__count-box"><h3 class="odometer" data-count="15">00</h3><span class="counter-one__letter">+</span><span class="counter-one__plus"></span></div>
            </li>
            <li>
                <div class="counter-one__icon"><span class="icon-doctor"></span></div>
                <h4 class="counter-one__title">متخصصون معتمدون</h4>
                <div class="counter-one__count-box"><h3 class="odometer" data-count="50">00</h3><span class="counter-one__letter">+</span></div>
            </li>
            <li>
                <div class="counter-one__icon"><span class="icon-crm"></span></div>
                <h4 class="counter-one__title">معدل رضا المتعافين</h4>
                <div class="counter-one__count-box"><h3 class="odometer" data-count="90">00</h3><span class="counter-one__letter">%</span><span class="counter-one__plus"></span></div>
            </li>
            <li>
                <div class="counter-one__icon"><span class="icon-certificate"></span></div>
                <h4 class="counter-one__title">حالات تعافي ناجحة</h4>
                <div class="counter-one__count-box"><h3 class="odometer" data-count="1200">00</h3><span class="counter-one__letter">k</span></div>
            </li>
        </ul>
    </div>
</section>

<section class="why-choose-three">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="why-choose-three__left">
                    <div class="why-choose-three__img-box">
                        <div class="why-choose-three__img">
                            <img src="{{ asset('images/resources/why-choose-three-img-1.webp') }}" alt="services-bg">
                            <div class="why-choose-three__shape-1 float-bob-x"></div>
                            <div class="why-choose-three__shape-2 float-bob-y"></div>
                        </div>
                        <div class="why-choose-three__img-content-box">
                            <div class="why-choose-three__img-content-icon-two">
                                <img src="{{ asset('images/shapes/why-choose-one-img-content-icon.webp') }}" alt="service-shape">
                            </div>
                            <div class="why-choose-three__img-content-img">
                                <img src="{{ asset('images/resources/skill-one-img-1.webp') }}" alt="service-image">
                                <div class="why-choose-three__img-content-icon">
                                    <span class="icon-consultation-1"></span>
                                </div>
                            </div>
                            <div class="why-choose-three__img-content">
                                <p class="why-choose-three__img-content-text">ابدأ حكايتك بـ20 دقيقة من الدعم المجاني <br> أونلاين!</p>
                                <a href="{{ route('website.contact') }}" class="why-choose-three__img-content-btn">احجز جلستك الآن <i class="fas fa-angle-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="why-choose-one__left">
                    <div class="section-title text-left">
                        <h2 class="section-title__title">برامج التدريب وورش العمل</h2>
                    </div>
                    <p class="why-choose-one__text-2">نقدم ورش عمل وبرامج تدريبية تهدف إلى تعزيز الصحة النفسية وتنمية المهارات الحياتية، مثل:</p>
                    <div class="why-choose-one__points-box">
                        <ul class="list-unstyled why-choose-one__points">
                            <li>
                                <div class="text"><h5>ورش تطوير الذات والصمود النفسي <br> (للأفراد)</h5></div>
                                <div class="icon"><span class="icon-thinking"></span></div>
                            </li>
                            <li>
                                <div class="text"><h5>ورش القيادة والمهارات المهنية <br> (للمؤسسات والمختصين)</h5></div>
                                <div class="icon"><span class="icon-human-brain"></span></div>
                            </li>
                        </ul>
                        <ul class="list-unstyled why-choose-one__points why-choose-one__points--two">
                            <li>
                                <div class="text"><h5>ورش العلاقات والذكاء الاجتماعي <br> (للأفراد والأزواج)</h5></div>
                                <div class="icon"><span class="icon-mental-health-1"></span></div>
                            </li>
                            <li>
                                <div class="text"><h5>ورش التعافي والوقاية <br> (للمتعافين والأسر)</h5></div>
                                <div class="icon"><span class="icon-crm"></span></div>
                            </li>
                        </ul>
                    </div>
                    <div class="why-choose-one__btn-and-call">
                        <p class="why-choose-one__text-2">هذه البرامج موجهة للأفراد، وأسر المتعافين، والمؤسسات التي ترغب في بناء بيئة نفسية صحية لموظفيها.</p>
                        <div class="why-choose-one__btn">
                            <a href="{{ route('website.contact') }}">استفسر عن ورش العمل</a>
                        </div>
                        <div class="why-choose-one__call">
                            <div class="why-choose-one__call-icon">
                                <span class="fas fa-phone-alt"></span>
                            </div>
                            <div class="why-choose-one__call-content">
                                <h4 class="why-choose-one__call-number"><a href="tel:(2+)015-5448-8501">(2+)015-5448-8501</a></h4>
                                <p class="why-choose-one__call-sub-title">تحدث إلينا الآن</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
