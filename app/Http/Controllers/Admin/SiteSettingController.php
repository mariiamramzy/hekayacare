<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\MediaUploader;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::query()->first();

        if (!$setting) {
            $setting = new SiteSetting();
            $setting->save();
        }

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name_ar' => ['nullable', 'string', 'max:255'],
            'tagline_ar' => ['nullable', 'string', 'max:255'],
            'logo_image' => ['nullable', 'image', 'max:5120'],
            'favicon_image' => ['nullable', 'image', 'max:5120'],
            'primary_phone' => ['nullable', 'string', 'max:50'],
            'whatsapp_number' => ['nullable', 'string', 'max:50'],
            'primary_email' => ['nullable', 'email', 'max:255'],
            'address_ar' => ['nullable', 'string', 'max:255'],
            'google_maps_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'working_hours_ar' => ['nullable', 'string'],
        ]);

        $setting = SiteSetting::query()->first();

        if (!$setting) {
            $setting = new SiteSetting();
        }

        if ($request->hasFile('logo_image')) {
            $validated['logo_media_id'] = MediaUploader::uploadImage($request->file('logo_image'), 'settings');
        }

        if ($request->hasFile('favicon_image')) {
            $validated['favicon_media_id'] = MediaUploader::uploadImage($request->file('favicon_image'), 'settings');
        }

        $setting->fill($validated);
        $setting->save();

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
