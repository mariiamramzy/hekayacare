@extends('admin.layout')

@section('title', 'الأدمنز')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">الأدمنز</h2>
            <a class="btn btn-primary" href="{{ route('admin.admins.create') }}">إضافة أدمن</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الهاتف</th>
                        <th>الحالة</th>
                        <th>الأدوار</th>
                        <th>آخر تسجيل دخول</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone ?: '-' }}</td>
                            <td>
                                <span class="badge {{ $admin->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $admin->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>
                                @forelse ($admin->roles as $role)
                                    <span class="badge">{{ $role->label ?: $role->name }}</span>
                                @empty
                                    <span class="muted">-</span>
                                @endforelse
                            </td>
                            <td>{{ optional($admin->last_login_at)?->format('Y-m-d H:i') ?: '-' }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.admins.edit', $admin) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.admins.destroy', $admin) }}" onsubmit="return confirm('هل تريد حذف هذا الأدمن؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="muted">لا يوجد أدمنز.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
