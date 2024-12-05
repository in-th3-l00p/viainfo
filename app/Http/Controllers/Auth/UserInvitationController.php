<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
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

        $invitation = UserInvitation::query()
            ->where("token", $request->input("token"))
            ->firstOrFail();

        $user = User::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
            "role" => "user"
        ]);

        if ($invitation->classroom_name) {
            $classroom = Classroom::query()
                ->where("name", $invitation->classroom_name)
                ->first();
            if ($classroom)
                $classroom->users()->attach($user->id);
        }
        $invitation->delete();

        return redirect()
            ->route("login")
            ->with([ "success" => __("Account created successfully") ]);
    }
}
