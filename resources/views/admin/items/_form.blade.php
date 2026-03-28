@php
    $linkTypes = ['none', 'internal', 'external', 'service', 'post'];
@endphp

<div class="field">
    <label for="title_ar">Title (AR)</label>
    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar ?? '') }}">
</div>

<div class="field">
    <label for="body_ar">Body (AR)</label>
    <textarea id="body_ar" name="body_ar">{{ old('body_ar', $item->body_ar ?? '') }}</textarea>
</div>

<div class="field">
    <label for="icon">Icon</label>
    <input id="icon" type="text" name="icon" value="{{ old('icon', $item->icon ?? '') }}" placeholder="fa-solid fa-star">
</div>

<div class="field">
    <label for="image">Image</label>
    <input id="image" type="file" name="image" accept="image/*">
    @if(isset($item) && $item->media?->path)
        <div class="muted" style="margin-top:6px;">Current: <a href="{{ asset('storage/'.$item->media->path) }}" target="_blank">View image</a></div>
    @endif
</div>

<div class="field">
    <label for="link_type">Link Type</label>
    <select id="link_type" name="link_type">
        <option value="">No link</option>
        @foreach ($linkTypes as $type)
            <option value="{{ $type }}" @selected(old('link_type', $item->link_type ?? '') === $type)>{{ $type }}</option>
        @endforeach
    </select>
</div>

<div class="field">
    <label for="link_value">Link Value</label>
    <input id="link_value" type="text" name="link_value" value="{{ old('link_value', $item->link_value ?? '') }}" placeholder="URL or ID depending on type">
</div>

<div class="field">
    <label for="sort_order">Sort Order</label>
    <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($item) ? $item->is_active : true) ? 'checked' : '' }}>
        Is Active
    </label>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.pages.sections.items.index', [$page, $section]) }}">Cancel</a>
</div>
