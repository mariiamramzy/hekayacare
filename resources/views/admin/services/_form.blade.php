@php
    $service = $service ?? null;
    $tabs = collect(old('tabs', $service->tabs ?? []))->values();
    $tabOne = $tabs->get(0, []);
    $tabTwo = $tabs->get(1, []);
    $tabThree = $tabs->get(2, []);
    $tabFour = $tabs->get(3, []);
    $toLines = fn ($value) => implode("\n", old($value, []));
@endphp

<div class="field">
    <label for="title_ar">عنوان الخدمة</label>
    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $service->title_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="page_title_ar">عنوان صفحة التفاصيل</label>
    <input id="page_title_ar" type="text" name="page_title_ar" value="{{ old('page_title_ar', $service->page_title_ar ?? '') }}">
</div>

<div class="field">
    <label for="slug_preview">الرابط المختصر</label>
    <input id="slug_preview" type="text" value="{{ $service->slug ?? '' }}" readonly>
</div>

<div class="field">
    <label for="short_description">وصف مختصر</label>
    <textarea id="short_description" name="short_description" rows="4">{{ old('short_description', $service->short_description ?? '') }}</textarea>
</div>

<div class="field">
    <label for="meta_description_ar">Meta Description</label>
    <textarea id="meta_description_ar" name="meta_description_ar" rows="3">{{ old('meta_description_ar', $service->meta_description_ar ?? '') }}</textarea>
</div>

<div class="grid-2">
    <div class="field">
        <label for="icon_class">Icon Class</label>
        <input id="icon_class" type="text" name="icon_class" value="{{ old('icon_class', $service->icon_class ?? '') }}" placeholder="icon-crm">
    </div>

    <div class="field">
        <label for="service_type">نوع الخدمة في الطلبات</label>
        <input id="service_type" type="text" name="service_type" value="{{ old('service_type', $service->service_type ?? '') }}" placeholder="rehabilitation">
    </div>
</div>

<div class="field">
    <label for="image_file">الصورة الرئيسية</label>
    <input id="image_file" type="file" name="image_file" accept="image/*">
    @if($service?->imageMedia?->path)
        <div class="muted inline-link-note">الحالية: <a href="{{ $service->image_url }}" target="_blank">عرض الصورة</a></div>
    @endif
</div>

<div class="field">
    <label>
        <input type="hidden" name="has_gallery_section" value="0">
        <input id="has_gallery_section" type="checkbox" name="has_gallery_section" value="1" {{ old('has_gallery_section', isset($service) ? $service->has_gallery_section : false) ? 'checked' : '' }}>
        الخدمة لها Gallery section
    </label>
</div>

<div class="field">
    <label for="highlights_intro">مقدمة تفاصيل الخدمة</label>
    <textarea id="highlights_intro" name="highlights_intro" rows="4">{{ old('highlights_intro', $service->highlights_intro ?? '') }}</textarea>
</div>

<div class="field">
    <label for="card_points_text">نقاط الكارت في صفحة الخدمات</label>
    <textarea id="card_points_text" name="card_points_text" rows="6">{{ old('card_points_text', implode("\n", $service->card_points ?? [])) }}</textarea>
    <div class="muted inline-link-note">كل نقطة في سطر منفصل.</div>
</div>

<div class="field">
    <label for="highlights_text">نقاط صفحة التفاصيل</label>
    <textarea id="highlights_text" name="highlights_text" rows="8">{{ old('highlights_text', implode("\n", $service->highlights ?? [])) }}</textarea>
    <div class="muted inline-link-note">كل نقطة في سطر منفصل.</div>
</div>

<hr>
<div id="service-gallery-fields">
    <h3 class="page-title" style="font-size: 18px;">صور معرض الخدمة</h3>

    <div class="field">
        <label for="gallery_image_one_file">الصورة الأولى</label>
        <input id="gallery_image_one_file" type="file" name="gallery_image_one_file" accept="image/*">
        @if($service?->galleryImageOneMedia?->path)
            <div class="muted inline-link-note">الحالية: <a href="{{ $service->gallery_images[0]['url'] }}" target="_blank">عرض الصورة</a></div>
        @endif
    </div>

    <div class="field">
        <label for="gallery_image_two_file">الصورة الثانية</label>
        <input id="gallery_image_two_file" type="file" name="gallery_image_two_file" accept="image/*">
        @if($service?->galleryImageTwoMedia?->path)
            <div class="muted inline-link-note">الحالية: <a href="{{ $service->gallery_images[1]['url'] }}" target="_blank">عرض الصورة</a></div>
        @endif
    </div>

    <div class="field">
        <label for="gallery_image_three_file">الصورة الثالثة</label>
        <input id="gallery_image_three_file" type="file" name="gallery_image_three_file" accept="image/*">
        @if($service?->galleryImageThreeMedia?->path)
            <div class="muted inline-link-note">الحالية: <a href="{{ $service->gallery_images[2]['url'] }}" target="_blank">عرض الصورة</a></div>
        @endif
    </div>
