<?php

namespace App\Http\Controllers;

use App\Events\ContactSubmissionEvent;
use App\Models\ContactNotificationReceiver;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactSubmissionController extends Controller
{
    public function store(Request $request)
    {
        Gate::authorize("create", ContactSubmission::class);
        $validator = Validator::make($request->all(), [
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "email" => "required|email",
            "phone_number" => "nullable|max:255",
            "message" => "required|max:1000"
        ]);
        if ($validator->fails()) {
            return Redirect
                ::to(URL::previous() . "#" . __("contact"))
                ->withErrors($validator)
                ->withInput();
        }
        $submission = ContactSubmission::create($validator->validated());
        ContactSubmissionEvent::dispatch($submission);

        return Redirect
            ::to(URL::previous() . "#" . __("contact"))
            ->with(
                "success",
                __("Contact submission created successfully")
            );
    }
}
