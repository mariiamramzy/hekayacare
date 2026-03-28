<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentRequestController extends Controller
{
    public function index(Request $request): View
    {
        $appointments = AppointmentRequest::query()
            ->when(
                $request->filled('status'),
                fn ($query) => $query->where('status', $request->string('status'))
            )
            ->orderByDesc('id')
            ->get();

        return view('admin.appointment-requests.index', compact('appointments'));
    }

    public function show(AppointmentRequest $appointmentRequest): RedirectResponse
    {
        return redirect()->route('admin.appointment-requests.edit', $appointmentRequest);
    }

    public function edit(AppointmentRequest $appointmentRequest): View
    {
        return view('admin.appointment-requests.edit', compact('appointmentRequest'));
    }

    public function update(Request $request, AppointmentRequest $appointmentRequest): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'governorate' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'patient_relation' => ['required', 'in:self,proxy'],
            'problem_type' => ['required', 'string', 'max:255'],
            'problem_specialty' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:new,in_progress,done,spam'],
        ]);

        $appointmentRequest->update($validated);

        return redirect()->route('admin.appointment-requests.index')->with('success', 'Appointment request updated.');
    }

    public function updateStatus(Request $request, AppointmentRequest $appointmentRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,in_progress,done,spam'],
        ]);

        $appointmentRequest->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status updated.');
    }

    public function destroy(AppointmentRequest $appointmentRequest): RedirectResponse
    {
        $appointmentRequest->delete();

        return redirect()->route('admin.appointment-requests.index')->with('success', 'Appointment request deleted.');
    }
}
