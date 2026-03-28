@extends('admin.layout')

@section('title', 'مركز SEO')

@section('content')
    <div class="section-stack">
        <section class="card card-body-soft">
            <h2 class="page-title">مركز SEO</h2>
            <p class="muted mb-0">إدارة الميتا تاجز لصفحات الموقع والمقالات من مكان واحد.</p>
        </section>

        <section class="card card-body-soft">
            <h3 class="section-heading">SEO صفحات الموقع</h3>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Slug</th>
                            <th>العنوان</th>
                            <th>حالة SEO</th>
                            <th>الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td><code>{{ $page->slug }}</code></td>
                                <td>{{ $page->title_ar }}</td>
                                <td>
                                    @if($page->seoMeta)
                                        <span class="badge status-active">مضبوط</span>
                                    @else
                                        <span class="badge">غير مضبوط</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.seo.edit', $page) }}">
                                        {{ $page->seoMeta ? 'تعديل SEO' : 'إضافة SEO' }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="card card-body-soft">
            <h3 class="section-heading">SEO المقالات</h3>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>العنوان</th>
                            <th>Slug</th>
                            <th>الحالة</th>
                            <th>حالة SEO</th>
                            <th>الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogPosts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title_ar }}</td>
                                <td><code>{{ $post->slug }}</code></td>
                                <td>
                                    <span class="badge">
                                        {{ $post->status === 'published' ? 'منشور' : ($post->status === 'scheduled' ? 'مجدول' : 'مسودة') }}
                                    </span>
                                </td>
                                <td>
                                    @if($post->seoMeta)
                                        <span class="badge status-active">مضبوط</span>
                                    @else
                                        <span class="badge">غير مضبوط</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('admin.blog-posts.seo.edit', $post) }}">
                                        {{ $post->seoMeta ? 'تعديل SEO' : 'إضافة SEO' }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
