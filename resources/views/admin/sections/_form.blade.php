<div class="field">
    <label for="key">Section Key</label>
    <input id="key" type="text" name="key" value="{{ old('key', $section->key ?? '') }}" placeholder="hero, why_choose_us..." required>
</div>

<div class="field">
    <label for="title_ar">Title (AR)</label>
    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $section->title_ar ?? '') }}">
</div>

<div class="field">
    <label for="subtitle_ar">Subtitle (AR)</label>
    <input id="subtitle_ar" type="text" name="subtitle_ar" value="{{ old('subtitle_ar', $section->subtitle_ar ?? '') }}">
</div>

<div class="field">
    <label for="body_ar">Body (AR)</label>
    <textarea id="body_ar" name="body_ar">{{ old('body_ar', $section->body_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="image">Image</label>
    <input id="image" type="file" name="image" accept="image/*">
    @if(isset($section) && $section->media?->path)
        <div class="muted" style="margin-top:6px;">Current: <a href="{{ asset('storage/'.$section->media->path) }}" target="_blank">View image</a></div>
    @endif
</div>

<div class="field">
    <label for="data_json">Data JSON</label>
    <textarea id="data_json" name="data_json" placeholder='{"cta_text":"اعرف المزيد","counters":[1,2,3]}'>{{ old('data_json', isset($section) && $section->data ? json_encode($section->data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) : '') }}</textarea>
</div>

<div class="field">
    <label for="sort_order">Sort Order</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order ?? 0) }}">
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($section) ? $section->is_active : true) ? 'checked' : '' }}>
        Is Active
    </label>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.index', $page) }}">Cancel</a>
</div>
