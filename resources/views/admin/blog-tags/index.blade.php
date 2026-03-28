@extends('admin.layout')

@section('title', 'وسوم المقالات')

@section('content')
    <section class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:12px;">
            <h2 class="page-title" style="margin:0;">وسوم المقالات</h2>
            <a class="btn btn-primary" href="{{ route('admin.blog-tags.create') }}">إضافة وسم</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Slug</th>
                        <th>الاسم</th>
                        <th>عدد المقالات</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogTags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td><code>{{ $tag->slug }}</code></td>
                            <td>{{ $tag->name_ar }}</td>
                            <td>{{ $tag->posts_count }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.blog-tags.edit', $tag) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.blog-tags.destroy', $tag) }}" onsubmit="return confirm('هل تريد حذف هذا الوسم؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="muted">لا توجد وسوم.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
