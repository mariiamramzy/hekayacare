<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactLead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactLeadController extends Controller
{
    public function index(): View
    {
        $contactLeads = ContactLead::query()
            ->orderByDesc('id')
            ->get();

        return view('admin.contact-leads.index', compact('contactLeads'));
    }

    public function show(ContactLead $contactLead): RedirectResponse
    {
        return redirect()->route('admin.contact-leads.edit', $contactLead);
    }

    public function edit(ContactLead $contactLead): View
    {
        return view('admin.contact-leads.edit', compact('contactLead'));
    }

    public function update(Request $request, ContactLead $contactLead): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string'],
        ]);

        $contactLead->update($validated);

        return redirect()->route('admin.contact-leads.index')->with('success', 'Contact lead updated.');
    }

    public function destroy(ContactLead $contactLead): RedirectResponse
    {
        $contactLead->delete();

        return redirect()->route('admin.contact-leads.index')->with('success', 'Contact lead deleted.');
    }
}
