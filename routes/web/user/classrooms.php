<?php

use App\Http\Controllers\User\Classrooms\ClassroomController;
use App\Http\Controllers\User\Classrooms\ClassroomTagController;
use Illuminate\Support\Facades\Route;

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

require "classroomInvitations.php";
require "classroomEvents.php";
