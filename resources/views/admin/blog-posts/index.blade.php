@extends('admin.layout')

@section('title', 'المقالات')

@section('content')
    <section class="card card-body-soft">
        <div class="page-toolbar">
            <h2 class="page-title page-toolbar__title">المقالات</h2>
            <div class="page-toolbar__actions">
                <a class="btn btn-primary" href="{{ route('admin.blog-posts.create') }}">إضافة مقال</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>العنوان</th>
                        <th>Slug</th>
                        <th>التصنيف</th>
                        <th>الحالة</th>
                        <th>تاريخ النشر</th>
                        <th>المشاهدات</th>
                        <th>الوسوم</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogPosts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title_ar }}</td>
                            <td><code>{{ $post->slug }}</code></td>
                            <td>{{ $post->category?->name_ar ?: '-' }}</td>
                            <td><span class="badge">{{ $post->status }}</span></td>
                            <td>{{ $post->published_at?->format('Y-m-d H:i') ?: '-' }}</td>
                            <td>{{ $post->views }}</td>
                            <td>
                                @forelse($post->tags as $tag)
                                    <span class="badge">{{ $tag->name_ar }}</span>
                                @empty
                                    <span class="muted">-</span>
                                @endforelse
                            </td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.blog-posts.seo.edit', $post) }}">SEO</a>
                                    <a class="btn btn-secondary" href="{{ route('admin.blog-posts.edit', $post) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.blog-posts.destroy', $post) }}" onsubmit="return confirm('هل تريد حذف هذا المقال؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="muted empty-cell">لا توجد مقالات.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
