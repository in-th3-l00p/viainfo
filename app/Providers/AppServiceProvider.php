<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::setRootView("layouts.main");
        Paginator::defaultView("vendor.pagination.tailwind");
        Paginator::defaultSimpleView("vendor.pagination.simple-tailwind");

        Gate::define("auth", function (User $user) {
            return true;
        });

        Gate::define("admin", function (User $user) {
            return $user->role === "admin";
        });
    }
}
