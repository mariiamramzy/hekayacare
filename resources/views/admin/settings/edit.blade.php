@extends('admin.layout')

@section('title', 'Site Settings')

@section('content')
    <section class="card">
        <h2 class="page-title">Site Settings & Contact Channels</h2>
        <p class="muted" style="margin-top: -8px;">Single settings record for public site identity and contact channels.</p>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="site_name_ar">Site Name (AR)</label>
                <input id="site_name_ar" type="text" name="site_name_ar" value="{{ old('site_name_ar', $setting->site_name_ar) }}">
            </div>

            <div class="field">
                <label for="tagline_ar">Tagline (AR)</label>
                <input id="tagline_ar" type="text" name="tagline_ar" value="{{ old('tagline_ar', $setting->tagline_ar) }}">
            </div>

            <div class="field">
                <label for="logo_image">Logo Image</label>
                <input id="logo_image" type="file" name="logo_image" accept="image/*">
                @if($setting->logoMedia?->path)
                    <div class="muted" style="margin-top:6px;">الحالي: <a href="{{ asset('storage/'.$setting->logoMedia->path) }}" target="_blank">عرض الشعار</a></div>
                @endif
            </div>

            <div class="field">
                <label for="favicon_image">Favicon Image</label>
                <input id="favicon_image" type="file" name="favicon_image" accept="image/*">
                @if($setting->faviconMedia?->path)
                    <div class="muted" style="margin-top:6px;">الحالي: <a href="{{ asset('storage/'.$setting->faviconMedia->path) }}" target="_blank">عرض الأيقونة</a></div>
                @endif
            </div>

            <div class="field">
                <label for="primary_phone">Primary Phone</label>
                <input id="primary_phone" type="text" name="primary_phone" value="{{ old('primary_phone', $setting->primary_phone) }}">
            </div>

            <div class="field">
                <label for="whatsapp_number">WhatsApp Number</label>
                <input id="whatsapp_number" type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}">
            </div>

            <div class="field">
                <label for="primary_email">Primary Email</label>
                <input id="primary_email" type="email" name="primary_email" value="{{ old('primary_email', $setting->primary_email) }}">
            </div>

            <div class="field">
                <label for="address_ar">Address (AR)</label>
                <input id="address_ar" type="text" name="address_ar" value="{{ old('address_ar', $setting->address_ar) }}">
            </div>

            <div class="field">
                <label for="google_maps_url">Google Maps URL</label>
                <input id="google_maps_url" type="url" name="google_maps_url" value="{{ old('google_maps_url', $setting->google_maps_url) }}">
            </div>

            <div class="field">
                <label for="facebook_url">Facebook URL</label>
                <input id="facebook_url" type="url" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}">
            </div>

            <div class="field">
                <label for="instagram_url">Instagram URL</label>
                <input id="instagram_url" type="url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}">
            </div>

            <div class="field">
                <label for="youtube_url">YouTube URL</label>
                <input id="youtube_url" type="url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}">
            </div>

            <div class="field">
                <label for="working_hours_ar">Working Hours (AR)</label>
                <textarea id="working_hours_ar" name="working_hours_ar">{{ old('working_hours_ar', $setting->working_hours_ar) }}</textarea>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">حفظ الإعدادات</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">رجوع</a>
            </div>
        </form>
    </section>
@endsection
