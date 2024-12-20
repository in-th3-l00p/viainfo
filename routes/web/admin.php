<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix("/admin")
    ->middleware(["auth", "can:admin"])
    ->group(function () {
        Route::get("/dashboard", [AdminController::class, "dashboard"])
            ->name("admin.dashboard");

        require "admin/users.php";
        require "admin/classrooms.php";
        require "admin/contact.php";
        require "admin/docs.php";
    });
