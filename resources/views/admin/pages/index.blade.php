@extends('admin.layout')

@section('title', 'صفحات الموقع')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">صفحات الموقع</h2>
            <a class="btn btn-primary" href="{{ route('admin.pages.create') }}">إضافة صفحة</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Slug</th>
                        <th>العنوان</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>عدد الأقسام</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td><code>{{ $page->slug }}</code></td>
                            <td>{{ $page->title_ar }}</td>
                            <td>
                                <span class="badge {{ $page->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $page->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>{{ $page->sort_order }}</td>
                            <td>{{ $page->sections_count }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.index', $page) }}">الأقسام</a>
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.seo.edit', $page) }}">SEO</a>
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.edit', $page) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('هل تريد حذف هذه الصفحة وكل أقسامها وعناصرها؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted">لا توجد صفحات.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
