<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('admin.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('admin')->attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'is_active' => true,
        ], $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Invalid credentials or inactive admin account.']);
        }

        $request->session()->regenerate();
        $admin = Auth::guard('admin')->user();
        $admin->update(['last_login_at' => now()]);
        $request->session()->put('admin_id', $admin->id);
        ActivityLogger::log('login', $admin);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            ActivityLogger::log('logout', $admin);
        }

        Auth::guard('admin')->logout();
        $request->session()->forget('admin_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
