<div class="field">
    <label for="title_ar">العنوان</label>
    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $portfolioCase->title_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="card_sub_title">العنوان الفرعي للكارت</label>
    <input id="card_sub_title" type="text" name="card_sub_title" value="{{ old('card_sub_title', $portfolioCase->card_sub_title ?? '') }}">
</div>

<div class="field">
    <label for="excerpt_ar">وصف مختصر</label>
    <textarea id="excerpt_ar" name="excerpt_ar" rows="3">{{ old('excerpt_ar', $portfolioCase->excerpt_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="cover_image_file">صورة الغلاف</label>
    <input id="cover_image_file" type="file" name="cover_image_file" accept="image/*" {{ isset($portfolioCase) ? '' : 'required' }}>
    @if(isset($portfolioCase) && $portfolioCase->coverMedia?->path)
        <div class="muted inline-link-note">
            الحالية: <a href="{{ $portfolioCase->cover_image_url }}" target="_blank">عرض الصورة</a>
        </div>
    @endif
</div>

<div class="field">
    <label for="main_image_file">الصورة الرئيسية في التفاصيل</label>
    <input id="main_image_file" type="file" name="main_image_file" accept="image/*">
    @if(isset($portfolioCase) && $portfolioCase->mainMedia?->path)
        <div class="muted inline-link-note">
            الحالية: <a href="{{ $portfolioCase->main_image_url }}" target="_blank">عرض الصورة</a>
        </div>
    @endif
</div>

<div class="field">
    <label for="intro_heading">عنوان المقدمة</label>
    <input id="intro_heading" type="text" name="intro_heading" value="{{ old('intro_heading', $portfolioCase->intro_heading ?? '') }}">
</div>

<div class="field">
    <label for="intro_text">نص المقدمة</label>
    <textarea id="intro_text" name="intro_text" rows="6">{{ old('intro_text', $portfolioCase->intro_text ?? '') }}</textarea>
</div>

<div class="field">
    <label for="secondary_image_file">الصورة الثانوية في التفاصيل</label>
    <input id="secondary_image_file" type="file" name="secondary_image_file" accept="image/*">
    @if(isset($portfolioCase) && $portfolioCase->secondaryMedia?->path)
        <div class="muted inline-link-note">
            الحالية: <a href="{{ $portfolioCase->secondary_image_url }}" target="_blank">عرض الصورة</a>
        </div>
    @endif
</div>

<div class="field">
    <label for="points_heading">عنوان النقاط</label>
    <input id="points_heading" type="text" name="points_heading" value="{{ old('points_heading', $portfolioCase->points_heading ?? '') }}">
</div>

<div class="field">
    <label for="points_text">تمهيد النقاط</label>
    <textarea id="points_text" name="points_text" rows="4">{{ old('points_text', $portfolioCase->points_text ?? '') }}</textarea>
</div>

<div class="field">
    <label for="point_one_ar">النقطة الأولى</label>
    <textarea id="point_one_ar" name="point_one_ar" rows="2">{{ old('point_one_ar', $portfolioCase->point_one_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="point_two_ar">النقطة الثانية</label>
    <textarea id="point_two_ar" name="point_two_ar" rows="2">{{ old('point_two_ar', $portfolioCase->point_two_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="point_three_ar">النقطة الثالثة</label>
    <textarea id="point_three_ar" name="point_three_ar" rows="2">{{ old('point_three_ar', $portfolioCase->point_three_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="closing_text">النص الختامي</label>
    <textarea id="closing_text" name="closing_text" rows="5">{{ old('closing_text', $portfolioCase->closing_text ?? '') }}</textarea>
</div>

<div class="field">
    <label for="case_label">اسم الحالة</label>
    <input id="case_label" type="text" name="case_label" value="{{ old('case_label', $portfolioCase->case_label ?? '') }}">
</div>

<div class="field">
    <label for="started_at">تاريخ البدء</label>
    <input id="started_at" type="date" name="started_at" value="{{ old('started_at', isset($portfolioCase) && $portfolioCase->started_at ? $portfolioCase->started_at->format('Y-m-d') : '') }}">
</div>

<div class="field">
    <label for="location_ar">المكان</label>
    <input id="location_ar" type="text" name="location_ar" value="{{ old('location_ar', $portfolioCase->location_ar ?? '') }}">
</div>

<div class="field">
    <label for="client_name_ar">اسم العميل</label>
    <input id="client_name_ar" type="text" name="client_name_ar" value="{{ old('client_name_ar', $portfolioCase->client_name_ar ?? '') }}">
</div>

<div class="field">
    <label for="duration_ar">المدة</label>
    <input id="duration_ar" type="text" name="duration_ar" value="{{ old('duration_ar', $portfolioCase->duration_ar ?? '') }}">
</div>

<div class="field">
    <label for="sidebar_image_file">صورة السايدبار</label>
    <input id="sidebar_image_file" type="file" name="sidebar_image_file" accept="image/*">
    @if(isset($portfolioCase) && $portfolioCase->sidebarMedia?->path)
        <div class="muted inline-link-note">
            الحالية: <a href="{{ $portfolioCase->sidebar_image_url }}" target="_blank">عرض الصورة</a>
        </div>
    @endif
</div>

<div class="field">
    <label for="sort_order">الترتيب</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $portfolioCase->sort_order ?? 0) }}">
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($portfolioCase) ? $portfolioCase->is_active : true) ? 'checked' : '' }}>
        نشط
    </label>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.portfolio-cases.index') }}">إلغاء</a>
</div>
