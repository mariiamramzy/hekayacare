<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = $request->user('admin');

        if (! $admin || ! $admin->isSuperAdmin()) {
            abort(403, 'Only super admin can access this page.');
        }

        return $next($request);
    }
}
