@extends('admin.layout')

@section('title', 'Patients')

@section('content')
    <section class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:12px;">
            <h2 class="page-title" style="margin:0;">المرضى</h2>
            <a class="btn btn-primary" href="{{ route('admin.patients.create') }}">إضافة مريض</a>
        </div>

        <form method="GET" action="{{ route('admin.patients.index') }}" class="actions" style="margin-bottom: 12px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="بحث بالاسم/رقم الملف/المركز...">
            <select name="status">
                <option value="">كل الحالات</option>
                <option value="active" @selected(request('status') === 'active')>نشط</option>
                <option value="discharged" @selected(request('status') === 'discharged')>خروج</option>
                <option value="follow_up" @selected(request('status') === 'follow_up')>متابعة</option>
                <option value="archived" @selected(request('status') === 'archived')>مؤرشف</option>
            </select>
            <button class="btn btn-secondary" type="submit">فلتر</button>
            <a class="btn btn-secondary" href="{{ route('admin.patients.index') }}">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>رقم الملف</th>
                        <th>المسؤول</th>
                        <th>المركز</th>
                        <th>نوع الإدمان</th>
                        <th>الحالة</th>
                        <th>تاريخ الدخول</th>
                        <th>تاريخ الخروج</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->file_number ?: '-' }}</td>
                            <td>
                                <div>{{ $patient->case_manager_name ?: '-' }}</div>
                                <div class="muted">{{ $patient->case_manager_phone ?: '-' }}</div>
                            </td>
                            <td>{{ $patient->center_name ?: '-' }}</td>
                            <td>{{ $patient->addiction_type ?: '-' }}</td>
                            <td><span class="badge">{{ $patient->status }}</span></td>
                            <td>{{ $patient->admission_date?->format('Y-m-d') ?: '-' }}</td>
                            <td>{{ $patient->discharge_date?->format('Y-m-d') ?: '-' }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.patients.edit', $patient) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.patients.destroy', $patient) }}" onsubmit="return confirm('Delete this patient?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="10" class="muted">No patients found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
