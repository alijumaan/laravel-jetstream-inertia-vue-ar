<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contacts/Index', [
            'contacts' => Contact::latest()->get()
        ]);
    }
    public function show(Contact $contact)
    {
        $this->authorize('Show contact');

        $contact->update(['is_read' => 1]);

        return Inertia::render('Contacts/Show', [
            'contact' => $contact
        ]);
    }

    public function store(ContactRequest $request)
    {
        Contact::create($request->validated() + [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email
            ]);

        return Redirect::route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('Delete contact');

        $contact->delete();

        return Redirect::route('contacts.index');
    }
}
