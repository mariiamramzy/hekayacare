@extends('admin.layout')

@section('title', 'تصنيفات المقالات')

@section('content')
    <section class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:12px;">
            <h2 class="page-title" style="margin:0;">تصنيفات المقالات</h2>
            <a class="btn btn-primary" href="{{ route('admin.blog-categories.create') }}">إضافة تصنيف</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Slug</th>
                        <th>الاسم</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>عدد المقالات</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogCategories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>{{ $category->name_ar }}</td>
                            <td>
                                <span class="badge {{ $category->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $category->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>{{ $category->sort_order }}</td>
                            <td>{{ $category->posts_count }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.blog-categories.edit', $category) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.blog-categories.destroy', $category) }}" onsubmit="return confirm('هل تريد حذف هذا التصنيف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted">لا توجد تصنيفات.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
