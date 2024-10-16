<?php

use App\Http\Controllers\Admin\Classrooms\Events\ClassroomEventController;
use Illuminate\Support\Facades\Route;

Route::get(
    "/classrooms/{classroom}/events/{event}/delete",
    [ClassroomEventController::class, "delete"]
)
    ->name("admin.classrooms.events.delete");
Route::get(
    "/classrooms/{classroom}/events/trash",
    [ClassroomEventController::class, "trash"]
)
    ->name("admin.classrooms.events.trash");
Route::put(
    "/classrooms/{classroom}/events/{event}/restore",
    [ClassroomEventController::class, "restore"]
)
    ->withTrashed()
    ->name("admin.classrooms.events.restore");
Route::resource(
    "classrooms.events",
    ClassroomEventController::class,
    [ "as" => "admin" ]
)
    ->only(["create", "store", "edit", "update", "destroy"])
    ->parameters(["events" => "event"]);

require "attendees.php";
