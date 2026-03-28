<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('categories')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $categories = FaqCategory::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_ar' => ['required', 'string', 'max:255'],
            'answer_ar' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:faq_categories,id'],
        ]);

        $faq = Faq::create([
            'question_ar' => $validated['question_ar'],
            'answer_ar' => $validated['answer_ar'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        $faq->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function show(Faq $faq)
    {
        return redirect()->route('admin.faqs.edit', $faq);
    }

    public function edit(Faq $faq)
    {
        $categories = FaqCategory::orderBy('sort_order')->orderBy('id')->get();
        $faq->load('categories');

        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question_ar' => ['required', 'string', 'max:255'],
            'answer_ar' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:faq_categories,id'],
        ]);

        $faq->update([
            'question_ar' => $validated['question_ar'],
            'answer_ar' => $validated['answer_ar'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        $faq->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
