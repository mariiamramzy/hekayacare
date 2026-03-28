<div class="field">
    <label for="name">الاسم</label>
    <input id="name" name="name" type="text" value="{{ old('name', $appointmentRequest->name ?? '') }}" required>
</div>

<div class="field">
    <label for="phone">الهاتف</label>
    <input id="phone" name="phone" type="text" value="{{ old('phone', $appointmentRequest->phone ?? '') }}" required>
</div>

<div class="field">
    <label for="governorate">المحافظة</label>
    <input id="governorate" name="governorate" type="text" value="{{ old('governorate', $appointmentRequest->governorate ?? '') }}" required>
</div>

<div class="field">
    <label for="gender">النوع</label>
    <select id="gender" name="gender" required>
        <option value="male" @selected(old('gender', $appointmentRequest->gender ?? '') === 'male')>ذكر</option>
        <option value="female" @selected(old('gender', $appointmentRequest->gender ?? '') === 'female')>أنثى</option>
    </select>
</div>

<div class="field">
    <label for="age">العمر</label>
    <input id="age" name="age" type="number" min="1" max="120" value="{{ old('age', $appointmentRequest->age ?? '') }}" required>
</div>

<div class="field">
    <label for="patient_relation">صلة القرابة</label>
    <select id="patient_relation" name="patient_relation" required>
        <option value="self" @selected(old('patient_relation', $appointmentRequest->patient_relation ?? '') === 'self')>المريض نفسه</option>
        <option value="proxy" @selected(old('patient_relation', $appointmentRequest->patient_relation ?? '') === 'proxy')>شخص ينوب عنه</option>
    </select>
</div>

<div class="field">
    <label for="problem_type">نوع المشكلة</label>
    <input id="problem_type" name="problem_type" type="text" value="{{ old('problem_type', $appointmentRequest->problem_type ?? '') }}" required>
</div>

<div class="field">
    <label for="problem_specialty">تخصص المشكلة</label>
    <input id="problem_specialty" name="problem_specialty" type="text" value="{{ old('problem_specialty', $appointmentRequest->problem_specialty ?? '') }}" required>
</div>

<div class="field">
    <label for="notes">ملاحظات</label>
    <textarea id="notes" name="notes">{{ old('notes', $appointmentRequest->notes ?? '') }}</textarea>
</div>

<div class="field">
    <label for="status">الحالة</label>
    <select id="status" name="status" required>
        @foreach (['new','in_progress','done','spam'] as $s)
            <option value="{{ $s }}" @selected(old('status', $appointmentRequest->status ?? 'new') === $s)>{{ ['new' => 'جديد', 'in_progress' => 'قيد المتابعة', 'done' => 'مكتمل', 'spam' => 'مزعج'][$s] ?? $s }}</option>
        @endforeach
    </select>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.appointment-requests.index') }}">إلغاء</a>
</div>
