@extends('admin.layout')

@section('title', 'أعضاء الفريق')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">أعضاء الفريق</h2>
            <a class="btn btn-primary" href="{{ route('admin.team-members.create') }}">إضافة عضو</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>المسمى</th>
                        <th>التخصص</th>
                        <th>الأقسام</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teamMembers as $member)
                        <tr>
                            <td>{{ $member->id }}</td>
                            <td>{{ $member->name_ar }}</td>
                            <td>{{ $member->title_ar ?: '-' }}</td>
                            <td>{{ $member->specialty_ar ?: '-' }}</td>
                            <td>
                                @forelse($member->departments as $department)
                                    <span class="badge">{{ $department->name_ar }}</span>
                                @empty
                                    <span class="muted">-</span>
                                @endforelse
                            </td>
                            <td>
                                <span class="badge {{ $member->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $member->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>{{ $member->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.team-members.edit', $member) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.team-members.destroy', $member) }}" onsubmit="return confirm('هل تريد حذف هذا العضو؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="muted">لا يوجد أعضاء فريق.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