</div>

<hr>
<h3 class="page-title" style="font-size: 18px;">التبويبات</h3>

@foreach ([
    1 => $tabOne,
    2 => $tabTwo,
    3 => $tabThree,
    4 => $tabFour,
] as $index => $tab)
    <div class="card" style="margin-bottom: 18px; padding: 16px;">
        <h4 style="margin-bottom: 14px;">تبويب {{ $index }}</h4>
        <div class="grid-2">
            <div class="field">
                <label for="tab_{{ $index }}_id">ID</label>
                <input id="tab_{{ $index }}_id" type="text" name="tab_{{ ['one','two','three','four'][$index-1] }}_id" value="{{ old('tab_'.['one','two','three','four'][$index-1].'_id', $tab['id'] ?? '') }}">
            </div>
            <div class="field">
                <label for="tab_{{ $index }}_label">العنوان</label>
                <input id="tab_{{ $index }}_label" type="text" name="tab_{{ ['one','two','three','four'][$index-1] }}_label" value="{{ old('tab_'.['one','two','three','four'][$index-1].'_label', $tab['label'] ?? '') }}">
            </div>
        </div>
        <div class="field">
            <label for="tab_{{ $index }}_intro">المقدمة</label>
            <textarea id="tab_{{ $index }}_intro" name="tab_{{ ['one','two','three','four'][$index-1] }}_intro" rows="3">{{ old('tab_'.['one','two','three','four'][$index-1].'_intro', $tab['intro'] ?? '') }}</textarea>
        </div>
        <div class="field">
            <label for="tab_{{ $index }}_points_text">النقاط</label>
            <textarea id="tab_{{ $index }}_points_text" name="tab_{{ ['one','two','three','four'][$index-1] }}_points_text" rows="5">{{ old('tab_'.['one','two','three','four'][$index-1].'_points_text', implode("\n", $tab['points'] ?? [])) }}</textarea>
            <div class="muted inline-link-note">اتركها فارغة لو هذا التبويب لا يحتوي نقاط.</div>
        </div>
    </div>
@endforeach

<div class="grid-2">
    <div class="field">
        <label for="sort_order">الترتيب</label>
        <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
    </div>

    <div class="field">
        <label style="display:block; margin-bottom: 8px;">الحالة</label>
        <label>
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($service) ? $service->is_active : true) ? 'checked' : '' }}>
            نشط
        </label>
    </div>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.services.index') }}">إلغاء</a>
</div>

@push('scripts')
<script>
    (function () {
        const titleInput = document.getElementById('title_ar');
        const slugPreview = document.getElementById('slug_preview');
        const hasGalleryCheckbox = document.getElementById('has_gallery_section');
        const galleryFields = document.getElementById('service-gallery-fields');

        if (!titleInput || !slugPreview) {
            return;
        }

        function slugify(value) {
            const arabicMap = {
                'ا': 'a', 'أ': 'a', 'إ': 'i', 'آ': 'aa',
                'ب': 'b', 'ت': 't', 'ث': 'th', 'ج': 'j',
                'ح': 'h', 'خ': 'kh', 'د': 'd', 'ذ': 'dh',
                'ر': 'r', 'ز': 'z', 'س': 's', 'ش': 'sh',
                'ص': 's', 'ض': 'd', 'ط': 't', 'ظ': 'z',
                'ع': 'a', 'غ': 'gh', 'ف': 'f', 'ق': 'q',
                'ك': 'k', 'ل': 'l', 'م': 'm', 'ن': 'n',
                'ه': 'h', 'و': 'w', 'ؤ': 'w', 'ي': 'y',
                'ى': 'a', 'ئ': 'y', 'ة': 'h', 'ء': ''
            };

            const transliterated = (value || '').replace(/[\u0621-\u064A]/g, function (char) {
                return arabicMap[char] ?? char;
            });

            return transliterated
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '') || 'service';
        }

        function updatePreview() {
            slugPreview.value = slugify(titleInput.value);
        }

        function toggleGalleryFields() {
            if (!hasGalleryCheckbox || !galleryFields) {
                return;
            }

            galleryFields.style.display = hasGalleryCheckbox.checked ? 'block' : 'none';
        }

        titleInput.addEventListener('input', updatePreview);
        hasGalleryCheckbox?.addEventListener('change', toggleGalleryFields);
        updatePreview();
        toggleGalleryFields();
    })();
</script>
@endpush
