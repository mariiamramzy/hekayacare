@extends('admin.layout')

@section('title', 'قصص الشفاء')

@section('content')
    <section class="card card-body-soft">
        <div class="page-toolbar">
            <h2 class="page-title page-toolbar__title">قصص الشفاء</h2>
            <div class="page-toolbar__actions">
                <a class="btn btn-primary" href="{{ route('admin.portfolio-cases.create') }}">إضافة قصة</a>
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
                    @forelse($portfolioCases as $portfolioCase)
                        <tr>
                            <td>{{ $portfolioCase->id }}</td>
                            <td><img src="{{ $portfolioCase->cover_image_url }}" alt="{{ $portfolioCase->card_title }}" class="preview-thumb"></td>
                            <td>{{ $portfolioCase->title_ar }}</td>
                            <td>{{ $portfolioCase->slug }}</td>
                            <td>
                                <span class="badge {{ $portfolioCase->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $portfolioCase->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>{{ $portfolioCase->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.portfolio-cases.edit', $portfolioCase) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.portfolio-cases.destroy', $portfolioCase) }}" onsubmit="return confirm('هل تريد حذف هذه القصة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted empty-cell">لا توجد قصص شفاء.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
