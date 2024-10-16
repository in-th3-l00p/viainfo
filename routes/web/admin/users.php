<?php

use App\Http\Controllers\Admin\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/users/delete/{user}", [UserController::class, "delete"])
    ->name("admin.users.delete");
Route::get("/users/trash", [UserController::class, "trash"])
    ->name("admin.users.trash");
Route::put("/users/restore/{user}", [UserController::class, "restore"])
    ->withTrashed()
    ->name("admin.users.restore");
Route::resource(
    "users",
    UserController::class, ["as" => "admin"]
);

require "users/invitations.php";
