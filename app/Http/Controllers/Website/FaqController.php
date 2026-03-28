<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;

class FaqController extends Controller
{
    public function index()
    {
        $groupedFaqs = FaqCategory::query()
            ->with(['faqs' => function ($query) {
                $query->active();
            }])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function ($category) {
                return [
                    'title' => $category->name_ar,
                    'faqs' => $category->faqs->values(),
                ];
            })
            ->filter(fn (array $group) => $group['faqs']->isNotEmpty())
            ->values();

        $uncategorizedFaqs = Faq::query()
            ->active()
            ->doesntHave('categories')
            ->get();

        if ($uncategorizedFaqs->isNotEmpty()) {
            $groupedFaqs->push([
                'title' => 'أسئلة عامة',
                'faqs' => $uncategorizedFaqs->values(),
            ]);
        }

        $allFaqs = $groupedFaqs
            ->pluck('faqs')
            ->flatten(1)
            ->unique('id')
            ->values();

        return view('website.faqs', compact('allFaqs'));
    }
}
