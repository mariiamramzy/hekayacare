<footer class="site-footer">
    <div class="container">
        <div class="site-footer__top">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                    <div class="footer-widget__column footer-widget__about">
                        <div class="footer-widget__logo">
                            <a href="{{ route('website.home') }}">
                                <img class="logo" src="{{ asset('images/backgrounds/logo-1.svg') }}" alt="hekaya logo">
                            </a>
                        </div>
                        <p class="footer-widget__about-text">نهدف إلى توفير بيئة آمنة وداعمة تساعد الأفراد على فهم أنفسهم، مواجهة صعوباتهم، واكتساب مهارات حياتية تمكنهم من العودة لحياة طبيعية منتجة ومستقرة.</p>
                        <div class="footer-widget__social-box">
                            <div class="site-footer__social">
                                <a href="https://www.tiktok.com/@macarynaeem61?_r=1&_t=ZS-94yqJAdr8RY" target="_blank" rel="noopener" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                                <a href="https://www.facebook.com/share/1CWVhUREpY/?mibextid=wwXIfr" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                                <a href="https://www.instagram.com/hekayacare?igsh=dzYzNDY5eXliY25x" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                    <div class="footer-widget__column footer-widget__instagram">
                        <div class="footer-widget__title-box">
                            <h4 class="footer-widget__title">روابط سريعة</h4>
                        </div>
                        <ul class="footer-main-menu__list">
                            <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
                            <li><a href="{{ route('website.about') }}">عن المركز</a></li>
                            <li><a href="{{ route('website.services') }}">الخدمات</a></li>
                            <li><a href="{{ route('website.faqs') }}">الأسئلة الشائعة</a></li>
                            <li><a href="{{ route('website.blogs') }}">المقالات</a></li>
                            <li><a href="{{ route('website.contact') }}">اتصل بنا</a></li>
                        </ul>
                        <div class="footer-widget__open-hours">
                            <h5><span class="icon-back-in-time"></span> ساعات العمل</h5>
                            <p>من السبت للخميس<br>10 AM to 05 AM</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                    <div class="footer-widget__column footer-widget__contact">
                        <div class="footer-widget__title-box">
                            <h4 class="footer-widget__title">اتصل بنا</h4>
                        </div>
                        <ul class="list-unstyled footer-widget__contact-list">
                            <li>
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <div class="text"><p><a href="mailto:needhelp@hekaya.com">needhelp@hekaya.com</a></p></div>
                            </li>
                            <li>
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="text"><p><a href="https://maps.app.goo.gl/RkBirGvZpYXKTqGX9?g_st=iw" target="_blank" rel="noopener">٦ أكتوبر - الحي الخامس</a></p></div>
                            </li>
                        </ul>
                        <div class="footer-widget__call">
                            <div class="footer-widget__call-icon"><span class="fab fa-whatsapp"></span></div>
                            <div class="footer-widget__call-content">
                                <p class="footer-widget__call-number"><a href="https://web.whatsapp.com/send?phone=201554488501" target="_blank" rel="noopener">(2+)015-5448-8501</a></p>
                                <span class="footer-widget__call-sub-title">خط الاستشارة متاح 24 ساعة</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                    <div class="footer-widget__column footer-widget__appointment">
                        <div class="footer-widget__appointment-box">
                            <p class="footer-widget__appointment-sub-title">لحياة أفضل</p>
                            <h5 class="footer-widget__appointment-title">احصل على استشارتك المجانية</h5>

                            <div class="footer-widget__appointment-alert-wrap">
                                @if (session('success'))
                                    <div class="success footer-widget__appointment-alert">{{ session('success') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div class="error footer-widget__appointment-alert">{{ $errors->first() }}</div>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('website.contact.store') }}"
                                class="footer-widget__appointment-form contact-form-validated" novalidate="novalidate"
                                id="footer-contact-form">
                                @csrf
                                <div class="footer-widget__appointment-input-box">
                                    <input type="text" placeholder="الاسم" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="footer-widget__appointment-input-box">
                                    <input type="tel" placeholder="رقم التليفون " name="mobile" value="{{ old('mobile') }}">
                                </div>
                                <div class="footer-widget__appointment-input-box">
                                    <input type="text" placeholder="العنوان ( المحافظه)" name="address" value="{{ old('address') }}">
                                </div>
                                <div class="footer-widget__appointment-input-box">
                                    <div class="select-box">
                                        <select class="wide" name="gender">
                                            <option data-display="النوع"></option>
                                            <option value="1" @selected(old('gender') === '1')>ذكر</option>
                                            <option value="2" @selected(old('gender') === '2')>انثي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="footer-widget__appointment-input-box">
                                    <label style="display: block; margin-bottom: 10px; color: #fff;">هل أنت المريض؟</label>
                                    <div class="radio-group" style="display: flex; gap: 20px; align-items: center;">
                                        <label style="color: #fff; cursor: pointer;">
                                            <input type="radio" name="is_patient" value="1" style="margin-left: 5px;"
                                                @checked(old('is_patient') === '1')> نعم
                                        </label>

                                        <label style="color: #fff; cursor: pointer;">
                                            <input type="radio" name="is_patient" value="2" style="margin-left: 5px;"
                                                @checked(old('is_patient') === '2')> شخص ينوب عنه
                                        </label>
                                    </div>
                                </div>
                                <div class="footer-widget__appointment-input-box">
                                    <div class="select-box">
                                        <select class="wide" name="service_type">
                                            <option data-display="نوع الخدمة"></option>
                                            <option value="detox" @selected(old('service_type') === 'detox')>سحب السموم (Detox)</option>
                                            <option value="behavioral_addiction" @selected(old('service_type') === 'behavioral_addiction')>علاج الإدمان السلوكي</option>
                                            <option value="rehabilitation" @selected(old('service_type') === 'rehabilitation')>التأهيل النفسي والإقامة الكاملة</option>
                                            <option value="dual_diagnosis" @selected(old('service_type') === 'dual_diagnosis')>علاج التشخيص المزدوج (Dual Diagnosis)</option>
                                            <option value="consultations" @selected(old('service_type') === 'consultations')>الاستشارات النفسية والأسرية</option>
                                            <option value="relapse_prevention" @selected(old('service_type') === 'relapse_prevention')>برامج منع الانتكاسة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="footer-widget__appointment-input-box text-message-box">
                                    <textarea name="message" placeholder="ملاحظات">{{ old('message') }}</textarea>
                                </div>
                                <div class="footer-widget__appointment-btn-box">
                                    <button type="submit" class="thm-btn footer-widget__appointment-btn">احجز موعد الأن</button>
                                </div>
                            </form>
                            <div class="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-footer__bottom">
            <div class="row">
                <div class="col-xl-12">
                    <div class="site-footer__bottom-inner">
                        <p class="site-footer__bottom-text">
                            جميع الحقوق محفوظة
                            <a href="{{ route('website.home') }}">
                                <img src="{{ asset('images/backgrounds/favicon.svg') }}" alt="hekaya favicon" style="width: 50px; margin-right: -5px; margin-top: -10px;">
                            </a>
                            © {{ now()->year }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
<script>
    (function () {
        const form = document.getElementById('footer-contact-form');
        if (!form) {
            return;
        }

        const alertWrap = form.parentElement.querySelector('.footer-widget__appointment-alert-wrap');
        const submitButton = form.querySelector('button[type="submit"]');

        const renderAlert = function (type, message) {
            if (!alertWrap) {
                return;
            }

            alertWrap.innerHTML = '<div class="' + type + ' footer-widget__appointment-alert">' + message + '</div>';
        };

        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            if (submitButton) {
                submitButton.disabled = true;
            }

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(form),
                });

                const data = await response.json();

                if (!response.ok) {
                    const firstError = data.errors ? Object.values(data.errors)[0][0] : 'حدث خطأ أثناء الإرسال.';
                    renderAlert('error', firstError);
                    return;
                }

                form.reset();
                renderAlert('success', data.message || 'تم ارسال المعلومات للمركز و سيتم التواصل معاك في اقرب وقت');
            } catch (error) {
                renderAlert('error', 'حدث خطأ أثناء الإرسال. حاول مرة أخرى.');
            } finally {
                if (submitButton) {
                    submitButton.disabled = false;
                }
            }
        });
    })();
</script>
@endpush
