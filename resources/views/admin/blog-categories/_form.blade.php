<div class="field">
    <label for="slug">Slug</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug', $blogCategory->slug ?? '') }}" required>
</div>

<div class="field">
    <label for="name_ar">الاسم</label>
    <input id="name_ar" type="text" name="name_ar" value="{{ old('name_ar', $blogCategory->name_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="sort_order">الترتيب</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $blogCategory->sort_order ?? 0) }}">
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($blogCategory) ? $blogCategory->is_active : true) ? 'checked' : '' }}>
        نشط
    </label>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.blog-categories.index') }}">إلغاء</a>
</div>
