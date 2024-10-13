<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RedirectAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === "admin") {
            if ($request->route()->getName() === "user.dashboard")
                return redirect()->route("admin.dashboard");
            if (
                !Str::startsWith($request->route()->getName(), "admin.") &&
                Route::has("admin." . $request->route()->getName())
            )
                return redirect()->route("admin." . $request->route()->getName());
        }
        return $next($request);
    }
}
