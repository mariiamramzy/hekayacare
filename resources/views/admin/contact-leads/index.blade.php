@extends('admin.layout')

@section('title', 'طلبات التواصل')

@section('content')
    <section class="card">
        <h2 class="page-title">طلبات التواصل</h2>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>الرسالة</th>
                        <th>تاريخ الإنشاء</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contactLeads as $lead)
                        <tr>
                            <td>{{ $lead->id }}</td>
                            <td>{{ $lead->name }}</td>
                            <td>{{ $lead->mobile }}</td>
                            <td style="max-width:320px; white-space: normal;">{{ $lead->message }}</td>
                            <td>{{ $lead->created_at?->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.contact-leads.edit', $lead) }}">تعديل</a>
                                    <form method="POST" action="{{ route('admin.contact-leads.destroy', $lead) }}" onsubmit="return confirm('هل تريد حذف هذا الطلب؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="muted">لا توجد طلبات تواصل.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
