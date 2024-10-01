<?php

use App\Http\Controllers\Admin\Classrooms\Events\AttendeeController;
use Illuminate\Support\Facades\Route;

Route::get(
    "/admin/classrooms/{classroom}/events/{event}/show-attend-code",
    [AttendeeController::class, "showAttendCode"]
)
    ->name("admin.classrooms.events.attendees.show-attend-code");
Route::post(
    "/admin/classrooms/{classroom}/events/{event}/attendees/{user}/mark-as-attended",
    [AttendeeController::class, "markAsAttended"]
)
    ->name("admin.classrooms.events.attendees.mark-as-attended");

Route::delete(
    "/admin/classrooms/{classroom}/events/{event}/attendees/{user}/mark-as-not-attended",
    [AttendeeController::class, "markAsNotAttended"]
)
    ->name("admin.classrooms.events.attendees.mark-as-not-attended");

Route::get(
    "/admin/classrooms/{classroom}/events/{event}/attendees",
    [AttendeeController::class, "index"]
)
    ->name("admin.classrooms.events.attendees.index");
