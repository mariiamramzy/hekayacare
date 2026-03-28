@php
    $selectedCategories = old('categories', isset($faq) ? $faq->categories->pluck('id')->all() : []);
@endphp

<div class="field">
    <label for="question_ar">Question (AR)</label>
    <input id="question_ar" type="text" name="question_ar" value="{{ old('question_ar', $faq->question_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="answer_ar">Answer (AR)</label>
    <textarea id="answer_ar" name="answer_ar" required>{{ old('answer_ar', $faq->answer_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="sort_order">الترتيب</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}">
</div>

<div class="field">
    <label>التصنيفات - اختياري</label>
    <div class="check-grid">
        @forelse ($categories as $category)
            <label>
                <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories, true) ? 'checked' : '' }}>
                {{ $category->name_ar }}
            </label>
        @empty
            <span class="muted">لا توجد تصنيفات.</span>
        @endforelse
    </div>
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($faq) ? $faq->is_active : true) ? 'checked' : '' }}>
        نشط
    </label>
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_featured" value="0">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', isset($faq) ? $faq->is_featured : false) ? 'checked' : '' }}>
        إظهار في الرئيسية
    </label>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.faqs.index') }}">إلغاء</a>
</div>
