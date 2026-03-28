<div class="field">
    <label for="slug">Slug</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug', $blogTag->slug ?? '') }}" required>
</div>

<div class="field">
    <label for="name_ar">الاسم</label>
    <input id="name_ar" type="text" name="name_ar" value="{{ old('name_ar', $blogTag->name_ar ?? '') }}" required>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.blog-tags.index') }}">إلغاء</a>
</div>
