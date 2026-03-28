@extends('admin.layout')

@section('title', 'سجل النشاط')

@section('content')
    <section class="card">
        <h2 class="page-title">سجل النشاط</h2>

        <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="actions" style="margin-bottom: 12px;">
            <input type="text" name="action" value="{{ request('action') }}" placeholder="تصفية حسب العملية">
            <input type="text" name="subject_type" value="{{ request('subject_type') }}" placeholder="تصفية حسب نوع العنصر">
            <button class="btn btn-secondary" type="submit">تصفية</button>
            <a class="btn btn-secondary" href="{{ route('admin.activity-logs.index') }}">إعادة ضبط</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>العملية</th>
                        <th>الأدمن</th>
                        <th>العنصر</th>
                        <th>IP</th>
                        <th>User Agent</th>
                        <th>الخصائص</th>
                        <th>تاريخ الإنشاء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td><span class="badge">{{ $log->action }}</span></td>
                            <td>{{ $log->admin?->email ?: '-' }}</td>
                            <td>
                                <div>{{ $log->subject_type ?: '-' }}</div>
                                <div class="muted">#{{ $log->subject_id ?: '-' }}</div>
                            </td>
                            <td>{{ $log->ip ?: '-' }}</td>
                            <td style="max-width: 300px; white-space: normal;">{{ $log->user_agent ?: '-' }}</td>
                            <td style="max-width: 340px; white-space: normal;">
                                @if($log->properties)
                                    <pre style="margin:0; white-space: pre-wrap;">{{ json_encode($log->properties, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $log->created_at?->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="muted">لا يوجد سجل نشاط.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
