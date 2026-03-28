<div class="field">
    <label for="name_ar">Category Name (AR)</label>
    <input id="name_ar" type="text" name="name_ar" value="{{ old('name_ar', $faqCategory->name_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="sort_order">Sort Order</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $faqCategory->sort_order ?? 0) }}">
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.faq-categories.index') }}">Cancel</a>
</div>
