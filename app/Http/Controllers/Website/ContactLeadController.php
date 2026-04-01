<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\FormSubmissionNotificationMail;
use App\Models\ContactLead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:1,2'],
            'is_patient' => ['nullable', 'in:1,2'],
            'client_type' => ['nullable', 'in:individual,organization'],
            'service_type' => ['nullable', 'string', 'max:100'],
            'message' => ['nullable', 'string'],
        ]);

        ContactLead::query()->create($validated);

        $genderLabel = match ($validated['gender'] ?? null) {
            '1' => 'ذكر',
            '2' => 'أنثى',
            default => 'غير محدد',
        };

        $patientRelationLabel = match ($validated['is_patient'] ?? null) {
            '1' => 'نعم',
            '2' => 'شخص ينوب عنه',
            default => 'غير محدد',
        };

        $clientTypeLabel = match ($validated['client_type'] ?? null) {
            'individual' => 'فرد',
            'organization' => 'مؤسسة',
            default => 'غير محدد',
        };

        try {
            Mail::to('info@hekayacare.com')->send(new FormSubmissionNotificationMail(
                'Contact Form',
                [
                    'الاسم' => $validated['name'],
                    'رقم التليفون' => $validated['mobile'],
                    'العنوان' => $validated['address'] ?: 'غير محدد',
                    'النوع' => $genderLabel,
                    'هل أنت المريض؟' => $patientRelationLabel,
                    'فرد أم مؤسسة' => $clientTypeLabel,
                    'نوع الخدمة' => $validated['service_type'] ?: 'غير محدد',
                    'ملاحظات' => $validated['message'] ?: 'لا يوجد',
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

