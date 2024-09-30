<?php

use App\Http\Controllers\ClassroomInvitationController;
use Illuminate\Support\Facades\Route;

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
