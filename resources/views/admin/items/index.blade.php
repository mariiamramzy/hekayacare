@extends('admin.layout')

@section('title', 'Section Items')

@section('content')
    <section class="card">
        <p class="muted" style="margin-top:0;">
            Page: <strong>{{ $page->title_ar }}</strong> |
            Section: <strong>{{ $section->key }}</strong>
        </p>
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">Section Items</h2>
            <div class="actions">
                <a class="btn btn-secondary" href="{{ route('admin.pages.sections.index', $page) }}">Back to Sections</a>
                <a class="btn btn-primary" href="{{ route('admin.pages.sections.items.create', [$page, $section]) }}">Add Item</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Icon</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Sort</th>
                        <th>Actions</th>
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
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $item->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.items.edit', [$page, $section, $item]) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.pages.sections.items.destroy', [$page, $section, $item]) }}" onsubmit="return confirm('Delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted">No items found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
