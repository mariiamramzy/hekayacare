<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\FormSubmissionNotificationMail;
use App\Models\AppointmentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AppointmentRequestController extends Controller
{
    public function create(): View
    {
        return view('website.book-appointment');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'governorate' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'patient_relation' => ['required', 'in:self,proxy'],
            'problem_type' => ['required', 'string', 'max:255'],
            'problem_specialty' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['age'] = (int) ($validated['age'] ?? 30);
        $validated['problem_specialty'] = $validated['problem_specialty'] ?? $validated['problem_type'];

        $appointment = AppointmentRequest::query()->create($validated);

        try {
            Mail::to('info@hekayacare.com')->send(new FormSubmissionNotificationMail(
                'Appointment Form',
                [
                    'الاسم' => $appointment->name,
                    'رقم التليفون' => $appointment->phone,
                    'المحافظة' => $appointment->governorate,
                    'النوع' => $appointment->gender === 'male' ? 'ذكر' : 'أنثى',
                    'السن' => $appointment->age,
                    'هل أنت المريض؟' => $appointment->patient_relation === 'self' ? 'نعم' : 'شخص ينوب عنه',
                    'نوع الخدمة' => $appointment->problem_type,
                    'التخصص أو المشكلة' => $appointment->problem_specialty,
                    'ملاحظات' => $appointment->notes,
                ]
            ));
        } catch (\Throwable $e) {
            Log::error('Appointment mail failed', [
                'appointment_id' => $appointment->id,
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Your request has been submitted successfully.');
    }
}
