@extends('admin.layout')

@section('title', 'Page Sections')

@section('content')
    <section class="card">
        <p class="muted" style="margin-top:0;">Page: <strong>{{ $page->title_ar }}</strong> (<code>{{ $page->slug }}</code>)</p>
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">Sections</h2>
            <div class="actions">
                <a class="btn btn-secondary" href="{{ route('admin.pages.index') }}">Back to Pages</a>
                <a class="btn btn-primary" href="{{ route('admin.pages.sections.create', $page) }}">Add Section</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Key</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Sort</th>
                        <th>Items</th>
                        <th>Actions</th>
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
                                    {{ $section->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $section->sort_order }}</td>
                            <td>{{ $section->items_count }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.items.index', [$page, $section]) }}">Items</a>
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.edit', [$page, $section]) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}" onsubmit="return confirm('Delete this section and its items?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted">No sections found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
