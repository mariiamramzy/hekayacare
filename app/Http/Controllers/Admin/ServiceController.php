<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Support\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::query()->ordered()->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        Service::query()->create($this->payload($request, $validated));
        $this->clearWebsiteCaches();

        return redirect()->route('admin.services.index')->with('success', 'تم إنشاء الخدمة بنجاح.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateRequest($request, $service->id);

        $service->update($this->payload($request, $validated, $service));
        $this->clearWebsiteCaches();

        return redirect()->route('admin.services.index')->with('success', 'تم تحديث الخدمة بنجاح.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        $this->clearWebsiteCaches();

        return redirect()->route('admin.services.index')->with('success', 'تم حذف الخدمة بنجاح.');
    }

    protected function validateRequest(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'page_title_ar' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'meta_description_ar' => ['nullable', 'string'],
            'icon_class' => ['nullable', 'string', 'max:255'],
            'service_type' => ['nullable', 'string', 'max:100'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'gallery_image_one_file' => ['nullable', 'image', 'max:5120'],
            'gallery_image_two_file' => ['nullable', 'image', 'max:5120'],
            'gallery_image_three_file' => ['nullable', 'image', 'max:5120'],
            'has_gallery_section' => ['nullable', 'boolean'],
            'highlights_intro' => ['nullable', 'string'],
            'card_points_text' => ['nullable', 'string'],
            'highlights_text' => ['nullable', 'string'],
            'tab_one_id' => ['nullable', 'string', 'max:100'],
            'tab_one_label' => ['nullable', 'string', 'max:255'],
            'tab_one_intro' => ['nullable', 'string'],
            'tab_one_points_text' => ['nullable', 'string'],
            'tab_two_id' => ['nullable', 'string', 'max:100'],
            'tab_two_label' => ['nullable', 'string', 'max:255'],
            'tab_two_intro' => ['nullable', 'string'],
            'tab_two_points_text' => ['nullable', 'string'],
            'tab_three_id' => ['nullable', 'string', 'max:100'],
            'tab_three_label' => ['nullable', 'string', 'max:255'],
            'tab_three_intro' => ['nullable', 'string'],
            'tab_three_points_text' => ['nullable', 'string'],
            'tab_four_id' => ['nullable', 'string', 'max:100'],
            'tab_four_label' => ['nullable', 'string', 'max:255'],
            'tab_four_intro' => ['nullable', 'string'],
            'tab_four_points_text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    protected function payload(Request $request, array $validated, ?Service $service = null): array
    {
        $payload = [
            'slug' => $this->generateUniqueSlug($validated['title_ar'], $service?->id),
            'title_ar' => $validated['title_ar'],
            'page_title_ar' => $validated['page_title_ar'] ?: null,
            'short_description' => $validated['short_description'] ?: null,
            'meta_description_ar' => $validated['meta_description_ar'] ?: null,
            'icon_class' => $validated['icon_class'] ?: null,
            'service_type' => $validated['service_type'] ?: null,
            'has_gallery_section' => (bool) ($validated['has_gallery_section'] ?? false),
            'highlights_intro' => $validated['highlights_intro'] ?: null,
            'card_points' => $this->linesToArray($validated['card_points_text'] ?? null),
            'highlights' => $this->linesToArray($validated['highlights_text'] ?? null),
            'tabs' => $this->buildTabs($validated),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => (bool) ($validated['is_active'] ?? false),
            'image_media_id' => $service?->image_media_id,
            'gallery_image_one_media_id' => $service?->gallery_image_one_media_id,
            'gallery_image_two_media_id' => $service?->gallery_image_two_media_id,
            'gallery_image_three_media_id' => $service?->gallery_image_three_media_id,
        ];

        if ($request->hasFile('image_file')) {
            $payload['image_media_id'] = MediaUploader::uploadImage($request->file('image_file'), 'services', $validated['title_ar']);
        }

        if ($request->hasFile('gallery_image_one_file')) {
            $payload['gallery_image_one_media_id'] = MediaUploader::uploadImage($request->file('gallery_image_one_file'), 'services/gallery', $validated['title_ar']);
        }

        if ($request->hasFile('gallery_image_two_file')) {
            $payload['gallery_image_two_media_id'] = MediaUploader::uploadImage($request->file('gallery_image_two_file'), 'services/gallery', $validated['title_ar']);
        }

        if ($request->hasFile('gallery_image_three_file')) {
            $payload['gallery_image_three_media_id'] = MediaUploader::uploadImage($request->file('gallery_image_three_file'), 'services/gallery', $validated['title_ar']);
        }

        return $payload;
    }

    protected function buildTabs(array $validated): array
    {
        $tabs = [];

        foreach (['one', 'two', 'three', 'four'] as $slot) {
            $label = trim((string) ($validated["tab_{$slot}_label"] ?? ''));
            $intro = trim((string) ($validated["tab_{$slot}_intro"] ?? ''));
            $id = trim((string) ($validated["tab_{$slot}_id"] ?? ''));
            $points = $this->linesToArray($validated["tab_{$slot}_points_text"] ?? null);

            if ($label === '' && $intro === '' && $points === []) {
                continue;
            }

            $tabs[] = [
                'id' => $id !== '' ? Str::slug($id) : 'tab-'.$slot,
                'label' => $label !== '' ? $label : 'تبويب',
                'intro' => $intro,
                'points' => $points,
            ];
        }

        return $tabs;
    }

    protected function linesToArray(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value) ?: [])
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    protected function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($this->transliterateArabic($title));
        if ($baseSlug === '') {
            $baseSlug = 'service';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            Service::query()
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    protected function transliterateArabic(string $value): string
    {
        return strtr($value, [
            'ا' => 'a', 'أ' => 'a', 'إ' => 'i', 'آ' => 'aa',
            'ب' => 'b', 'ت' => 't', 'ث' => 'th', 'ج' => 'j',
            'ح' => 'h', 'خ' => 'kh', 'د' => 'd', 'ذ' => 'dh',
            'ر' => 'r', 'ز' => 'z', 'س' => 's', 'ش' => 'sh',
            'ص' => 's', 'ض' => 'd', 'ط' => 't', 'ظ' => 'z',
            'ع' => 'a', 'غ' => 'gh', 'ف' => 'f', 'ق' => 'q',
            'ك' => 'k', 'ل' => 'l', 'م' => 'm', 'ن' => 'n',
            'ه' => 'h', 'و' => 'w', 'ؤ' => 'w', 'ي' => 'y',
            'ى' => 'a', 'ئ' => 'y', 'ة' => 'h', 'ء' => '',
        ]);
    }

    protected function clearWebsiteCaches(): void
    {
        Cache::forget('website.services.all');
        Cache::forget('website.sitemap.xml');
    }
}
