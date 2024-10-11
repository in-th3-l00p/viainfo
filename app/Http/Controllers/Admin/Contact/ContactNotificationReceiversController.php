<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\ContactNotificationReceiver;
use App\Models\ContactSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactNotificationReceiversController extends Controller
{
    public function create()
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        return view("admin.contact.receivers.create", [
            "users" => User::query()->paginate(),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        if ($request->type === "user") {
            $request->validate([
                "user_id" => "required|exists:users,id",
            ]);

            ContactNotificationReceiver::create([
                "user_id" => $request->user_id,
            ]);
        } else {
            $request->validate([
                "name" => "required|string",
                "email" => "required|email",
            ]);

            ContactNotificationReceiver::create([
                "name" => $request->name,
                "email" => $request->email,
            ]);
        }

        return redirect()
            ->route("admin.contact.index")
            ->with("success", __("Contact notification receiver created successfully."));
    }

    public function edit(ContactNotificationReceiver $receiver)
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        if ($receiver->user_id) {
            return back()
                ->with("error", __("You can't edit this contact notification receiver."));
        }

        return view(
            "admin.contact.receivers.edit",
            compact("receiver")
        );
    }

    public function update(Request $request, ContactNotificationReceiver $receiver)
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        if ($receiver->user_id) {
            return back()
                ->with("error", __("You can't edit this contact notification receiver."));
        }

        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
        ]);

        $receiver->update([
            "name" => $request->name,
            "email" => $request->email,
        ]);

        return redirect()
            ->route("admin.contact.index")
            ->with("success", __("Contact notification receiver updated successfully."));
    }

    public function delete(ContactNotificationReceiver $receiver)
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        return view(
            "admin.contact.receivers.delete",
            compact("receiver")
        );
    }

    public function destroy(ContactNotificationReceiver $receiver)
    {
        Gate::authorize("viewAny", ContactSubmission::class);
        $receiver->delete();
        return redirect()
            ->route("admin.contact.index")
            ->with("success", __("Contact notification receiver deleted successfully."));
    }
}
