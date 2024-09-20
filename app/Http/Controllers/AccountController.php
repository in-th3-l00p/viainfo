<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {
    public function index() {
        Gate::authorize("auth");
        return view("account.profile");
    }

    public function edit() {
        Gate::authorize("auth");
        return view("account.edit");
    }

    public function update(Request $request) {
        Gate::authorize("auth");
        $request->validate([
            "name" => "required",
            "email" => "required|email",
        ]);

        if ($request->name !== $request->user()->name)
            $request->user()->update([
                "name" => $request->name
            ]);
        if ($request->email !== $request->user()->email)
            $request->user()->update([
                "email" => $request->email
            ]);

        return redirect()
            ->route("account.index")
            ->with("success", "Profile updated successfully");
    }

    public function editPassword(Request $request) {
        Gate::authorize("auth");
        return view("account.password");
    }

    public function updatePassword(Request $request) {
        Gate::authorize("auth");

        $request->validate([
            "current_password" => "required",
            "password" => "required|confirmed|min:8",
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()
                ->withInput()
                ->withErrors([
                    "current_password" => __("The current password is incorrect")
                ]);
        }

        auth()->user()->update([
            "password" => Hash::make($request->password)
        ]);

        return redirect()
            ->route("account.index")
            ->with("success", "Password updated successfully");
    }
}
