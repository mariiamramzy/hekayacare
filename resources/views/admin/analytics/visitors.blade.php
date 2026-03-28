@extends('admin.layout')

@section('title', 'تحليلات الزوار')

@section('content')
    <section class="card">
        <div class="actions" style="justify-content: space-between; margin-bottom: 12px;">
            <h2 class="page-title" style="margin-bottom: 0;">تحليلات الزوار</h2>
            <form method="GET" action="{{ route('admin.analytics.visitors') }}" class="actions">
                <input type="date" name="from" value="{{ $from }}">
                <input type="date" name="to" value="{{ $to }}">
                <button class="btn btn-secondary" type="submit">تطبيق</button>
                <a class="btn btn-secondary" href="{{ route('admin.analytics.visitors') }}">إعادة ضبط</a>
            </form>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:10px;">
            <div class="card" style="margin:0;">
                <div class="muted">الجلسات</div>
                <div style="font-size:24px;font-weight:700;">{{ number_format($totals['sessions']) }}</div>
            </div>
            <div class="card" style="margin:0;">
                <div class="muted">عناوين IP الفريدة</div>
                <div style="font-size:24px;font-weight:700;">{{ number_format($totals['unique_ips']) }}</div>
            </div>
            <div class="card" style="margin:0;">
                <div class="muted">مشاهدات الصفحات</div>
                <div style="font-size:24px;font-weight:700;">{{ number_format($totals['page_views']) }}</div>
            </div>
            <div class="card" style="margin:0;">
                <div class="muted">الأحداث</div>
                <div style="font-size:24px;font-weight:700;">{{ number_format($totals['events']) }}</div>
            </div>
            <div class="card" style="margin:0;">
                <div class="muted">الزيارات الآلية</div>
                <div style="font-size:24px;font-weight:700;">{{ number_format($totals['bots']) }}</div>
            </div>
        </div>
    </section>

    <section class="card">
        <h3 class="page-title" style="font-size:18px;">اتجاه الزيارات اليومي</h3>
        <canvas id="dailyTrendChart" height="90"></canvas>
    </section>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(380px,1fr));gap:16px;">
        <section class="card">
            <h3 class="page-title" style="font-size:18px;">أعلى الدول</h3>
            <canvas id="countriesChart" height="160"></canvas>
        </section>

        <section class="card">
            <h3 class="page-title" style="font-size:18px;">الأجهزة</h3>
            <canvas id="devicesChart" height="160"></canvas>
        </section>
    </div>

    <section class="card">
        <h3 class="page-title" style="font-size:18px;">أهم المصادر</h3>
        <canvas id="sourcesChart" height="100"></canvas>
    </section>

    <section class="card">
        <h3 class="page-title" style="font-size:18px;">أكثر الصفحات زيارة</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>المسار</th>
                        <th>الزيارات</th>
                        <th>متوسط المدة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pageStats as $page)
                        <tr>
                            <td style="word-break: break-word;">{{ $page->path }}</td>
                            <td>{{ number_format($page->total) }}</td>
                            <td>{{ $page->avg_duration ? number_format((float) $page->avg_duration, 0).' ms' : '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="muted">لا توجد بيانات صفحات.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dailyTrend = @json($dailyTrend);
        const countryStats = @json($countryStats);
        const deviceStats = @json($deviceStats);
        const sourceStats = @json($sourceStats);

        new Chart(document.getElementById('dailyTrendChart'), {
            type: 'line',
            data: {
                labels: dailyTrend.map(item => item.day),
                datasets: [{
                    label: 'الأحداث',
                    data: dailyTrend.map(item => item.total),
                    borderColor: '#0f766e',
                    backgroundColor: 'rgba(15, 118, 110, 0.12)',
                    fill: true,
                    tension: 0.3,
                }],
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } },
            }
        });

        new Chart(document.getElementById('countriesChart'), {
            type: 'bar',
            data: {
                labels: countryStats.map(item => item.label),
                datasets: [{
                    label: 'الجلسات',
                    data: countryStats.map(item => item.total),
                    backgroundColor: '#2563eb',
                }],
            },
            options: {
                indexAxis: 'y',
                plugins: { legend: { display: false } },
                scales: { x: { beginAtZero: true } },
            }
        });

        new Chart(document.getElementById('devicesChart'), {
            type: 'doughnut',
            data: {
                labels: deviceStats.map(item => item.label),
                datasets: [{
                    data: deviceStats.map(item => item.total),
                    backgroundColor: ['#0f766e', '#2563eb', '#f59e0b', '#ef4444', '#7c3aed', '#6b7280'],
                }],
            },
        });

        new Chart(document.getElementById('sourcesChart'), {
            type: 'bar',
            data: {
                labels: sourceStats.map(item => item.label),
                datasets: [{
                    label: 'الجلسات',
                    data: sourceStats.map(item => item.total),
                    backgroundColor: '#0ea5e9',
                }],
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } },
            }
        });
    </script>
@endsection
