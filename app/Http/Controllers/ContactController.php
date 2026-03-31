<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\ContactImportService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $contacts = Contact::query()
            ->when($request->string('search')->toString(), fn ($q, $term) => $q->where('email', 'like', "%{$term}%"))
            ->latest()
            ->paginate(20);

        return view('contacts.index', compact('contacts'));
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        Contact::create($request->validated());
        activity()->event('contact.created')->log('Contact created');

        return back()->with('success', 'Contact saved');
    }

    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        $contact->update($request->validated());
        activity()->event('contact.updated')->log('Contact updated');

        return back()->with('success', 'Contact updated');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        activity()->event('contact.deleted')->log('Contact deleted');

        return back()->with('success', 'Contact deleted');
    }

    public function import(Request $request, ContactImportService $service): RedirectResponse
    {
        $service->import($request->file('file'));
        activity()->event('contact.imported')->log('Contacts imported');

        return back()->with('success', 'Contacts imported');
    }

    public function export()
    {
        return app(ContactImportService::class)->export();
    }
}
