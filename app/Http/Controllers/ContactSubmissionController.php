<?php

namespace App\Http\Controllers;

use App\Events\ContactSubmissionEvent;
use App\Models\ContactNotificationReceiver;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactSubmissionController extends Controller
{
    public function store(Request $request)
    {
        Gate::authorize("create", ContactSubmission::class);
        $submission = ContactSubmission::create($request->validate([
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "email" => "required|email",
            "phone_number" => "required|max:255",
            "message" => "required|max:1000"
        ]));
        ContactSubmissionEvent::dispatch($submission);

        return back()
            ->with(
                "success",
                __("Contact submission created successfully")
            );
    }
}
