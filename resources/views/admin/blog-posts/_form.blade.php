@php
    $seoMeta = $blogPost->seoMeta ?? null;
    $publishedValue = old('published_at');
    if ($publishedValue === null && isset($blogPost) && $blogPost->published_at) {
        $publishedValue = $blogPost->published_at->format('Y-m-d\TH:i');
    }
@endphp

<div class="field">
    <label for="title_ar">العنوان</label>
    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $blogPost->title_ar ?? '') }}" required>
</div>

<div class="field">
    <label for="slug">الرابط المختصر</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug', $blogPost->slug ?? '') }}" readonly>
</div>

<div class="field">
    <label for="excerpt_ar">الوصف المختصر</label>
    <textarea id="excerpt_ar" name="excerpt_ar">{{ old('excerpt_ar', $blogPost->excerpt_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="content_ar">المحتوى</label>
    <textarea id="content_ar" name="content_ar" required>{{ old('content_ar', $blogPost->content_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="blog_category_id">التصنيف</label>
    <select id="blog_category_id" name="blog_category_id">
        <option value="">بدون تصنيف</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected((string) old('blog_category_id', $blogPost->blog_category_id ?? null) === (string) $category->id)>
                {{ $category->name_ar }} ({{ $category->slug }})
            </option>
        @endforeach
    </select>
</div>

<div class="field">
    <label for="cover_image">صورة الغلاف</label>
    <input id="cover_image" type="file" name="cover_image" accept="image/*">
    @if(isset($blogPost) && $blogPost->coverMedia?->path)
        <div class="muted" style="margin-top:6px;">الحالية: <a href="{{ asset('storage/'.$blogPost->coverMedia->path) }}" target="_blank">عرض الصورة</a></div>
    @endif
</div>

<div class="field">
    <label for="status">الحالة</label>
    <select id="status" name="status" required>
        @foreach(['draft', 'published', 'scheduled'] as $status)
            <option value="{{ $status }}" @selected(old('status', $blogPost->status ?? 'draft') === $status)>{{ ['draft' => 'مسودة', 'published' => 'منشور', 'scheduled' => 'مجدول'][$status] ?? $status }}</option>
        @endforeach
    </select>
</div>

<div class="field">
    <label for="published_at">تاريخ النشر</label>
    <input id="published_at" type="datetime-local" name="published_at" value="{{ $publishedValue }}">
</div>

<div class="field">
    <label>الوسوم</label>
    @if(isset($blogPost) && $blogPost->tags->isNotEmpty())
        <div class="actions">
            @foreach($blogPost->tags as $tag)
                <span class="badge">{{ $tag->name_ar }}</span>
            @endforeach
        </div>
        <div class="muted inline-link-note">يتم توليد الوسوم تلقائيًا من محتوى المقال عند الحفظ.</div>
    @else
        <div class="muted">سيتم توليد الوسوم تلقائيًا من المحتوى المكتوب بعد الحفظ.</div>
    @endif
</div>

@if(isset($blogPost))
    <div class="grid-2">
        <div class="field">
            <label for="reading_time">مدة القراءة بالدقائق</label>
            <input id="reading_time" type="number" name="reading_time" value="{{ old('reading_time', $blogPost->reading_time ?? '') }}">
        </div>

        <div class="field">
            <label for="views">المشاهدات</label>
            <input id="views" type="number" name="views" value="{{ old('views', $blogPost->views ?? 0) }}">
        </div>
    </div>
@endif

<hr>
<h3 class="page-title" style="font-size: 18px;">بيانات SEO</h3>

<div class="field">
    <label for="meta_title_ar">عنوان الميتا</label>
    <input id="meta_title_ar" type="text" name="meta_title_ar" value="{{ old('meta_title_ar', $seoMeta?->meta_title_ar) }}">
</div>

<div class="field">
    <label for="meta_description_ar">وصف الميتا</label>
    <textarea id="meta_description_ar" name="meta_description_ar">{{ old('meta_description_ar', $seoMeta?->meta_description_ar) }}</textarea>
</div>

<div class="field">
    <label for="meta_keywords_ar">الكلمات المفتاحية</label>
    <input id="meta_keywords_ar" type="text" name="meta_keywords_ar" value="{{ old('meta_keywords_ar', $seoMeta?->meta_keywords_ar) }}" placeholder="كلمة 1, كلمة 2">
</div>

<div class="field">
    <label for="canonical_url">الرابط الأساسي</label>
    <input id="canonical_url" type="url" name="canonical_url" value="{{ old('canonical_url', $seoMeta?->canonical_url) }}">
</div>

<div class="field">
    <label for="robots">Robots</label>
    <input id="robots" type="text" name="robots" value="{{ old('robots', $seoMeta?->robots) }}" placeholder="index,follow">
</div>

<div class="field">
    <label for="og_title_ar">عنوان Open Graph</label>
    <input id="og_title_ar" type="text" name="og_title_ar" value="{{ old('og_title_ar', $seoMeta?->og_title_ar) }}">
</div>

<div class="field">
    <label for="og_description_ar">وصف Open Graph</label>
    <textarea id="og_description_ar" name="og_description_ar">{{ old('og_description_ar', $seoMeta?->og_description_ar) }}</textarea>
</div>

<div class="field">
    <label for="og_type">نوع Open Graph</label>
    <input id="og_type" type="text" name="og_type" value="{{ old('og_type', $seoMeta?->og_type) }}" placeholder="website / article">
</div>

<div class="field">
    <label for="og_url">رابط Open Graph</label>
    <input id="og_url" type="url" name="og_url" value="{{ old('og_url', $seoMeta?->og_url) }}">
</div>

<div class="field">
    <label for="og_site_name">اسم الموقع في Open Graph</label>
    <input id="og_site_name" type="text" name="og_site_name" value="{{ old('og_site_name', $seoMeta?->og_site_name) }}">
</div>

<div class="field">
    <label for="og_image">صورة Open Graph</label>
    <input id="og_image" type="file" name="og_image" accept="image/*">
    @if($seoMeta?->ogImageMedia?->path)
        <div class="muted" style="margin-top:6px;">الحالية: <a href="{{ asset('storage/'.$seoMeta->ogImageMedia->path) }}" target="_blank">عرض الصورة</a></div>
    @endif
</div>

<div class="field">
    <label for="twitter_card">Twitter Card</label>
    <input id="twitter_card" type="text" name="twitter_card" value="{{ old('twitter_card', $seoMeta?->twitter_card) }}" placeholder="summary_large_image">
</div>

<div class="field">
    <label for="twitter_title_ar">عنوان Twitter</label>
    <input id="twitter_title_ar" type="text" name="twitter_title_ar" value="{{ old('twitter_title_ar', $seoMeta?->twitter_title_ar) }}">
</div>

<div class="field">
    <label for="twitter_description_ar">وصف Twitter</label>
    <textarea id="twitter_description_ar" name="twitter_description_ar">{{ old('twitter_description_ar', $seoMeta?->twitter_description_ar) }}</textarea>
</div>

<div class="field">
    <label for="twitter_image">صورة Twitter</label>
    <input id="twitter_image" type="file" name="twitter_image" accept="image/*">
    @if($seoMeta?->twitterImageMedia?->path)
        <div class="muted" style="margin-top:6px;">الحالية: <a href="{{ asset('storage/'.$seoMeta->twitterImageMedia->path) }}" target="_blank">عرض الصورة</a></div>
    @endif
</div>

<div class="field">
    <label for="schema_json_text">Schema JSON-LD</label>
    <textarea id="schema_json_text" name="schema_json_text" readonly>{{ old('schema_json_text', $seoMeta && $seoMeta->schema_json ? json_encode($seoMeta->schema_json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : '') }}</textarea>
    <div class="muted inline-link-note">يتم توليد Schema JSON-LD تلقائيًا من بيانات المقال.</div>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.blog-posts.index') }}">إلغاء</a>
</div>

@push('scripts')
<script>
    (function () {
        const titleInput = document.getElementById('title_ar');
        const slugInput = document.getElementById('slug');
        const excerptInput = document.getElementById('excerpt_ar');
        const contentInput = document.getElementById('content_ar');
        const categoryInput = document.getElementById('blog_category_id');
        const metaTitleInput = document.getElementById('meta_title_ar');
        const metaDescriptionInput = document.getElementById('meta_description_ar');
        const metaKeywordsInput = document.getElementById('meta_keywords_ar');
        const canonicalInput = document.getElementById('canonical_url');
        const robotsInput = document.getElementById('robots');
        const ogTitleInput = document.getElementById('og_title_ar');
        const ogDescriptionInput = document.getElementById('og_description_ar');
        const ogTypeInput = document.getElementById('og_type');
        const ogUrlInput = document.getElementById('og_url');
        const ogSiteNameInput = document.getElementById('og_site_name');
        const twitterCardInput = document.getElementById('twitter_card');
        const twitterTitleInput = document.getElementById('twitter_title_ar');
        const twitterDescriptionInput = document.getElementById('twitter_description_ar');
        const schemaInput = document.getElementById('schema_json_text');
        const schemaContextKey = '@' + 'context';
        const schemaTypeKey = '@' + 'type';

        if (!titleInput || !slugInput) {
            return;
        }

        const appUrl = @json(rtrim(config('app.url'), '/'));

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

            const transliterated = (value || '').toString().replace(/[\u0621-\u064A]/g, function (char) {
                return arabicMap[char] ?? char;
            });

            const normalized = transliterated
                .toString()
                .normalize('NFKD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');

            return normalized || 'blog-post';
        }

        function stripHtml(value) {
            const temp = document.createElement('div');
            temp.innerHTML = value || '';
            return (temp.textContent || temp.innerText || '').replace(/\s+/g, ' ').trim();
        }

        function descriptionValue() {
            const excerpt = (excerptInput?.value || '').trim();
            if (excerpt) {
                return excerpt.slice(0, 160);
            }

            return stripHtml(contentInput?.value || '').slice(0, 160);
        }

        function currentSlug() {
            return slugify(titleInput.value);
        }

        function categoryName() {
            if (!categoryInput) {
                return '';
            }

            const selected = categoryInput.options[categoryInput.selectedIndex];
            return selected && selected.value ? selected.text.split(' (')[0].trim() : '';
        }

        function generateKeywords() {
            return [titleInput.value.trim(), categoryName()]
                .filter(Boolean)
                .filter((value, index, array) => array.indexOf(value) === index)
                .join(', ');
        }

        function canonicalUrl() {
            return appUrl + '/blogs/' + currentSlug();
        }

        function generateSchema() {
            return JSON.stringify({
                [schemaContextKey]: 'https://schema.org',
                [schemaTypeKey]: 'Article',
                headline: titleInput.value.trim(),
                description: descriptionValue(),
                url: canonicalUrl()
            }, null, 2);
        }

        function fillGeneratedSeo() {
            slugInput.value = currentSlug();

            if (metaTitleInput) metaTitleInput.value = titleInput.value.trim();
            if (metaDescriptionInput) metaDescriptionInput.value = descriptionValue();
            if (metaKeywordsInput) metaKeywordsInput.value = generateKeywords();
            if (canonicalInput) canonicalInput.value = canonicalUrl();
            if (robotsInput) robotsInput.value = 'index,follow';
            if (ogTitleInput) ogTitleInput.value = titleInput.value.trim();
            if (ogDescriptionInput) ogDescriptionInput.value = descriptionValue();
            if (ogTypeInput) ogTypeInput.value = 'article';
            if (ogUrlInput) ogUrlInput.value = canonicalUrl();
            if (ogSiteNameInput) ogSiteNameInput.value = 'Hekaya';
            if (twitterCardInput) twitterCardInput.value = 'summary_large_image';
            if (twitterTitleInput) twitterTitleInput.value = titleInput.value.trim();
            if (twitterDescriptionInput) twitterDescriptionInput.value = descriptionValue();
            if (schemaInput) schemaInput.value = generateSchema();
        }

        [titleInput, excerptInput, contentInput, categoryInput].forEach(function (element) {
            if (!element) {
                return;
            }

            element.addEventListener('input', fillGeneratedSeo);
            element.addEventListener('change', fillGeneratedSeo);
        });

        fillGeneratedSeo();
    })();
</script>
@endpush
