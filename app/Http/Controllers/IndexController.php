<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller {
    public function __invoke(Request $request) {
        if (!$request->user())
            return redirect()->route("login");
        if ($request->user()->role === "admin")
            return redirect()->route("admin.dashboard");
        return redirect()->route("user.dashboard");
    }
}
