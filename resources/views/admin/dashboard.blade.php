@extends('admin.layout')

@section('title', 'لوحة التحكم')
@section('meta_description', 'لوحة تحكم Hekaya لمتابعة الزوار وطلبات الحجز وطلبات التواصل والمقالات وأداء الموقع.')
@section('meta_keywords', 'Hekaya dashboard, admin, analytics, bookings, blog, faqs')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/apexcharts/apexcharts.css') }}">
    <style>
        .dashboard-shell {
            display: grid;
            gap: 20px;
        }

        .dashboard-hero {
            display: grid;
            grid-template-columns: minmax(260px, 320px) 1fr;
            gap: 20px;
        }

        .dashboard-profile-card,
        .dashboard-panel,
        .dashboard-stat-card {
            border: 1px solid #e6ebf2;
            background: #fff;
            box-shadow: 0 16px 40px rgba(21, 38, 75, 0.06);
        }

        .dashboard-profile-card {
            height: 100%;
        }

        .dashboard-avatar {
            width: 76px;
            height: 76px;
            border-radius: 22px;
            object-fit: cover;
            box-shadow: 0 12px 28px rgba(21, 38, 75, 0.12);
        }

        .dashboard-profile-meta {
            display: grid;
            gap: 4px;
            justify-items: center;
        }

        .dashboard-profile-meta h5 {
            margin: 0;
            color: #102d57;
            font-weight: 800;
        }

        .dashboard-profile-meta p {
            margin: 0;
            color: #60728f;
            font-size: 13px;
        }

        .dashboard-profile-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(13, 110, 253, 0.08);
            color: #0d6efd;
            font-size: 12px;
            font-weight: 700;
        }

        .dashboard-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .dashboard-stat-card {
            height: 100%;
        }

        .dashboard-stat-card .card-body {
            padding: 20px;
        }

        .dashboard-stat-card .icon-wrap {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(16, 45, 87, 0.06);
        }

        .dashboard-stat-card h3 {
            margin: 14px 0 4px;
            color: #102d57;
            font-size: 30px;
            font-weight: 800;
        }

        .dashboard-stat-card p {
            margin: 0;
            color: #60728f;
            font-size: 13px;
            font-weight: 600;
        }

        .dashboard-panels-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 20px;
        }

        .dashboard-panel {
            height: 100%;
        }

        .dashboard-panel .card-body {
            padding: 22px;
        }

        .dashboard-panel__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .dashboard-panel__header h5 {
            margin: 0;
            color: #102d57;
            font-weight: 700;
        }

        .dashboard-panel__subtle {
            color: #6c7d97;
            font-size: 12px;
            font-weight: 600;
        }

        .dashboard-status-list {
            display: grid;
            gap: 12px;
        }

        .dashboard-status-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 16px;
            border: 1px solid #e8edf5;
            border-radius: 16px;
            background: #f8fafc;
        }

        .dashboard-status-item strong {
            color: #102d57;
            font-weight: 700;
        }

        .dashboard-status-item span {
            color: #60728f;
        }

        .dashboard-status-item b {
            color: #102d57;
            font-size: 18px;
        }

        .dashboard-list {
            max-height: 360px;
            overflow: auto;
            padding-right: 4px;
        }

        .dashboard-empty {
            text-align: center;
            color: #6b7280;
            padding: 28px 12px;
        }

        .dashboard-compact-list .activity-list-item {
            padding: 14px 0;
            border-bottom: 1px solid #eef2f7;
        }

        .dashboard-compact-list .activity-list-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .dashboard-table-card .table-wrap {
            margin-top: 16px;
        }

        @media (max-width: 1399px) {
            .dashboard-stats-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 1199px) {
            .dashboard-hero,
            .dashboard-panels-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767px) {
            .dashboard-shell {
                gap: 16px;
            }

            .dashboard-stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .dashboard-panel .card-body,
            .dashboard-stat-card .card-body {
                padding: 18px;
            }

            .dashboard-panel__header {
                align-items: flex-start;
                flex-direction: column;
            }

            .dashboard-stat-card h3 {
                font-size: 26px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row m-1">
        <div class="col-12">
            <h4 class="main-title">لوحة التحكم</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="f-s-14 f-w-500">
                        <span><i class="ph-duotone ph-house-line f-s-16"></i> الرئيسية</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#" class="f-s-14 f-w-500">نظرة عامة على التحليلات</a>
                </li>
            </ul>
        </div>
    </div>

    @if(
        $summaryCards->isEmpty() &&
        $recentActivities->isEmpty() &&
        $recentAppointments->isEmpty() &&
        $recentLeads->isEmpty() &&
        $recentBlogPosts->isEmpty() &&
        $popularPages->isEmpty() &&
        !$hasVisitorTrend
    )
        <div class="card dashboard-panel">
            <div class="card-body dashboard-empty">
                لا توجد بيانات متاحة في لوحة التحكم حتى الآن.
            </div>
        </div>
    @else
        <div class="dashboard-shell">
            <section class="dashboard-hero">
                <div class="card dashboard-profile-card">
                    <div class="card-body text-center d-flex flex-column align-items-center justify-content-center gap-3">
                        <img src="{{ asset('assets/images/avtar/woman.jpg') }}" alt="أدمن" class="dashboard-avatar">
                        <div class="dashboard-profile-meta">
                            <h5>{{ $currentAdmin?->name ?? 'Admin' }}</h5>
                            <p>{{ $currentAdmin?->email }}</p>
                        </div>
                        <span class="dashboard-profile-pill">
                            <i class="ph-duotone ph-shield-check"></i>
                            {{ $currentAdmin?->isSuperAdmin() ? 'Super Admin' : 'Admin' }}
                        </span>
                    </div>
                </div>

                @if($summaryCards->isNotEmpty())
                    <div class="dashboard-stats-grid">
                        @foreach($summaryCards as $card)
                            <div class="card dashboard-stat-card">
                                <div class="card-body">
                                    <span class="icon-wrap">
                                        <i class="ph-duotone {{ $card['icon'] }} text-{{ $card['tone'] }} f-s-24"></i>
                                    </span>
                                    <h3>{{ number_format((int) $card['value']) }}</h3>
                                    <p>{{ $card['label'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <section class="dashboard-panels-grid">
                @if($hasVisitorTrend)
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <div class="dashboard-panel__header">
                            <h5>اتجاه الزوار خلال آخر 7 أيام</h5>
                            <span class="dashboard-panel__subtle">نظرة يومية على الجلسات</span>
                            </div>
                            <div id="visitorTrendChart"></div>
                        </div>
                    </div>
                @endif

                @if($statusBreakdown->isNotEmpty())
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <div class="dashboard-panel__header">
                                <h5>حالة طلبات الحجز</h5>
                                <span class="dashboard-panel__subtle">حالة الطلبات الحالية</span>
                            </div>
                            <div class="dashboard-status-list">
                                @foreach($statusBreakdown as $status)
                                    <div class="dashboard-status-item">
                                        <div>
                                            <strong>{{ $status['label'] }}</strong>
                                            <span class="d-block">عدد الطلبات في هذه المرحلة</span>
                                        </div>
                                        <b>{{ number_format($status['total']) }}</b>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </section>

            <section class="dashboard-panels-grid">
                @if($recentActivities->isNotEmpty())
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <div class="dashboard-panel__header">
                                <h5>آخر النشاطات</h5>
                                <span class="dashboard-panel__subtle">أحدث عمليات الأدمن</span>
                            </div>
                            <ul class="activity-list dashboard-list dashboard-compact-list">
                                @foreach($recentActivities as $log)
                                    <li class="activity-list-item">
                                        <div class="activity-list-content">
                                            <h6 class="mb-0">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</h6>
                                            <p class="mb-0 text-secondary">
                                                {{ $log->admin?->name ?? 'System' }}
                                                @if($log->subject_type)
                                                    - {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="flex-shrink-0 align-self-start">
                                            <p class="mb-0 text-primary f-s-12">{{ optional($log->created_at)->diffForHumans() }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if($recentAppointments->isNotEmpty())
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <div class="dashboard-panel__header">
                                <h5>أحدث طلبات الحجز</h5>
                                <span class="dashboard-panel__subtle">أحدث الطلبات المرسلة</span>
                            </div>
                            <ul class="activity-list dashboard-list dashboard-compact-list">
                                @foreach($recentAppointments as $appointment)
                                    @php
                                        $badgeClass = match($appointment->status) {
                                            'new' => 'bg-primary',
                                            'in_progress' => 'bg-warning',
                                            'done' => 'bg-success',
                                            default => 'bg-danger',
                                        };
                                    @endphp
                                    <li class="activity-list-item">
                                        <div class="activity-list-content">
                                            <h6 class="mb-0">{{ $appointment->name }}</h6>
                                            <p class="mb-0 text-secondary">{{ $appointment->problem_specialty }} - {{ $appointment->phone }}</p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge {{ $badgeClass }}">{{ ucfirst(str_replace('_', ' ', $appointment->status)) }}</span>
                                            <p class="mb-0 text-secondary f-s-12 mt-1">{{ $appointment->created_at?->format('Y-m-d') }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </section>

            <section class="dashboard-panels-grid">
                @if($recentLeads->isNotEmpty())
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <div class="dashboard-panel__header">
                                <h5>أحدث طلبات التواصل</h5>
                                <span class="dashboard-panel__subtle">أحدث الرسائل المرسلة من الموقع</span>
                            </div>
                            <ul class="activity-list dashboard-list dashboard-compact-list">
                                @foreach($recentLeads as $lead)
                                    <li class="activity-list-item">
                                        <div class="activity-list-content">
                                            <h6 class="mb-0">{{ $lead->name }}</h6>
                                            <p class="mb-0 text-secondary">{{ \Illuminate\Support\Str::limit($lead->message, 70) }}</p>
                                        </div>
                                        <div class="flex-shrink-0 align-self-start text-end">
                                            <p class="mb-0 text-primary f-s-12">{{ $lead->mobile }}</p>
                                            <p class="mb-0 text-secondary f-s-12">{{ $lead->created_at?->format('Y-m-d') }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if($recentBlogPosts->isNotEmpty())
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <div class="dashboard-panel__header">
                                <h5>أحدث المقالات</h5>
                                <span class="dashboard-panel__subtle">آخر محتوى تم تحديثه</span>
                            </div>
                            <ul class="activity-list dashboard-list dashboard-compact-list">
                                @foreach($recentBlogPosts as $post)
                                    @php
                                        $postBadge = match($post->status) {
                                            'published' => 'bg-success',
                                            'scheduled' => 'bg-warning',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <li class="activity-list-item">
                                        <div class="activity-list-content">
                                            <h6 class="mb-0">{{ $post->title_ar }}</h6>
                                            <p class="mb-0 text-secondary">{{ $post->category?->name_ar ?? 'بدون تصنيف' }}</p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge {{ $postBadge }}">{{ ucfirst($post->status) }}</span>
                                            <p class="mb-0 text-secondary f-s-12 mt-1">{{ number_format((int) $post->views) }} views</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </section>

            @if($popularPages->isNotEmpty())
                <section class="card dashboard-panel dashboard-table-card">
                    <div class="card-body">
                        <div class="dashboard-panel__header">
                            <h5>أكثر الصفحات زيارة</h5>
                            <span class="dashboard-panel__subtle">أكثر المسارات نشاطًا على الموقع</span>
                        </div>
                        <div class="table-wrap">
                            <table class="table table-bottom-border mb-0 no-datatable">
                                <thead>
                                    <tr>
                                        <th>Path</th>
                                        <th>Visits</th>
                                        <th>Avg Duration (ms)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popularPages as $page)
                                        <tr>
                                            <td>{{ $page->path }}</td>
                                            <td class="f-w-600">{{ number_format((int) $page->visits) }}</td>
                                            <td>{{ number_format((float) $page->avg_duration, 0) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    @endif
@endsection

@section('script')
    @if($hasVisitorTrend)
        <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script>
            (function () {
                var element = document.querySelector('#visitorTrendChart');
                if (!element || typeof ApexCharts === 'undefined') {
                    return;
                }

                var chart = new ApexCharts(element, {
                    chart: {
                        type: 'area',
                        height: 320,
                        toolbar: { show: false }
                    },
                    series: [{
                        name: 'الزوار',
                        data: @json($visitorTrendData)
                    }],
                    xaxis: {
                        categories: @json($visitorTrendLabels)
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.35,
                            opacityTo: 0.05,
                            stops: [0, 90, 100]
                        }
                    },
                    colors: ['#0d6efd'],
                    dataLabels: { enabled: false },
                    yaxis: {
                        labels: {
                            formatter: function (val) { return Math.round(val); }
                        }
                    },
                    grid: {
                        strokeDashArray: 4
                    }
                });

                chart.render();
            })();
        </script>
    @endif
@endsection
