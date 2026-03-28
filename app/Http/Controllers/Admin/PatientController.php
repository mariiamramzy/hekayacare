<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(Request $request): View
    {
        $patients = Patient::query()
            ->with(['creator', 'updater'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = trim((string) $request->string('q'));
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('name', 'like', '%'.$search.'%')
                        ->orWhere('file_number', 'like', '%'.$search.'%')
                        ->orWhere('center_name', 'like', '%'.$search.'%')
                        ->orWhere('case_manager_name', 'like', '%'.$search.'%')
                        ->orWhere('case_manager_phone', 'like', '%'.$search.'%');
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', (string) $request->input('status')))
            ->orderByDesc('id')
            ->get();

        return view('admin.patients.index', compact('patients'));
    }

    public function create(): View
    {
        return view('admin.patients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePatient($request);

        $validated['created_by'] = $request->user('admin')?->id;
        $validated['updated_by'] = $request->user('admin')?->id;

        Patient::query()->create($validated);

        return redirect()->route('admin.patients.index')->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient): RedirectResponse
    {
        return redirect()->route('admin.patients.edit', $patient);
    }

    public function edit(Patient $patient): View
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $validated = $this->validatePatient($request, $patient);
        $validated['updated_by'] = $request->user('admin')?->id;

        $patient->update($validated);

        return redirect()->route('admin.patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();

        return redirect()->route('admin.patients.index')->with('success', 'Patient deleted successfully.');
    }

    private function validatePatient(Request $request, ?Patient $patient = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'file_number' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('patients', 'file_number')->ignore($patient?->id),
            ],
            'case_manager_name' => ['nullable', 'string', 'max:255'],
            'case_manager_phone' => ['nullable', 'string', 'max:50'],
            'center_name' => ['nullable', 'string', 'max:255'],
            'supervisor_name' => ['nullable', 'string', 'max:255'],
            'addiction_type' => ['nullable', 'string', 'max:255'],
            'psychiatric_diagnosis' => ['nullable', 'string'],
            'admission_date' => ['nullable', 'date'],
            'discharge_date' => ['nullable', 'date', 'after_or_equal:admission_date'],
            'status' => ['required', Rule::in(['active', 'discharged', 'follow_up', 'archived'])],
            'gender' => ['nullable', Rule::in(['male', 'female'])],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'phone' => ['nullable', 'string', 'max:50'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
