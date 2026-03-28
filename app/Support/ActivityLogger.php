<?php

namespace App\Support;

use App\Models\ActivityLog;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(string $action, ?Model $subject = null, ?array $properties = null): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        $adminId = null;
        $user = Auth::user();
        if ($user instanceof Admin) {
            $adminId = $user->id;
        } elseif (session()->has('admin_id')) {
            $adminId = session('admin_id');
        }

        ActivityLog::query()->create([
            'admin_id' => $adminId,
            'action' => $action,
            'subject_type' => $subject ? $subject::class : null,
            'subject_id' => $subject?->getKey(),
            'properties' => $properties,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
