<div class="field">
    <label for="slug">Slug</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" required>
</div>

<div class="field">
    <label for="title_ar">Title (AR)</label>
    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $page->title_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="sort_order">Sort Order</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $page->sort_order ?? 0) }}">
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($page) ? $page->is_active : true) ? 'checked' : '' }}>
        Is Active
    </label>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.pages.index') }}">Cancel</a>
</div>
