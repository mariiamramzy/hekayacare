<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::query()
            ->with('admin')
            ->when($request->filled('action'), fn ($query) => $query->where('action', $request->string('action')))
            ->when($request->filled('subject_type'), fn ($query) => $query->where('subject_type', $request->string('subject_type')))
            ->orderByDesc('id')
            ->get();

        return view('admin.activity-logs.index', compact('logs'));
    }
}
