@extends('admin.layout')

@section('title', 'طلبات الحجز')

@section('content')
    <section class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:12px;">
            <h2 class="page-title" style="margin:0;">طلبات الحجز</h2>
            <form method="GET" action="{{ route('admin.appointment-requests.index') }}" class="actions">
                <select name="status">
                    <option value="">كل الحالات</option>
                    @foreach (['new','in_progress','done','spam'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ['new' => 'جديد', 'in_progress' => 'قيد المتابعة', 'done' => 'مكتمل', 'spam' => 'مزعج'][$s] ?? $s }}</option>
                    @endforeach
                </select>
                <button class="btn btn-secondary" type="submit">تصفية</button>
                <a class="btn btn-secondary" href="{{ route('admin.appointment-requests.index') }}">إعادة ضبط</a>
            </form>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>المحافظة</th>
                        <th>النوع</th>
                        <th>العمر</th>
                        <th>صلة القرابة</th>
                        <th>نوع المشكلة</th>
                        <th>تخصص المشكلة</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->governorate }}</td>
                            <td>{{ $appointment->gender }}</td>
                            <td>{{ $appointment->age }}</td>
                            <td>{{ $appointment->patient_relation }}</td>
                            <td>{{ $appointment->problem_type }}</td>
                            <td>{{ $appointment->problem_specialty }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.appointment-requests.status', $appointment) }}" class="actions">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status">
                                        @foreach (['new','in_progress','done','spam'] as $s)
                                            <option value="{{ $s }}" @selected($appointment->status === $s)>{{ ['new' => 'جديد', 'in_progress' => 'قيد المتابعة', 'done' => 'مكتمل', 'spam' => 'مزعج'][$s] ?? $s }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-secondary" type="submit">تحديث</button>
                                </form>
                            </td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.appointment-requests.edit', $appointment) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.appointment-requests.destroy', $appointment) }}" onsubmit="return confirm('هل تريد حذف هذا الطلب؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="11" class="muted">لا توجد طلبات حجز.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
