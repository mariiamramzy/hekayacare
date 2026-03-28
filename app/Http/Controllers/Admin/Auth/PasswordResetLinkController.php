<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('admin.auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin = Admin::query()->where('email', $request->string('email'))->first();

        if (! $admin) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => __(Password::INVALID_USER),
            ]);
        }

        $token = Password::broker('admins')->createToken($admin);
        $admin->sendPasswordResetNotification($token);

        ActivityLogger::log('password_reset_link_sent', $admin);

        $response = back()->with('status', __(Password::RESET_LINK_SENT));

        if ($this->shouldExposeResetUrl()) {
            $response->with('reset_url', url(route('admin.password.reset', [
                'token' => $token,
                'email' => $admin->getEmailForPasswordReset(),
            ], false)));
        }

        return $response;
    }

    protected function shouldExposeResetUrl(): bool
    {
        return App::environment('local') && in_array(Config::get('mail.default'), ['log', 'array'], true);
    }
}
