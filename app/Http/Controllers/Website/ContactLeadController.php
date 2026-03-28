<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\FormSubmissionNotificationMail;
use App\Models\ContactLead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactLeadController extends Controller
{
    public function create()
    {
        return view('website.contact');
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string'],
        ]);

        ContactLead::query()->create($validated);

        try {
            Mail::to('info@hekayacare.com')->send(new FormSubmissionNotificationMail(
                'Contact Form',
                [
                    'الاسم' => $validated['name'],
                    'رقم التليفون' => $validated['mobile'],
                    'الرسالة' => $validated['message'],
                ]
            ));
        } catch (\Throwable $e) {
            Log::error('Contact form notification mail failed', [
                'email' => 'info@hekayacare.com',
                'message' => $e->getMessage(),
            ]);
        }

        $message = 'تم ارسال المعلومات للمركز و سيتم التواصل معاك في اقرب وقت';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
