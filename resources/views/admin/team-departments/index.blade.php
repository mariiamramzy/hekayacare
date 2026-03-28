@extends('admin.layout')

@section('title', 'أقسام الفريق')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">أقسام الفريق</h2>
            <a class="btn btn-primary" href="{{ route('admin.team-departments.create') }}">إضافة قسم</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>الترتيب</th>
                        <th>عدد الأعضاء</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teamDepartments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name_ar }}</td>
                            <td>{{ $department->sort_order }}</td>
                            <td>{{ $department->members_count }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.team-departments.edit', $department) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.team-departments.destroy', $department) }}" onsubmit="return confirm('هل تريد حذف هذا القسم؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="muted">لا توجد أقسام.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
