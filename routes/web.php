<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AppointmentRequestController as AdminAppointmentRequestController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\ContactLeadController as AdminContactLeadController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PortfolioCaseController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionItemController;
use App\Http\Controllers\Admin\SeoMetaController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TeamDepartmentController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\VisitorAnalyticsController;
use App\Http\Controllers\Admin\VisitorSessionController;
use App\Http\Controllers\Website\AppointmentRequestController as WebsiteAppointmentRequestController;
use App\Http\Controllers\Website\BlogController as WebsiteBlogController;
use App\Http\Controllers\Website\ContactLeadController as WebsiteContactLeadController;
use App\Http\Controllers\Website\FaqController as WebsiteFaqController;
use App\Http\Controllers\Website\GalleryController as WebsiteGalleryController;
use App\Http\Controllers\Website\PortfolioController as WebsitePortfolioController;
use App\Http\Controllers\Website\SearchController as WebsiteSearchController;
use App\Http\Controllers\Website\TeamController as WebsiteTeamController;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\PortfolioCase;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestBlogPosts = Cache::remember('website.home.latest_blog_posts', now()->addMinutes(15), function () {
        return BlogPost::query()
            ->with(['category', 'coverMedia'])
            ->published()
            ->latestPublished()
            ->take(3)
            ->get();
    });

    $teamMembers = Cache::remember('website.home.team_members', now()->addMinutes(15), function () {
        return TeamMember::query()
            ->with(['photoMedia', 'departments'])
            ->active()
            ->take(4)
            ->get();
    });

    $featuredFaqs = Cache::remember('website.home.featured_faqs', now()->addMinutes(15), function () {
        return Faq::query()
            ->featured()
            ->take(3)
            ->get();
    });

    $latestPortfolioCases = Cache::remember('website.home.latest_portfolio_cases', now()->addMinutes(15), function () {
        return PortfolioCase::query()
            ->with('coverMedia')
            ->active()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->take(3)
            ->get();
    });

    return view('website.index', compact('latestBlogPosts', 'teamMembers', 'featuredFaqs', 'latestPortfolioCases'));
})->name('website.home');
Route::view('/about', 'website.about')->name('website.about');
Route::get('/team', [WebsiteTeamController::class, 'index'])->name('website.team');
Route::get('/gallery', [WebsiteGalleryController::class, 'index'])->name('website.gallery');
Route::get('/portfolio', [WebsitePortfolioController::class, 'index'])->name('website.portfolio');
Route::get('/portfolio/{portfolioCase:slug}', [WebsitePortfolioController::class, 'show'])->name('website.portfolio-details');
Route::view('/services', 'website.services')->name('website.services');
Route::get('/blogs', [WebsiteBlogController::class, 'index'])->name('website.blogs');
Route::get('/blogs/{blogPost:slug}', [WebsiteBlogController::class, 'show'])->name('website.blog-details');
Route::get('/faqs', [WebsiteFaqController::class, 'index'])->name('website.faqs');
Route::get('/search', WebsiteSearchController::class)->name('website.search');
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');
Route::get('/book-appointment', [WebsiteAppointmentRequestController::class, 'create'])->name('website.book-appointment');
Route::post('/book-appointment', [WebsiteAppointmentRequestController::class, 'store'])->name('website.book-appointment.store');
Route::get('/contact', [WebsiteContactLeadController::class, 'create'])->name('website.contact');
Route::post('/contact', [WebsiteContactLeadController::class, 'store'])->name('website.contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });

    Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::resource('appointment-requests', AdminAppointmentRequestController::class)->except(['create', 'store']);
    Route::patch('appointment-requests/{appointmentRequest}/status', [AdminAppointmentRequestController::class, 'updateStatus'])
        ->name('appointment-requests.status');
    Route::resource('contact-leads', AdminContactLeadController::class)->except(['create', 'store']);
    Route::get('analytics/visitors', [VisitorAnalyticsController::class, 'index'])->name('analytics.visitors');
    Route::resource('visitor-sessions', VisitorSessionController::class)->only(['index', 'show']);
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::resource('pages', PageController::class)->except(['show']);
    Route::get('seo', [SeoMetaController::class, 'index'])->name('seo.index');
    Route::get('pages/{page}/seo', [SeoMetaController::class, 'editPage'])->name('pages.seo.edit');
    Route::put('pages/{page}/seo', [SeoMetaController::class, 'updatePage'])->name('pages.seo.update');
    Route::resource('pages.sections', PageSectionController::class)
        ->parameters(['sections' => 'section'])
        ->except(['show']);
    Route::resource('pages.sections.items', SectionItemController::class)
        ->parameters(['sections' => 'section', 'items' => 'item'])
        ->except(['show']);
    Route::resource('team-members', TeamMemberController::class)->except(['show']);
    Route::resource('gallery-images', GalleryImageController::class)->except(['show']);
    Route::resource('portfolio-cases', PortfolioCaseController::class)->except(['show']);
    Route::resource('team-departments', TeamDepartmentController::class)->except(['show']);
    Route::resource('faqs', FaqController::class)->except(['show']);
    Route::resource('faq-categories', FaqCategoryController::class)->except(['show']);
    Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);
    Route::resource('blog-tags', BlogTagController::class)->except(['show']);
    Route::resource('blog-posts', BlogPostController::class)->except(['show']);
    Route::get('blog-posts/{blogPost}/seo', [SeoMetaController::class, 'editBlogPost'])->name('blog-posts.seo.edit');
    Route::put('blog-posts/{blogPost}/seo', [SeoMetaController::class, 'updateBlogPost'])->name('blog-posts.seo.update');

    Route::middleware('superadmin')->group(function () {
        Route::resource('admins', AdminController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('permissions', PermissionController::class)->except(['show']);
        Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');
        Route::resource('patients', PatientController::class)->except(['show']);
    });
    });
});
