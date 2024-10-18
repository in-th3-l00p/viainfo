<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserInvitationController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            "token" => "required|exists:user_invitations,token",
        ]);
        $invitation = UserInvitation::query()
            ->where("token", $request->input("token"))
            ->firstOrFail();

        return view("auth.invitation", [
            "invitation" => $invitation
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            "token" => "required|exists:user_invitations,token",
            "name" => "required|max:255",
            "email" => "required|email:rfc,dns|max:255",
            "password" => "required|confirmed|min:8|max:255",
        ]);

        User::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
            "role" => "user"
        ]);

        UserInvitation::query()
            ->where("token", $request->input("token"))
            ->delete();

        return redirect()
            ->route("login")
            ->with([ "success" => __("Account created successfully") ]);
    }
}
