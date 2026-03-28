@extends('admin.layout')

@section('title', 'تصنيفات الأسئلة الشائعة')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">تصنيفات الأسئلة الشائعة</h2>
            <a class="btn btn-primary" href="{{ route('admin.faq-categories.create') }}">إضافة تصنيف</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>الترتيب</th>
                        <th>عدد الأسئلة</th>
                        <th>الإجراءات</th>
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
                                    <a class="btn btn-secondary" href="{{ route('admin.faq-categories.edit', $category) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.faq-categories.destroy', $category) }}" onsubmit="return confirm('هل تريد حذف هذا التصنيف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="muted">لا توجد تصنيفات.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
