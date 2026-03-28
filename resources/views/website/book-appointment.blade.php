@extends('website.layout.layout')

@section('title', 'احجز موعد | Hekaya')
@section('meta_description', 'احجز موعدك مع مركز حكاية بسهولة واترك بياناتك ليتم التواصل معك وبدء رحلة الدعم والعلاج المناسبة.')

@section('content')
    <section class="card">
        <h1 class="title">احجز موعد</h1>
        <p class="muted">املأ البيانات التالية وسيتم التواصل معك.</p>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('website.book-appointment.store') }}">
            @csrf

            <div class="grid-2">
                <div class="field">
                    <label for="name">الاسم</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                </div>

                <div class="field">
                    <label for="phone">التليفون</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required>
                </div>
            </div>

            <div class="grid-2">
                <div class="field">
                    <label for="governorate">المحافظة</label>
                    <input id="governorate" name="governorate" type="text" value="{{ old('governorate') }}" required>
                </div>

                <div class="field">
                    <label for="gender">النوع</label>
                    <select id="gender" name="gender" required>
                        <option value="">اختر</option>
                        <option value="male" @selected(old('gender') === 'male')>ذكر</option>
                        <option value="female" @selected(old('gender') === 'female')>انثي</option>
                    </select>
                </div>
            </div>

            <div class="grid-2">
                <div class="field">
                    <label for="age">السن</label>
                    <input id="age" name="age" type="number" min="1" max="120" value="{{ old('age') }}" required>
                </div>

                <div class="field">
                    <label for="patient_relation">هل انت مريض ام نايب عن المريض</label>
                    <select id="patient_relation" name="patient_relation" required>
                        <option value="">اختر</option>
                        <option value="self" @selected(old('patient_relation') === 'self')>مريض</option>
                        <option value="proxy" @selected(old('patient_relation') === 'proxy')>نايب عن المريض</option>
                    </select>
                </div>
            </div>

            <div class="grid-2">
                <div class="field">
                    <label for="problem_type">نوع المشكلة</label>
                    <input id="problem_type" name="problem_type" type="text" value="{{ old('problem_type') }}" required>
                </div>

                <div class="field">
                    <label for="problem_specialty">تخصص المشكلة</label>
                    <input id="problem_specialty" name="problem_specialty" type="text" value="{{ old('problem_specialty') }}" required>
                </div>
            </div>

            <div class="field">
                <label for="notes">ملاحظات</label>
                <textarea id="notes" name="notes">{{ old('notes') }}</textarea>
            </div>

            <button class="btn" type="submit">إرسال</button>
        </form>
    </section>
@endsection
