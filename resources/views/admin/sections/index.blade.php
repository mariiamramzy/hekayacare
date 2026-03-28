@extends('admin.layout')

@section('title', 'أقسام الصفحة')

@section('content')
    <section class="card">
        <p class="muted" style="margin-top:0;">الصفحة: <strong>{{ $page->title_ar }}</strong> (<code>{{ $page->slug }}</code>)</p>
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">الأقسام</h2>
            <div class="actions">
                <a class="btn btn-secondary" href="{{ route('admin.pages.index') }}">الرجوع للصفحات</a>
                <a class="btn btn-primary" href="{{ route('admin.pages.sections.create', $page) }}">إضافة قسم</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>المفتاح</th>
                        <th>العنوان</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>عدد العناصر</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sections as $section)
                        <tr>
                            <td>{{ $section->id }}</td>
                            <td><code>{{ $section->key }}</code></td>
                            <td>{{ $section->title_ar ?: '-' }}</td>
                            <td>
                                <span class="badge {{ $section->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $section->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>{{ $section->sort_order }}</td>
                            <td>{{ $section->items_count }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.items.index', [$page, $section]) }}">العناصر</a>
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.edit', [$page, $section]) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}" onsubmit="return confirm('هل تريد حذف هذا القسم وكل عناصره؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted">لا توجد أقسام.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
