<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorEvent;
use App\Models\VisitorSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorAnalyticsController extends Controller
{
    public function index(Request $request): View
    {
        $from = $request->input('from') ?: now()->subDays(29)->toDateString();
        $to = $request->input('to') ?: now()->toDateString();

        $sessionsBase = VisitorSession::query()
            ->whereDate('last_visit_at', '>=', $from)
            ->whereDate('last_visit_at', '<=', $to);

        $eventsBase = VisitorEvent::query()
            ->whereDate('visited_at', '>=', $from)
            ->whereDate('visited_at', '<=', $to);

        $totals = [
            'sessions' => (clone $sessionsBase)->count(),
            'unique_ips' => (clone $sessionsBase)->whereNotNull('ip_address')->distinct('ip_address')->count('ip_address'),
            'page_views' => (int) ((clone $sessionsBase)->sum('page_views')),
            'events' => (clone $eventsBase)->count(),
            'bots' => (clone $sessionsBase)->where('is_bot', true)->count(),
        ];

        $countryStats = (clone $sessionsBase)
            ->selectRaw("COALESCE(NULLIF(country_name, ''), 'Unknown') as label, COUNT(*) as total")
            ->groupBy('label')
            ->orderByDesc('total')
            ->limit(12)
            ->get();

        $deviceStats = (clone $sessionsBase)
            ->selectRaw("COALESCE(NULLIF(device_type, ''), 'unknown') as label, COUNT(*) as total")
            ->groupBy('label')
            ->orderByDesc('total')
            ->get();

        $pageStats = (clone $eventsBase)
            ->select([
                'path',
                DB::raw('COUNT(*) as total'),
                DB::raw('AVG(duration_ms) as avg_duration'),
            ])
            ->groupBy('path')
            ->orderByDesc('total')
            ->limit(15)
            ->get();

        $sourceStats = (clone $sessionsBase)
            ->select([
                'referrer_domain',
                'utm_source',
                DB::raw('COUNT(*) as total'),
            ])
            ->groupBy('referrer_domain', 'utm_source')
            ->orderByDesc('total')
            ->get()
            ->map(function ($row) {
                $referrerDomain = trim((string) ($row->referrer_domain ?? ''));
                $utmSource = trim((string) ($row->utm_source ?? ''));

                if ($referrerDomain !== '') {
                    $label = $referrerDomain;
                } elseif ($utmSource !== '') {
                    $label = 'utm:'.$utmSource;
                } else {
                    $label = 'Direct / Unknown';
                }

                return [
                    'label' => $label,
                    'total' => (int) $row->total,
                ];
            })
            ->groupBy('label')
            ->map(fn ($rows, $label) => [
                'label' => $label,
                'total' => $rows->sum('total'),
            ])
            ->sortByDesc('total')
            ->take(12)
            ->values();

        $dailyTrendRaw = (clone $eventsBase)
            ->selectRaw('DATE(visited_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $dailyTrend = collect();
        $cursor = Carbon::parse($from);
        $toDate = Carbon::parse($to);
        while ($cursor->lte($toDate)) {
            $day = $cursor->toDateString();
            $dailyTrend->push([
                'day' => $day,
                'total' => (int) ($dailyTrendRaw[$day]->total ?? 0),
            ]);
            $cursor->addDay();
        }

        return view('admin.analytics.visitors', compact(
            'from',
            'to',
            'totals',
            'countryStats',
            'deviceStats',
            'pageStats',
            'sourceStats',
            'dailyTrend'
        ));
    }
}
