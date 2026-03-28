@extends('admin.layout')

@section('title', 'جلسات الزوار')

@section('content')
    <section class="card">
        <h2 class="page-title">جلسات الزوار</h2>

        <form method="GET" action="{{ route('admin.visitor-sessions.index') }}" class="actions" style="margin-bottom: 12px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="ابحث بالجلسة أو IP أو المسار...">
            <input type="text" name="referrer_domain" value="{{ request('referrer_domain') }}" placeholder="الدومين المحيل">
            <input type="text" name="utm_source" value="{{ request('utm_source') }}" placeholder="UTM Source">
            <select name="is_bot">
                <option value="">آلي / بشري</option>
                <option value="0" @selected(request('is_bot') === '0')>بشري</option>
                <option value="1" @selected(request('is_bot') === '1')>آلي</option>
            </select>
            <input type="date" name="from" value="{{ request('from') }}">
            <input type="date" name="to" value="{{ request('to') }}">
            <button class="btn btn-secondary" type="submit">تصفية</button>
            <a class="btn btn-secondary" href="{{ route('admin.visitor-sessions.index') }}">إعادة ضبط</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الجلسة</th>
                        <th>IP</th>
                        <th>المصدر</th>
                        <th>صفحة الدخول</th>
                        <th>الإحصائيات</th>
                        <th>أول زيارة</th>
                        <th>آخر زيارة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visitorSessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td style="max-width: 220px; word-break: break-all;">
                                {{ $session->session_id }}
                                @if($session->is_bot)
                                    <div><span class="badge">آلي</span></div>
                                @endif
                            </td>
                            <td>{{ $session->ip_address ?: '-' }}</td>
                            <td>
                                <div>{{ $session->referrer_domain ?: '-' }}</div>
                                <div class="muted">{{ $session->utm_source ?: 'بدون UTM' }}</div>
                            </td>
                            <td style="max-width: 260px; word-break: break-word;">
                                {{ $session->entry_path ?: '-' }}
                            </td>
                            <td>
                                <span class="badge">الزيارات: {{ $session->visit_count }}</span>
                                <span class="badge">الصفحات: {{ $session->page_views }}</span>
                                <span class="badge">الأحداث: {{ $session->events_count }}</span>
                            </td>
                            <td>{{ $session->first_visit_at?->format('Y-m-d H:i:s') ?: '-' }}</td>
                            <td>{{ $session->last_visit_at?->format('Y-m-d H:i:s') ?: '-' }}</td>
                            <td>
                                <a class="btn btn-secondary" href="{{ route('admin.visitor-sessions.show', $session) }}">التفاصيل</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="muted">لا توجد جلسات زوار.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
