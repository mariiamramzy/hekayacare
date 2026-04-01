@php
    use Illuminate\Support\Facades\Route;

    $currentAdmin = auth('admin')->user();
    $isSuperAdmin = $currentAdmin?->isSuperAdmin() ?? false;

    $isActive = function (array $patterns): bool {
        foreach ($patterns as $pattern) {
            if (request()->routeIs($pattern)) {
                return true;
            }
        }

        return false;
    };

    $hasRoute = fn (string $name): bool => Route::has($name);

    $contentOpen = $isActive([
        'admin.seo.*',
        'admin.team-members.*',
        'admin.gallery-images.*',
        'admin.services.*',
        'admin.portfolio-cases.*',
        'admin.team-departments.*',
        'admin.faqs.*',
        'admin.faq-categories.*',
        'admin.blog-posts.*',
        'admin.blog-categories.*',
        'admin.blog-tags.*',
    ]);

    $usersOpen = $isSuperAdmin && $isActive([
        'admin.admins.*',
        'admin.roles.*',
        'admin.permissions.*',
        'admin.patients.*',
    ]);

    $reportsOpen = $isActive([
        'admin.analytics.visitors',
        'admin.visitor-sessions.*',
        'admin.activity-logs.*',
        'admin.contact-leads.*',
        'admin.appointment-requests.*',
    ]);
@endphp

