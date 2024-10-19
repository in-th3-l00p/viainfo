<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact\ContactNotificationReceiver;
use App\Models\Contact\ContactSubmission;
use Illuminate\Support\Facades\Gate;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        return view("admin.contact.index", [
            "contacts" => ContactSubmission::latest()->paginate(5),
            "receivers" => ContactNotificationReceiver::all()
        ]);
    }

    public function show(ContactSubmission $contact)
    {
        Gate::authorize("view", [
            ContactSubmission::class,
            $contact
        ]);
        return view("admin.contact.show", [
            "contact" => $contact
        ]);
    }

    public function delete(ContactSubmission $contact)
    {
        Gate::authorize("delete", [
            ContactSubmission::class,
            $contact
        ]);

        return view("admin.contact.delete", [
            "contact" => $contact
        ]);
    }

    public function destroy(ContactSubmission $contact)
    {
        Gate::authorize("delete", [
            ContactSubmission::class,
            $contact
        ]);

        $contact->delete();
        return redirect()
            ->route("admin.contact.index")
            ->with("success", __("Contact submission deleted successfully"));
    }

    public function trash()
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        return view("admin.contact.trash", [
            "contacts" => ContactSubmission::onlyTrashed()
                ->latest()
                ->paginate(5)
        ]);
    }

    public function restore(ContactSubmission $contact)
    {
        Gate::authorize("restore", [
            ContactSubmission::class,
            $contact
        ]);

        $contact->restore();
        return redirect()
            ->route("admin.contact.index")
            ->with("success", __("Contact submission restored successfully"));
    }
}
