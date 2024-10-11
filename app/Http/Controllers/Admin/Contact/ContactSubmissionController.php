<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\ContactNotificationReceiver;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        return view("admin.contact.index", [
            "contacts" => ContactSubmission::latest()->paginate(10),
            "receivers" => ContactNotificationReceiver::all()
        ]);
    }

    public function show(ContactSubmission $contactSubmission)
    {
        Gate::authorize("view", [
            ContactSubmission::class,
            $contactSubmission
        ]);
        return view("admin.contact.show", [
            "contact" => $contactSubmission
        ]);
    }

    public function delete(ContactSubmission $contactSubmission)
    {
        Gate::authorize("delete", [
            ContactSubmission::class,
            $contactSubmission
        ]);

        return view("admin.contact.delete", [
            "contact" => $contactSubmission
        ]);
    }

    public function destroy(ContactSubmission $contactSubmission)
    {
        Gate::authorize("delete", [
            ContactSubmission::class,
            $contactSubmission
        ]);

        $contactSubmission->delete();
        return redirect()
            ->route("admin.contact.index")
            ->with("success", __("Contact submission deleted successfully"));
    }

    public function trash()
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        return view("admin.contact.trash", [
            "contacts" => ContactSubmission::onlyTrashed()->latest()->paginate(10)
        ]);
    }

    public function restore(ContactSubmission $contactSubmission)
    {
        Gate::authorize("restore", [
            ContactSubmission::class,
            $contactSubmission
        ]);

        $contactSubmission->restore();
        return redirect()
            ->route("admin.contact.index")
            ->with("success", __("Contact submission restored successfully"));
    }
}
