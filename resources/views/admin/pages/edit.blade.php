@extends('admin.layout')

@section('title', 'تعديل الصفحة')

@section('content')
    <section class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:12px;">
            <h2 class="page-title" style="margin:0;">تعديل الصفحة #{{ $page->id }}</h2>
            <a class="btn btn-secondary" href="{{ route('admin.pages.seo.edit', $page) }}">تعديل SEO</a>
        </div>
        <form method="POST" action="{{ route('admin.pages.update', $page) }}">
            @csrf
            @method('PUT')
            @include('admin.pages._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>

    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h3 style="margin:0;">أقسام الصفحة</h3>
            <a class="btn btn-secondary" href="{{ route('admin.pages.sections.index', $page) }}">إدارة الأقسام</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>المفتاح</th>
                        <th>العنوان</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>عدد العناصر</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($page->sections as $section)
                        <tr>
                            <td><code>{{ $section->key }}</code></td>
                            <td>{{ $section->title_ar ?: '-' }}</td>
                            <td>{{ $section->is_active ? 'نشط' : 'غير نشط' }}</td>
                            <td>{{ $section->sort_order }}</td>
                            <td>{{ $section->items_count }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="muted">لا توجد أقسام بعد.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
