@extends('admin.layout')

@section('title', 'الخدمات')

@section('content')
    <section class="card card-body-soft">
        <div class="page-toolbar">
            <h2 class="page-title page-toolbar__title">الخدمات</h2>
            <div class="page-toolbar__actions">
                <a class="btn btn-primary" href="{{ route('admin.services.create') }}">إضافة خدمة</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>المعاينة</th>
                        <th>العنوان</th>
                        <th>Slug</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td><img src="{{ $service->image_url }}" alt="{{ $service->title_ar }}" class="preview-thumb"></td>
                            <td>{{ $service->title_ar }}</td>
                            <td>{{ $service->slug }}</td>
                            <td>
                                <span class="badge {{ $service->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $service->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>{{ $service->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.services.edit', $service) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('هل تريد حذف هذه الخدمة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted empty-cell">لا توجد خدمات.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
