<div class="field">
    <label for="title_ar">العنوان</label>
    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $galleryImage->title_ar ?? '') }}">
</div>

<div class="field">
    <label for="alt_text">النص البديل</label>
    <input id="alt_text" type="text" name="alt_text" value="{{ old('alt_text', $galleryImage->imageMedia?->alt_text ?? '') }}">
</div>

<div class="field">
    <label for="image_file">الصورة</label>
    <input id="image_file" type="file" name="image_file" accept="image/*" {{ isset($galleryImage) ? '' : 'required' }}>
    @if(isset($galleryImage) && $galleryImage->imageMedia?->path)
        <div class="muted inline-link-note">
            الحالية: <a href="{{ asset('storage/'.$galleryImage->imageMedia->path) }}" target="_blank">عرض الصورة</a>
        </div>
    @endif
</div>

<div class="field">
    <label for="sort_order">الترتيب</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $galleryImage->sort_order ?? 0) }}">
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($galleryImage) ? $galleryImage->is_active : true) ? 'checked' : '' }}>
        نشط
    </label>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.gallery-images.index') }}">إلغاء</a>
</div>
