<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get("/login", [AuthController::class, "loginForm"])
    ->name("login.form");
Route::post("/login", [AuthController::class, "loginSubmit"])
    ->name("login.submit");
Route::get("/logout", [AuthController::class, "logout"])
    ->name("logout");
