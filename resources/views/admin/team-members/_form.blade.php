@php
    $selectedDepartments = old('departments', isset($teamMember) ? $teamMember->departments->pluck('id')->all() : []);
@endphp

<div class="field">
    <label for="name_ar">الاسم</label>
    <input id="name_ar" type="text" name="name_ar" value="{{ old('name_ar', $teamMember->name_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="title_ar">المسمى</label>
    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $teamMember->title_ar ?? '') }}">
</div>

<div class="field">
    <label for="specialty_ar">Specialty (AR)</label>
    <input id="specialty_ar" type="text" name="specialty_ar" value="{{ old('specialty_ar', $teamMember->specialty_ar ?? '') }}">
</div>

<div class="field">
    <label for="bio_ar">Bio (AR)</label>
    <textarea id="bio_ar" name="bio_ar">{{ old('bio_ar', $teamMember->bio_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="photo_image">Photo</label>
    <input id="photo_image" type="file" name="photo_image" accept="image/*">
    @if(isset($teamMember) && $teamMember->photoMedia?->path)
        <div class="muted" style="margin-top:6px;">الحالية: <a href="{{ asset('storage/'.$teamMember->photoMedia->path) }}" target="_blank">عرض الصورة</a></div>
    @endif
</div>

<div class="field">
    <label for="phone">الهاتف</label>
    <input id="phone" type="text" name="phone" value="{{ old('phone', $teamMember->phone ?? '') }}">
</div>

<div class="field">
    <label for="email">البريد الإلكتروني</label>
    <input id="email" type="email" name="email" value="{{ old('email', $teamMember->email ?? '') }}">
</div>

<div class="field">
    <label for="sort_order">الترتيب</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $teamMember->sort_order ?? 0) }}">
</div>

<div class="field">
    <label>Departments</label>
    <div class="check-grid">
        @forelse($departments as $department)
            <label>
                <input type="checkbox" name="departments[]" value="{{ $department->id }}" {{ in_array($department->id, $selectedDepartments, true) ? 'checked' : '' }}>
                {{ $department->name_ar }}
            </label>
        @empty
            <span class="muted">لا توجد أقسام.</span>
        @endforelse
    </div>
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($teamMember) ? $teamMember->is_active : true) ? 'checked' : '' }}>
        نشط
    </label>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.team-members.index') }}">إلغاء</a>
</div>
