<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $faqCategories = FaqCategory::withCount('faqs')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.faq-categories.index', compact('faqCategories'));
    }

    public function create()
    {
        return view('admin.faq-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        FaqCategory::create([
            'name_ar' => $validated['name_ar'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.faq-categories.index')->with('success', 'FAQ category created successfully.');
    }

    public function show(FaqCategory $faqCategory)
    {
        return redirect()->route('admin.faq-categories.edit', $faqCategory);
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq-categories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $faqCategory->update([
            'name_ar' => $validated['name_ar'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.faq-categories.index')->with('success', 'FAQ category updated successfully.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()->route('admin.faq-categories.index')->with('success', 'FAQ category deleted successfully.');
    }
}
