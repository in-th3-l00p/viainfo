<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::get("/account", [AccountController::class, "index"])
    ->name("account.index");
Route::get("/account/edit", [AccountController::class, "edit"])
    ->name("account.edit");
Route::put("/account/update", [AccountController::class, "update"])
    ->name("account.update");
Route::get("/account/password", [AccountController::class, "editPassword"])
    ->name("account.password");
Route::put("/account/password", [AccountController::class, "updatePassword"])
    ->name("account.password.update");
