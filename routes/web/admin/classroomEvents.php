<?php

use App\Http\Controllers\Admin\Classrooms\Events\ClassroomEventController;
use Illuminate\Support\Facades\Route;

Route::resource(
    "classrooms.events",
    ClassroomEventController::class,
    [ "as" => "admin" ]
)
    ->only(["create", "store", "edit", "update"])
    ->parameters(["events" => "event"]);
