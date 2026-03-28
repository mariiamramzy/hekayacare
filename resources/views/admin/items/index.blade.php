@extends('admin.layout')

@section('title', 'عناصر القسم')

@section('content')
    <section class="card">
        <p class="muted" style="margin-top:0;">
            الصفحة: <strong>{{ $page->title_ar }}</strong> |
            القسم: <strong>{{ $section->key }}</strong>
        </p>
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">عناصر القسم</h2>
            <div class="actions">
                <a class="btn btn-secondary" href="{{ route('admin.pages.sections.index', $page) }}">الرجوع للأقسام</a>
                <a class="btn btn-primary" href="{{ route('admin.pages.sections.items.create', [$page, $section]) }}">إضافة عنصر</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>العنوان</th>
                        <th>الأيقونة</th>
                        <th>الرابط</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title_ar ?: '-' }}</td>
                            <td>{{ $item->icon ?: '-' }}</td>
                            <td>
                                @if($item->link_type)
                                    <span class="badge">{{ $item->link_type }}</span>
                                    <span>{{ $item->link_value ?: '-' }}</span>
                                @else
                                    <span class="muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $item->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $item->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>{{ $item->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.items.edit', [$page, $section, $item]) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.pages.sections.items.destroy', [$page, $section, $item]) }}" onsubmit="return confirm('هل تريد حذف هذا العنصر؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted">لا توجد عناصر.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
