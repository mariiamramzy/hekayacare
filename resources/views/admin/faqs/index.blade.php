@extends('admin.layout')

@section('title', 'الأسئلة الشائعة')

@section('content')
    <section class="card card-body-soft">
        <div class="page-toolbar">
            <h2 class="page-title page-toolbar__title">الأسئلة الشائعة</h2>
            <div class="page-toolbar__actions">
                <a class="btn btn-primary" href="{{ route('admin.faqs.create') }}">إضافة سؤال</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>السؤال</th>
                        <th>التصنيفات</th>
                        <th>الحالة</th>
                        <th>مميز</th>
                        <th>الترتيب</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->id }}</td>
                            <td>{{ $faq->question_ar }}</td>
                            <td>
                                @forelse($faq->categories as $category)
                                    <span class="badge">{{ $category->name_ar }}</span>
                                @empty
                                    <span class="muted">-</span>
                                @endforelse
                            </td>
                            <td>
                                <span class="badge {{ $faq->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $faq->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $faq->is_featured ? 'status-active' : 'status-inactive' }}">
                                    {{ $faq->is_featured ? 'مميز' : 'لا' }}
                                </span>
                            </td>
                            <td>{{ $faq->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.faqs.edit', $faq) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('هل تريد حذف هذا السؤال؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="muted empty-cell">لا توجد أسئلة شائعة.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
