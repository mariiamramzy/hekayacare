@php
    use Illuminate\Support\Facades\Route;

    $adminUser = auth('admin')->user();
    $isSuperAdmin = $adminUser?->isSuperAdmin() ?? false;
    $adminSearchLinks = [];

    $pushAdminLink = function (string $label, string $routeName, string $icon = 'ph-duotone ph-arrow-square-out') use (&$adminSearchLinks) {
        if (Route::has($routeName)) {
            $adminSearchLinks[] = [
                'label' => $label,
                'url' => route($routeName),
                'icon' => $icon,
            ];
        }
    };

    $pushAdminLink('لوحة التحكم', 'admin.dashboard', 'ph-duotone ph-house-line');
    $pushAdminLink('SEO', 'admin.seo.index', 'ph-duotone ph-magnifying-glass');
    $pushAdminLink('أعضاء الفريق', 'admin.team-members.index', 'ph-duotone ph-users-three');
    $pushAdminLink('صور الجاليري', 'admin.gallery-images.index', 'ph-duotone ph-image');
    $pushAdminLink('قصص الشفاء', 'admin.portfolio-cases.index', 'ph-duotone ph-briefcase');
    $pushAdminLink('أقسام الفريق', 'admin.team-departments.index', 'ph-duotone ph-folders');
    $pushAdminLink('الأسئلة الشائعة', 'admin.faqs.index', 'ph-duotone ph-question');
    $pushAdminLink('تصنيفات الأسئلة', 'admin.faq-categories.index', 'ph-duotone ph-list-bullets');
    $pushAdminLink('المقالات', 'admin.blog-posts.index', 'ph-duotone ph-note-pencil');
    $pushAdminLink('تصنيفات المقالات', 'admin.blog-categories.index', 'ph-duotone ph-tag');
    $pushAdminLink('وسوم المقالات', 'admin.blog-tags.index', 'ph-duotone ph-hash');
    $pushAdminLink('تحليلات الزوار', 'admin.analytics.visitors', 'ph-duotone ph-chart-line-up');
    $pushAdminLink('جلسات الزوار', 'admin.visitor-sessions.index', 'ph-duotone ph-monitor');
    $pushAdminLink('طلبات التواصل', 'admin.contact-leads.index', 'ph-duotone ph-chat-circle-dots');
    $pushAdminLink('طلبات الحجز', 'admin.appointment-requests.index', 'ph-duotone ph-calendar-check');
    $pushAdminLink('سجل النشاط', 'admin.activity-logs.index', 'ph-duotone ph-clock-counter-clockwise');

    if ($isSuperAdmin) {
        $pushAdminLink('الأدمنز', 'admin.admins.index', 'ph-duotone ph-user-gear');
        $pushAdminLink('الأدوار', 'admin.roles.index', 'ph-duotone ph-shield-check');
        $pushAdminLink('الصلاحيات', 'admin.permissions.index', 'ph-duotone ph-lock-key');
        $pushAdminLink('المرضى', 'admin.patients.index', 'ph-duotone ph-first-aid-kit');
    }
@endphp

<header class="header-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-sm-4 d-flex align-items-center header-left p-0">
                <span class="header-toggle me-3">
                    <i class="ph ph-circles-four"></i>
                </span>
            </div>

            <div class="col-6 col-sm-8 d-flex align-items-center justify-content-end header-right p-0">
                <ul class="d-flex align-items-center">
                    <li class="header-searchbar">
                        <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <i class="ph ph-magnifying-glass"></i>
                        </a>

                        <div class="offcanvas offcanvas-end header-searchbar-canvas" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRight">
                            <div class="header-searchbar-header">
                                <form class="app-form app-icon-form w-100" action="#" onsubmit="return false;">
                                    <div class="position-relative">
                                        <input
                                            type="search"
                                            class="form-control search-filter"
                                            id="admin-header-search-input"
                                            placeholder="ابحث داخل الأدمن..."
                                            aria-label="بحث"
                                            autocomplete="off"
                                        >
                                        <i class="ti ti-search text-dark"></i>
                                    </div>
                                </form>
                            </div>
                            <div class="offcanvas-body app-scroll p-0">
                                <div class="p-3">
                                    <p class="mb-3 text-secondary" id="admin-search-helper">استخدم البحث للوصول السريع إلى صفحات الأدمن.</p>
                                    <div class="admin-header-search-results" id="admin-header-search-results" data-links='@json($adminSearchLinks)'>
                                        @foreach ($adminSearchLinks as $link)
                                            <a href="{{ $link['url'] }}" class="admin-header-search-item">
                                                <span class="admin-header-search-item__icon">
                                                    <i class="{{ $link['icon'] }}"></i>
                                                </span>
                                                <span class="admin-header-search-item__content">
                                                    <strong>{{ $link['label'] }}</strong>
                                                    <small>{{ $link['url'] }}</small>
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="admin-header-search-empty d-none" id="admin-header-search-empty">
                                        لا توجد صفحات مطابقة.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="header-profile">
                        <a href="#" class="d-block head-icon" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <img src="{{ asset('assets/images/avtar/woman.jpg') }}" alt="avatar" class="b-r-10 h-35 w-35">
                        </a>

                        <div class="dropdown-menu dropdown-menu-end header-profile-dropdown">
                            <div class="header-profile-dropdown__header">الحساب</div>
                            <div class="header-profile-dropdown__body">
                                <div class="header-profile-card">
                                    <img src="{{ asset('assets/images/avtar/woman.jpg') }}" alt="avatar" class="header-profile-card__avatar">
                                    <div class="header-profile-card__content">
                                        <h6 class="mb-0">{{ $adminUser?->name ?? 'أدمن' }}</h6>
                                        <p class="mb-0">{{ $adminUser?->email }}</p>
                                    </div>
                                </div>

                                <ul class="header-profile-menu">
                                    <li>
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <button type="submit" class="mb-0 text-danger border-0 bg-transparent p-0">
                                                <i class="ph-duotone ph-sign-out pe-1 f-s-20"></i> تسجيل الخروج
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
