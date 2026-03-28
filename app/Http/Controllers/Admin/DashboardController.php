<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Admin;
use App\Models\AppointmentRequest;
use App\Models\BlogPost;
use App\Models\ContactLead;
use App\Models\VisitorEvent;
use App\Models\VisitorSession;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $summaryCards = collect([
            [
                'label' => 'إجمالي الزوار',
                'value' => VisitorSession::query()->count(),
                'icon' => 'ph-chart-line-up',
                'tone' => 'primary',
            ],
            [
                'label' => 'مشاهدات الصفحات',
                'value' => (int) VisitorSession::query()->sum('page_views'),
                'icon' => 'ph-eye',
                'tone' => 'info',
            ],
            [
                'label' => 'طلبات الحجز',
                'value' => AppointmentRequest::query()->count(),
                'icon' => 'ph-calendar-check',
                'tone' => 'success',
            ],
            [
                'label' => 'حجوزات جديدة',
                'value' => AppointmentRequest::query()->where('status', 'new')->count(),
                'icon' => 'ph-timer',
                'tone' => 'warning',
            ],
            [
                'label' => 'طلبات التواصل',
                'value' => ContactLead::query()->count(),
                'icon' => 'ph-chat-circle-dots',
                'tone' => 'secondary',
            ],
            [
                'label' => 'المقالات المنشورة',
                'value' => BlogPost::query()->where('status', 'published')->count(),
                'icon' => 'ph-article',
                'tone' => 'dark',
            ],
            [
                'label' => 'الأدمنز النشطون',
                'value' => Admin::query()->where('is_active', true)->count(),
                'icon' => 'ph-shield-check',
                'tone' => 'primary',
            ],
        ])->filter(fn (array $card): bool => (int) $card['value'] > 0)->values();

        $recentActivities = ActivityLog::query()
            ->with('admin:id,name')
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        $recentAppointments = AppointmentRequest::query()
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        $recentLeads = ContactLead::query()
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        $recentBlogPosts = BlogPost::query()
            ->with('category:id,name_ar')
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        $popularPages = VisitorEvent::query()
            ->selectRaw('path, COUNT(*) as visits, AVG(duration_ms) as avg_duration')
            ->whereNotNull('path')
            ->where('path', '!=', '')
            ->groupBy('path')
            ->orderByDesc('visits')
            ->limit(8)
            ->get();

        $appointmentsByStatus = AppointmentRequest::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $statusLabelsMap = [
            'new' => 'جديد',
            'in_progress' => 'قيد المتابعة',
            'done' => 'مكتمل',
            'spam' => 'مزعج',
        ];

        $statusBreakdown = collect($statusLabelsMap)
            ->map(fn (string $label, string $status): array => [
                'label' => $label,
                'total' => (int) ($appointmentsByStatus[$status] ?? 0),
            ])
            ->filter(fn (array $item): bool => $item['total'] > 0)
            ->values();

        $from = now()->subDays(6)->startOfDay();

        $dailyVisitorRaw = VisitorSession::query()
            ->whereNotNull('last_visit_at')
            ->whereDate('last_visit_at', '>=', $from->toDateString())
            ->selectRaw('DATE(last_visit_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

        $visitorTrendLabels = [];
        $visitorTrendData = [];

        $cursor = $from->copy();
        while ($cursor->lte(now()->startOfDay())) {
            $day = $cursor->toDateString();
            $visitorTrendLabels[] = $cursor->format('D');
            $visitorTrendData[] = (int) ($dailyVisitorRaw[$day] ?? 0);
            $cursor->addDay();
        }

        $hasVisitorTrend = array_sum($visitorTrendData) > 0;

        return view('admin.dashboard', [
            'summaryCards' => $summaryCards,
            'recentActivities' => $recentActivities,
            'recentAppointments' => $recentAppointments,
            'recentLeads' => $recentLeads,
            'recentBlogPosts' => $recentBlogPosts,
            'popularPages' => $popularPages,
            'statusBreakdown' => $statusBreakdown,
            'visitorTrendLabels' => $visitorTrendLabels,
            'visitorTrendData' => $visitorTrendData,
            'hasVisitorTrend' => $hasVisitorTrend,
            'currentAdmin' => auth('admin')->user(),
        ]);
    }
}
