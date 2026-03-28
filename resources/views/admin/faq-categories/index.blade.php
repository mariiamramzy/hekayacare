@extends('admin.layout')

@section('title', 'FAQ Categories')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">FAQ Categories</h2>
            <a class="btn btn-primary" href="{{ route('admin.faq-categories.create') }}">Add Category</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Sort</th>
                        <th>FAQs</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqCategories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name_ar }}</td>
                            <td>{{ $category->sort_order }}</td>
                            <td>{{ $category->faqs_count }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.faq-categories.edit', $category) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.faq-categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="muted">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
