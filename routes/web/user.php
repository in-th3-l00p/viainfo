<?php

use App\Http\Controllers\ClassroomInvitationController;
use App\Http\Controllers\User\Classrooms\ClassroomController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")
    ->group(function () {
        // dashboard
        Route::get("/dashboard", [
            UserController::class,
            "dashboard"
        ])
            ->name("user.dashboard");

        // classrooms
        Route::resource("classrooms", ClassroomController::class);

        // classrooms invitations
        Route::post("/classrooms/{classroom}/invitations/accept", [
            ClassroomInvitationController::class,
            "accept"
        ])
            ->name("classrooms.invitations.accept");
        Route::delete("/classrooms/{classroom}/invitations/reject", [
            ClassroomInvitationController::class,
            "reject"
        ])
            ->name("classrooms.invitations.reject");
    });
