<?php

use App\Http\Controllers\Admin\Classrooms\ClassroomTagController;
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
        Route::get("/classrooms/{classroom}/leave", [
            ClassroomController::class,
            "leaveForm"
        ])
            ->name("classrooms.leave.form");
        Route::delete(
            "/classrooms/{classroom}/leave",
            [ ClassroomController::class, "leave" ]
        )
            ->name("classrooms.leave");
        Route::resource("classrooms", ClassroomController::class)
            ->only([ "index", "show" ]);
        Route::resource("classrooms.tags", ClassroomTagController::class)
            ->only([ "index", "show" ]);

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
