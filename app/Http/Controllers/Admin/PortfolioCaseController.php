<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCase;
use App\Support\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioCaseController extends Controller
{
    public function index()
    {
        $portfolioCases = PortfolioCase::query()
            ->with('coverMedia')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.portfolio-cases.index', compact('portfolioCases'));
    }

    public function create()
    {
        return view('admin.portfolio-cases.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        PortfolioCase::query()->create($this->payloadFromRequest($request, $validated));

        return redirect()->route('admin.portfolio-cases.index')->with('success', 'Portfolio case created successfully.');
    }

    public function edit(PortfolioCase $portfolioCase)
    {
        $portfolioCase->load(['coverMedia', 'mainMedia', 'secondaryMedia', 'sidebarMedia']);

        return view('admin.portfolio-cases.edit', compact('portfolioCase'));
    }

    public function update(Request $request, PortfolioCase $portfolioCase)
    {
        $validated = $this->validateRequest($request, $portfolioCase);

        $portfolioCase->update($this->payloadFromRequest($request, $validated, $portfolioCase));

        return redirect()->route('admin.portfolio-cases.index')->with('success', 'Portfolio case updated successfully.');
    }

    public function destroy(PortfolioCase $portfolioCase)
    {
        $portfolioCase->delete();

        return redirect()->route('admin.portfolio-cases.index')->with('success', 'Portfolio case deleted successfully.');
    }

    protected function validateRequest(Request $request, ?PortfolioCase $portfolioCase = null): array
    {
        return $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'card_sub_title' => ['nullable', 'string', 'max:255'],
            'excerpt_ar' => ['nullable', 'string'],
            'cover_image_file' => [$portfolioCase ? 'nullable' : 'required', 'image', 'max:5120'],
            'main_image_file' => ['nullable', 'image', 'max:5120'],
            'intro_heading' => ['nullable', 'string', 'max:255'],
            'intro_text' => ['nullable', 'string'],
            'secondary_image_file' => ['nullable', 'image', 'max:5120'],
            'points_heading' => ['nullable', 'string', 'max:255'],
            'points_text' => ['nullable', 'string'],
            'point_one_ar' => ['nullable', 'string'],
            'point_two_ar' => ['nullable', 'string'],
            'point_three_ar' => ['nullable', 'string'],
            'closing_text' => ['nullable', 'string'],
            'case_label' => ['nullable', 'string', 'max:255'],
            'started_at' => ['nullable', 'date'],
            'location_ar' => ['nullable', 'string', 'max:255'],
            'client_name_ar' => ['nullable', 'string', 'max:255'],
            'duration_ar' => ['nullable', 'string', 'max:255'],
            'sidebar_image_file' => ['nullable', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    protected function payloadFromRequest(Request $request, array $validated, ?PortfolioCase $portfolioCase = null): array
    {
        $slug = $this->generateUniqueSlug($validated['title_ar'], $portfolioCase);

        return [
            'slug' => $slug,
            'title_ar' => $validated['title_ar'],
            'card_sub_title' => $validated['card_sub_title'] ?? null,
            'excerpt_ar' => $validated['excerpt_ar'] ?? null,
            'cover_media_id' => $this->resolveMediaId($request, 'cover_image_file', 'portfolio', $portfolioCase?->cover_media_id, $validated['title_ar'].' cover'),
            'main_media_id' => $this->resolveMediaId($request, 'main_image_file', 'portfolio', $portfolioCase?->main_media_id, $validated['title_ar'].' main'),
            'intro_heading' => $validated['intro_heading'] ?? null,
            'intro_text' => $validated['intro_text'] ?? null,
            'secondary_media_id' => $this->resolveMediaId($request, 'secondary_image_file', 'portfolio', $portfolioCase?->secondary_media_id, $validated['title_ar'].' secondary'),
            'points_heading' => $validated['points_heading'] ?? null,
            'points_text' => $validated['points_text'] ?? null,
            'point_one_ar' => $validated['point_one_ar'] ?? null,
            'point_two_ar' => $validated['point_two_ar'] ?? null,
            'point_three_ar' => $validated['point_three_ar'] ?? null,
            'closing_text' => $validated['closing_text'] ?? null,
            'case_label' => $validated['case_label'] ?? null,
            'started_at' => $validated['started_at'] ?? null,
            'location_ar' => $validated['location_ar'] ?? null,
            'client_name_ar' => $validated['client_name_ar'] ?? null,
            'duration_ar' => $validated['duration_ar'] ?? null,
            'sidebar_media_id' => $this->resolveMediaId($request, 'sidebar_image_file', 'portfolio', $portfolioCase?->sidebar_media_id, $validated['title_ar'].' sidebar'),
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ];
    }

    protected function resolveMediaId(Request $request, string $field, string $directory, ?int $existingId, string $altText): ?int
    {
        if (! $request->hasFile($field)) {
            return $existingId;
        }

        return MediaUploader::uploadImage($request->file($field), $directory, $altText);
    }

    protected function generateUniqueSlug(string $title, ?PortfolioCase $portfolioCase = null): string
    {
        $baseSlug = Str::slug($title);
        if ($baseSlug === '') {
            $baseSlug = 'portfolio-case';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            PortfolioCase::query()
                ->when($portfolioCase, fn ($query) => $query->whereKeyNot($portfolioCase->getKey()))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
