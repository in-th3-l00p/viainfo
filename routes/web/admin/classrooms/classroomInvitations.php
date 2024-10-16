<?php

use App\Http\Controllers\ClassroomInvitationController;
use Illuminate\Support\Facades\Route;

Route::delete("/classrooms/{classroom}/invitations/destroy/{user}", [
    ClassroomInvitationController::class,
    "destroy"
])
    ->name("admin.classrooms.invitations.destroy");
