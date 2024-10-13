<?php

use App\Http\Controllers\Admin\Classrooms\ClassroomTagController;
use App\Http\Controllers\ClassroomInvitationController;
use App\Http\Controllers\User\Classrooms\ClassroomController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\RedirectAdmin;
use Illuminate\Support\Facades\Route;

Route::
    middleware(["auth", RedirectAdmin::class])
    ->group(function () {
        // dashboard
        Route::get("/dashboard", [
            UserController::class,
            "dashboard"
        ])
            ->name("user.dashboard");

        require "user/classrooms.php";
    });
