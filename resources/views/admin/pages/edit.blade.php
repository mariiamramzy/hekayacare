@extends('admin.layout')

@section('title', 'Edit Page')

@section('content')
    <section class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:12px;">
            <h2 class="page-title" style="margin:0;">Edit Page #{{ $page->id }}</h2>
            <a class="btn btn-secondary" href="{{ route('admin.pages.seo.edit', $page) }}">Edit SEO</a>
        </div>
        <form method="POST" action="{{ route('admin.pages.update', $page) }}">
            @csrf
            @method('PUT')
            @include('admin.pages._form', ['buttonText' => 'Update Page'])
        </form>
    </section>

    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h3 style="margin:0;">Page Sections</h3>
            <a class="btn btn-secondary" href="{{ route('admin.pages.sections.index', $page) }}">Manage Sections</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Sort</th>
                        <th>Items</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($page->sections as $section)
                        <tr>
                            <td><code>{{ $section->key }}</code></td>
                            <td>{{ $section->title_ar ?: '-' }}</td>
                            <td>{{ $section->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $section->sort_order }}</td>
                            <td>{{ $section->items_count }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="muted">No sections yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
