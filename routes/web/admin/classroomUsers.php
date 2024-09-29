<?php

use App\Http\Controllers\Admin\Classrooms\ClassroomUserController;
use Illuminate\Support\Facades\Route;

Route::get("/admin/classrooms/{classrooms}/users/{user}", [ClassroomUserController::class, "delete"])
    ->name("admin.classrooms.users.delete");
Route::resource(
    "classrooms.users",
    ClassroomUserController::class,
    ["as" => "admin"]
)
    ->only(["update", "destroy"]);
