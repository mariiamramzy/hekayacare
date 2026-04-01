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
                <label for="address">العنوان</label>
                <input id="address" name="address" type="text" value="{{ old('address', $contactLead->address) }}">
            </div>

            <div class="field">
                <label for="gender">النوع</label>
                <select id="gender" name="gender">
                    <option value="">اختر النوع</option>
                    <option value="1" @selected(old('gender', $contactLead->gender) === '1')>ذكر</option>
                    <option value="2" @selected(old('gender', $contactLead->gender) === '2')>أنثى</option>
                </select>
            </div>

            <div class="field">
                <label for="is_patient">هل أنت المريض؟</label>
                <select id="is_patient" name="is_patient">
                    <option value="">اختر</option>
                    <option value="1" @selected(old('is_patient', $contactLead->is_patient) === '1')>نعم</option>
                    <option value="2" @selected(old('is_patient', $contactLead->is_patient) === '2')>شخص ينوب عنه</option>
                </select>
            </div>

            <div class="field">
                <label for="client_type">فرد / مؤسسة</label>
                <select id="client_type" name="client_type">
                    <option value="">اختر</option>
                    <option value="individual" @selected(old('client_type', $contactLead->client_type) === 'individual')>فرد</option>
                    <option value="organization" @selected(old('client_type', $contactLead->client_type) === 'organization')>مؤسسة</option>
                </select>
            </div>

            <div class="field">
                <label for="service_type">نوع الخدمة</label>
                <select id="service_type" name="service_type">
                    <option value="">اختر الخدمة</option>
                    <option value="detox" @selected(old('service_type', $contactLead->service_type) === 'detox')>سحب السموم (Detox)</option>
                    <option value="behavioral_addiction" @selected(old('service_type', $contactLead->service_type) === 'behavioral_addiction')>علاج الإدمان السلوكي</option>
                    <option value="rehabilitation" @selected(old('service_type', $contactLead->service_type) === 'rehabilitation')>التأهيل النفسي والإقامة الكاملة</option>
                    <option value="dual_diagnosis" @selected(old('service_type', $contactLead->service_type) === 'dual_diagnosis')>علاج التشخيص المزدوج (Dual Diagnosis)</option>
                    <option value="consultations" @selected(old('service_type', $contactLead->service_type) === 'consultations')>الاستشارات النفسية والأسرية</option>
                    <option value="relapse_prevention" @selected(old('service_type', $contactLead->service_type) === 'relapse_prevention')>برامج منع الانتكاسة</option>
                    <option value="workshops" @selected(old('service_type', $contactLead->service_type) === 'workshops')>برامج التدريب وورش العمل</option>
                </select>
            </div>

            <div class="field">
                <label for="message">الملاحظات</label>
                <textarea id="message" name="message">{{ old('message', $contactLead->message) }}</textarea>
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                <a class="btn btn-secondary" href="{{ route('admin.contact-leads.index') }}">إلغاء</a>
            </div>
        </form>
    </section>
@endsection