<nav>
    <div class="app-logo">
        <a class="logo admin-sidebar-logo d-inline-block" href="{{ route('admin.dashboard') }}">
            <span class="admin-sidebar-logo__mark">
                <img src="{{ asset('images/backgrounds/favicon.svg') }}" alt="Hekaya icon">
            </span>
            <span class="admin-sidebar-logo__text">
                <strong>حكاية</strong>
                <small>مركز للصحة النفسية</small>
            </span>
        </a>

        <span class="bg-light-primary toggle-semi-nav">
            <i class="ti ti-chevrons-right f-s-20"></i>
        </span>
    </div>

    <div class="app-nav" id="app-simple-bar">
        <ul class="main-nav p-0 mt-2">
            <li class="menu-title"><span>لوحة التحكم</span></li>
            <li class="no-sub">
                <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="ph-duotone ph-house-line"></i>
                    الرئيسية
                </a>
            </li>

            <li class="menu-title"><span>الإدارة</span></li>

            @if($isSuperAdmin)
                <li>
                    <a data-bs-toggle="collapse" href="#admin-users" aria-expanded="{{ $usersOpen ? 'true' : 'false' }}">
                        <i class="ph-duotone ph-users-three"></i>
                        صلاحيات الأدمن
                    </a>
                    <ul class="collapse {{ $usersOpen ? 'show' : '' }}" id="admin-users">
                        @if($hasRoute('admin.admins.index'))
                            <li><a class="{{ request()->routeIs('admin.admins.*') ? 'active' : '' }}" href="{{ route('admin.admins.index') }}">الأدمنز</a></li>
                        @endif
                        @if($hasRoute('admin.roles.index'))
                            <li><a class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">الأدوار</a></li>
                        @endif
                        @if($hasRoute('admin.permissions.index'))
                            <li><a class="{{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">الصلاحيات</a></li>
                        @endif
                        @if($hasRoute('admin.patients.index'))
                            <li><a class="{{ request()->routeIs('admin.patients.*') ? 'active' : '' }}" href="{{ route('admin.patients.index') }}">المرضى</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            <li>
                <a data-bs-toggle="collapse" href="#admin-content" aria-expanded="{{ $contentOpen ? 'true' : 'false' }}">
                    <i class="ph-duotone ph-notebook"></i>
                    المحتوى
                </a>
                <ul class="collapse {{ $contentOpen ? 'show' : '' }}" id="admin-content">
                    @if($hasRoute('admin.seo.index'))
                        <li><a class="{{ request()->routeIs('admin.seo.*') ? 'active' : '' }}" href="{{ route('admin.seo.index') }}">SEO</a></li>
                    @endif
                    @if($hasRoute('admin.team-members.index'))
                        <li><a class="{{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}" href="{{ route('admin.team-members.index') }}">أعضاء الفريق</a></li>
                    @endif
                    @if($hasRoute('admin.gallery-images.index'))
                        <li><a class="{{ request()->routeIs('admin.gallery-images.*') ? 'active' : '' }}" href="{{ route('admin.gallery-images.index') }}">صور الجاليري</a></li>
                    @endif
                    @if($hasRoute('admin.services.index'))
                        <li><a class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">الخدمات</a></li>
                    @endif
                    @if($hasRoute('admin.portfolio-cases.index'))
                        <li><a class="{{ request()->routeIs('admin.portfolio-cases.*') ? 'active' : '' }}" href="{{ route('admin.portfolio-cases.index') }}">قصص الشفاء</a></li>
                    @endif
                    @if($hasRoute('admin.team-departments.index'))
                        <li><a class="{{ request()->routeIs('admin.team-departments.*') ? 'active' : '' }}" href="{{ route('admin.team-departments.index') }}">أقسام الفريق</a></li>
                    @endif
                    @if($hasRoute('admin.faqs.index'))
                        <li><a class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">الأسئلة الشائعة</a></li>
                    @endif
                    @if($hasRoute('admin.faq-categories.index'))
                        <li><a class="{{ request()->routeIs('admin.faq-categories.*') ? 'active' : '' }}" href="{{ route('admin.faq-categories.index') }}">تصنيفات الأسئلة</a></li>
                    @endif
                    @if($hasRoute('admin.blog-posts.index'))
                        <li><a class="{{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}" href="{{ route('admin.blog-posts.index') }}">المقالات</a></li>
                    @endif
                    @if($hasRoute('admin.blog-categories.index'))
                        <li><a class="{{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}" href="{{ route('admin.blog-categories.index') }}">تصنيفات المقالات</a></li>
                    @endif
                    @if($hasRoute('admin.blog-tags.index'))
                        <li><a class="{{ request()->routeIs('admin.blog-tags.*') ? 'active' : '' }}" href="{{ route('admin.blog-tags.index') }}">وسوم المقالات</a></li>
                    @endif
                </ul>
            </li>

            <li>
                <a data-bs-toggle="collapse" href="#admin-reports" aria-expanded="{{ $reportsOpen ? 'true' : 'false' }}">
                    <i class="ph-duotone ph-chart-line-up"></i>
                    التقارير
                </a>
                <ul class="collapse {{ $reportsOpen ? 'show' : '' }}" id="admin-reports">
                    @if($hasRoute('admin.analytics.visitors'))
                        <li><a class="{{ request()->routeIs('admin.analytics.visitors') ? 'active' : '' }}" href="{{ route('admin.analytics.visitors') }}">تحليلات الزوار</a></li>
                    @endif
                    @if($hasRoute('admin.visitor-sessions.index'))
                        <li><a class="{{ request()->routeIs('admin.visitor-sessions.*') ? 'active' : '' }}" href="{{ route('admin.visitor-sessions.index') }}">جلسات الزوار</a></li>
                    @endif
                    @if($hasRoute('admin.contact-leads.index'))
                        <li><a class="{{ request()->routeIs('admin.contact-leads.*') ? 'active' : '' }}" href="{{ route('admin.contact-leads.index') }}">طلبات التواصل</a></li>
                    @endif
                    @if($hasRoute('admin.appointment-requests.index'))
                        <li><a class="{{ request()->routeIs('admin.appointment-requests.*') ? 'active' : '' }}" href="{{ route('admin.appointment-requests.index') }}">طلبات الحجز</a></li>
                    @endif
                    @if($hasRoute('admin.activity-logs.index'))
                        <li><a class="{{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}" href="{{ route('admin.activity-logs.index') }}">سجل النشاط</a></li>
                    @endif
                </ul>
            </li>

        </ul>
    </div>

    <div class="menu-navs">
        <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
        <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
    </div>
</nav>
