<?php

use App\Http\Controllers\Admin\Classrooms\ClassroomTagController;
use Illuminate\Support\Facades\Route;

Route::delete(
    "/classrooms/{test_project}/tags",
    [ClassroomTagController::class, "destroyBatch"]
)
    ->name("admin.classrooms.tags.destroyBatch");
Route::prefix("/classrooms")
    ->resource(
        "tags",
        ClassroomTagController::class,
        ["as" => "admin"]
    )
    ->only([ "index", "show", "edit", "update" ]);
Route::resource(
    "classrooms.tags",
    ClassroomTagController::class,
    ["as" => "admin"]
)
    ->only([ "create", "store", "destroy" ]);
