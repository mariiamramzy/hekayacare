@extends('admin.layout')

@section('title', 'Visitor Session Details')

@section('content')
    <section class="card">
        <div class="actions" style="justify-content: space-between; margin-bottom: 10px;">
            <h2 class="page-title" style="margin-bottom: 0;">Visitor Session #{{ $visitorSession->id }}</h2>
            <a class="btn btn-secondary" href="{{ route('admin.visitor-sessions.index') }}">Back</a>
        </div>

        <div class="table-wrap">
            <table>
                <tbody>
                    <tr><th style="width: 220px;">Session ID</th><td style="word-break: break-all;">{{ $visitorSession->session_id }}</td></tr>
                    <tr><th>IP Address</th><td>{{ $visitorSession->ip_address ?: '-' }}</td></tr>
                    <tr><th>User Agent</th><td style="white-space: normal;">{{ $visitorSession->user_agent ?: '-' }}</td></tr>
                    <tr><th>Device Type</th><td>{{ $visitorSession->device_type }} @if($visitorSession->is_bot)<span class="badge">bot</span>@endif</td></tr>
                    <tr><th>Accept Language</th><td>{{ $visitorSession->accept_language ?: '-' }}</td></tr>
                    <tr><th>Entry URL</th><td style="word-break: break-all;">{{ $visitorSession->entry_url ?: '-' }}</td></tr>
                    <tr><th>Entry Path</th><td>{{ $visitorSession->entry_path ?: '-' }}</td></tr>
                    <tr><th>Entry Referrer</th><td style="word-break: break-all;">{{ $visitorSession->entry_referrer ?: '-' }}</td></tr>
                    <tr><th>Referrer Domain</th><td>{{ $visitorSession->referrer_domain ?: '-' }}</td></tr>
                    <tr><th>Landing Route</th><td>{{ $visitorSession->landing_route ?: '-' }}</td></tr>
                    <tr><th>UTM Source</th><td>{{ $visitorSession->utm_source ?: '-' }}</td></tr>
                    <tr><th>UTM Medium</th><td>{{ $visitorSession->utm_medium ?: '-' }}</td></tr>
                    <tr><th>UTM Campaign</th><td>{{ $visitorSession->utm_campaign ?: '-' }}</td></tr>
                    <tr><th>UTM Term</th><td>{{ $visitorSession->utm_term ?: '-' }}</td></tr>
                    <tr><th>UTM Content</th><td>{{ $visitorSession->utm_content ?: '-' }}</td></tr>
                    <tr><th>Visit Count</th><td>{{ $visitorSession->visit_count }}</td></tr>
                    <tr><th>Page Views</th><td>{{ $visitorSession->page_views }}</td></tr>
                    <tr><th>First Visit</th><td>{{ $visitorSession->first_visit_at?->format('Y-m-d H:i:s') ?: '-' }}</td></tr>
                    <tr><th>Last Visit</th><td>{{ $visitorSession->last_visit_at?->format('Y-m-d H:i:s') ?: '-' }}</td></tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="card">
        <h3 class="page-title" style="font-size: 18px;">Session Events</h3>

        <form method="GET" action="{{ route('admin.visitor-sessions.show', $visitorSession) }}" class="actions" style="margin-bottom: 12px;">
            <input type="text" name="method" value="{{ request('method') }}" placeholder="Method (GET/POST)">
            <input type="text" name="route_name" value="{{ request('route_name') }}" placeholder="Route name">
            <button class="btn btn-secondary" type="submit">Filter</button>
            <a class="btn btn-secondary" href="{{ route('admin.visitor-sessions.show', $visitorSession) }}">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Visited At</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Duration</th>
                        <th>Route</th>
                        <th>Path</th>
                        <th>Referrer</th>
                        <th>Payload</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $event->visited_at?->format('Y-m-d H:i:s') ?: '-' }}</td>
                            <td><span class="badge">{{ $event->method ?: '-' }}</span></td>
                            <td>{{ $event->http_status ?: '-' }}</td>
                            <td>{{ $event->duration_ms ? $event->duration_ms.' ms' : '-' }}</td>
                            <td style="max-width: 220px; white-space: normal;">{{ $event->route_name ?: '-' }}</td>
                            <td style="max-width: 260px; word-break: break-word;">{{ $event->path }}</td>
                            <td style="max-width: 240px; word-break: break-word;">{{ $event->referrer ?: '-' }}</td>
                            <td style="max-width: 280px; white-space: normal;">
                                @if($event->payload)
                                    <pre style="margin:0; white-space: pre-wrap;">{{ json_encode($event->payload, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="muted">No events found for this session.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
