<div class="field">
    <label for="name">الاسم</label>
    <input id="name" name="name" type="text" value="{{ old('name', $patient->name ?? '') }}" required>
</div>

<div class="grid-2">
    <div class="field">
        <label for="file_number">رقم الملف</label>
        <input id="file_number" name="file_number" type="text" value="{{ old('file_number', $patient->file_number ?? '') }}">
    </div>
    <div class="field">
        <label for="status">الحالة</label>
        <select id="status" name="status" required>
            @php $statusValue = old('status', $patient->status ?? 'active'); @endphp
            <option value="active" @selected($statusValue === 'active')>نشط</option>
            <option value="discharged" @selected($statusValue === 'discharged')>خروج</option>
            <option value="follow_up" @selected($statusValue === 'follow_up')>متابعة</option>
            <option value="archived" @selected($statusValue === 'archived')>مؤرشف</option>
        </select>
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="case_manager_name">المسؤول عن الحالة</label>
        <input id="case_manager_name" name="case_manager_name" type="text" value="{{ old('case_manager_name', $patient->case_manager_name ?? '') }}">
    </div>
    <div class="field">
        <label for="case_manager_phone">رقم هاتفه</label>
        <input id="case_manager_phone" name="case_manager_phone" type="text" value="{{ old('case_manager_phone', $patient->case_manager_phone ?? '') }}">
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="center_name">اسم المركز</label>
        <input id="center_name" name="center_name" type="text" value="{{ old('center_name', $patient->center_name ?? '') }}">
    </div>
    <div class="field">
        <label for="supervisor_name">المشرف المسؤول</label>
        <input id="supervisor_name" name="supervisor_name" type="text" value="{{ old('supervisor_name', $patient->supervisor_name ?? '') }}">
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="addiction_type">نوع الإدمان</label>
        <input id="addiction_type" name="addiction_type" type="text" value="{{ old('addiction_type', $patient->addiction_type ?? '') }}">
    </div>
    <div class="field">
        <label for="psychiatric_diagnosis">التشخيص النفسي</label>
        <input id="psychiatric_diagnosis" name="psychiatric_diagnosis" type="text" value="{{ old('psychiatric_diagnosis', $patient->psychiatric_diagnosis ?? '') }}">
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="admission_date">تاريخ الدخول</label>
        <input id="admission_date" name="admission_date" type="date" value="{{ old('admission_date', optional($patient->admission_date ?? null)->format('Y-m-d')) }}">
    </div>
    <div class="field">
        <label for="discharge_date">تاريخ الخروج</label>
        <input id="discharge_date" name="discharge_date" type="date" value="{{ old('discharge_date', optional($patient->discharge_date ?? null)->format('Y-m-d')) }}">
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="phone">هاتف المريض</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone', $patient->phone ?? '') }}">
    </div>
    <div class="field">
        <label for="age">السن</label>
        <input id="age" name="age" type="number" min="1" max="120" value="{{ old('age', $patient->age ?? '') }}">
    </div>
</div>

<div class="grid-2">
    <div class="field">
        <label for="gender">النوع</label>
        <select id="gender" name="gender">
            @php $genderValue = old('gender', $patient->gender ?? ''); @endphp
            <option value="">-</option>
            <option value="male" @selected($genderValue === 'male')>ذكر</option>
            <option value="female" @selected($genderValue === 'female')>أنثى</option>
        </select>
    </div>
    <div class="field">
        <label for="emergency_contact_name">اسم تواصل الطوارئ</label>
        <input id="emergency_contact_name" name="emergency_contact_name" type="text" value="{{ old('emergency_contact_name', $patient->emergency_contact_name ?? '') }}">
    </div>
</div>

<div class="field">
    <label for="emergency_contact_phone">رقم تواصل الطوارئ</label>
    <input id="emergency_contact_phone" name="emergency_contact_phone" type="text" value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone ?? '') }}">
</div>

<div class="field">
    <label for="notes">ملاحظات</label>
    <textarea id="notes" name="notes">{{ old('notes', $patient->notes ?? '') }}</textarea>
</div>
