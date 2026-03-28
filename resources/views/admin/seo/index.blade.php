@extends('admin.layout')

@section('title', 'SEO Center')

@section('content')
    <div class="section-stack">
    <section class="card card-body-soft">
        <h2 class="page-title">SEO Center</h2>
        <p class="muted mb-0">Manage meta tags for website pages and blog posts from one place.</p>
    </section>

    <section class="card card-body-soft">
        <h3 class="section-heading">Website Pages SEO</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Slug</th>
                        <th>Title</th>
                        <th>SEO Status</th>
                        <th>Action</th>
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
                                    <span class="badge status-active">Configured</span>
                                @else
                                    <span class="badge">Not Set</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-secondary" href="{{ route('admin.pages.seo.edit', $page) }}">
                                    {{ $page->seoMeta ? 'Edit SEO' : 'Add SEO' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="card card-body-soft">
        <h3 class="section-heading">Blog Posts SEO</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>SEO Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogPosts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title_ar }}</td>
                            <td><code>{{ $post->slug }}</code></td>
                            <td><span class="badge">{{ $post->status }}</span></td>
                            <td>
                                @if($post->seoMeta)
                                    <span class="badge status-active">Configured</span>
                                @else
                                    <span class="badge">Not Set</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-secondary" href="{{ route('admin.blog-posts.seo.edit', $post) }}">
                                    {{ $post->seoMeta ? 'Edit SEO' : 'Add SEO' }}
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
