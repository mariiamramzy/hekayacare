<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorSession;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorSessionController extends Controller
{
    public function index(Request $request): View
    {
        $visitorSessions = VisitorSession::query()
            ->withCount('events')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = trim((string) $request->string('q'));
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('session_id', 'like', '%'.$search.'%')
                        ->orWhere('ip_address', 'like', '%'.$search.'%')
                        ->orWhere('entry_path', 'like', '%'.$search.'%')
                        ->orWhere('entry_url', 'like', '%'.$search.'%');
                });
            })
            ->when($request->filled('referrer_domain'), fn ($query) => $query->where('referrer_domain', 'like', '%'.trim((string) $request->string('referrer_domain')).'%'))
            ->when($request->filled('utm_source'), fn ($query) => $query->where('utm_source', trim((string) $request->string('utm_source'))))
            ->when($request->filled('is_bot'), function ($query) use ($request) {
                $isBot = (string) $request->input('is_bot');
                if ($isBot === '1') {
                    $query->where('is_bot', true);
                } elseif ($isBot === '0') {
                    $query->where('is_bot', false);
                }
            })
            ->when($request->filled('from'), fn ($query) => $query->whereDate('last_visit_at', '>=', (string) $request->input('from')))
            ->when($request->filled('to'), fn ($query) => $query->whereDate('last_visit_at', '<=', (string) $request->input('to')))
            ->orderByDesc('last_visit_at')
            ->get();

        return view('admin.visitor-sessions.index', compact('visitorSessions'));
    }

    public function show(Request $request, VisitorSession $visitorSession): View
    {
        $events = $visitorSession->events()
            ->when($request->filled('method'), fn ($query) => $query->where('method', strtoupper(trim((string) $request->string('method')))))
            ->when($request->filled('route_name'), fn ($query) => $query->where('route_name', 'like', '%'.trim((string) $request->string('route_name')).'%'))
            ->orderByDesc('id')
            ->get();

        return view('admin.visitor-sessions.show', compact('visitorSession', 'events'));
    }
}
