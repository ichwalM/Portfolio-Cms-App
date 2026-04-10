<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::latest()->paginate(12);

        return view('dashboard.contacts.index', compact('messages'));
    }

    public function destroy(ContactMessage $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('success', 'Message deleted successfully!');
    }
}
