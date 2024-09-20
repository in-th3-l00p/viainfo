<?php

use App\Http\Controllers\Admin\Classrooms\ClassroomController;
use Illuminate\Support\Facades\Route;

Route::get("/classrooms/delete/{test_project}", [ClassroomController::class, "delete"])
    ->name("admin.classrooms.delete");
Route::get("/classrooms/trash", [ClassroomController::class, "trash"])
    ->name("admin.classrooms.trash");
Route::put("/classrooms/restore/{test_project}", [ClassroomController::class, "restore"])
    ->withTrashed()
    ->name("admin.classrooms.restore");
Route::resource(
    "classrooms",
    ClassroomController::class,
    ["as" => "admin"]
);

require "classroomTags.php";
