<?php

use App\Http\Controllers\User\Classrooms\Events\ClassroomEventController;

Route::get("/classrooms/{classroom}/events/{event}/attend-code", [
    ClassroomEventController::class,
    "attendCode"
])
    ->name("classrooms.events.attend-code");
Route::post("/classrooms/{classroom}/events/{event}/attend", [
    ClassroomEventController::class,
    "attend"
])
    ->name("classrooms.events.attend");
Route::delete("/classrooms/{classroom}/events/{event}/unattend", [
    ClassroomEventController::class,
    "unattend"
])
    ->name("classrooms.events.unattend");
