<?php

use App\Http\Controllers\Admin\Classrooms\ClassroomController;
use Illuminate\Support\Facades\Route;

Route::get("/classrooms/delete/{classroom}", [ClassroomController::class, "delete"])
    ->name("admin.classrooms.delete");
Route::get("/classrooms/trash", [ClassroomController::class, "trash"])
    ->name("admin.classrooms.trash");
Route::put("/classrooms/restore/{classroom}", [ClassroomController::class, "restore"])
    ->withTrashed()
    ->name("admin.classrooms.restore");
Route::resource(
    "classrooms",
    ClassroomController::class,
    ["as" => "admin"]
)
    ->except("edit");

require "classrooms/classroomInvitations.php";
require "classrooms/classroomUsers.php";
require "classrooms/classroomEvents.php";
