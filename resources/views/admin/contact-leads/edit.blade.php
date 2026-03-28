@extends('admin.layout')

@section('title', 'تعديل طلب التواصل')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل طلب التواصل #{{ $contactLead->id }}</h2>

        <form method="POST" action="{{ route('admin.contact-leads.update', $contactLead) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="name">الاسم</label>
                <input id="name" name="name" type="text" value="{{ old('name', $contactLead->name) }}" required>
            </div>

            <div class="field">
                <label for="mobile">رقم الهاتف</label>
                <input id="mobile" name="mobile" type="text" value="{{ old('mobile', $contactLead->mobile) }}" required>
            </div>

            <div class="field">
                <label for="message">الرسالة</label>
                <textarea id="message" name="message" required>{{ old('message', $contactLead->message) }}</textarea>
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                <a class="btn btn-secondary" href="{{ route('admin.contact-leads.index') }}">إلغاء</a>
            </div>
        </form>
    </section>
@endsection
