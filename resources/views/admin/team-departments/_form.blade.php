<div class="field">
    <label for="name_ar">اسم القسم</label>
    <input id="name_ar" type="text" name="name_ar" value="{{ old('name_ar', $teamDepartment->name_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="sort_order">الترتيب</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $teamDepartment->sort_order ?? 0) }}">
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.team-departments.index') }}">إلغاء</a>
</div>
