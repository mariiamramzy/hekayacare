@extends('admin.layout')

@section('title', 'صور الجاليري')

@section('content')
    <section class="card card-body-soft">
        <div class="page-toolbar">
            <h2 class="page-title page-toolbar__title">صور الجاليري</h2>
            <div class="page-toolbar__actions">
                <a class="btn btn-primary" href="{{ route('admin.gallery-images.create') }}">إضافة صورة</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>المعاينة</th>
                        <th>العنوان</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleryImages as $image)
                        <tr>
                            <td>{{ $image->id }}</td>
                            <td>
                                <img src="{{ $image->image_url }}" alt="{{ $image->image_alt }}" class="preview-thumb">
                            </td>
                            <td>{{ $image->title_ar ?: '-' }}</td>
                            <td>
                                <span class="badge {{ $image->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $image->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>{{ $image->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.gallery-images.edit', $image) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.gallery-images.destroy', $image) }}" onsubmit="return confirm('هل تريد حذف هذه الصورة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="muted empty-cell">لا توجد صور في الجاليري.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
