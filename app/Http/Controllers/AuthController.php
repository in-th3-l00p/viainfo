<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function loginForm() {
        if (Auth::check())
            return redirect("/");
        return view("auth.login");
    }

    public function loginSubmit(Request $request) {
        $body = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (!Auth::attempt($body))
            return redirect()
                ->back()
                ->withErrors([
                    "auth" => __("Invalid email or password")
                ]);

        if ($request->user()->role === "admin")
            return redirect()->intended(route("admin.dashboard"));
        return redirect()->intended(route("user.dashboard"));
    }

    public function logout() {
        Auth::logout();
        return redirect()
            ->route("login")
            ->with(["success", "Logout successfully"]);
    }
}
