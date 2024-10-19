<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get("/login", [LoginController::class, "loginForm"])
    ->name("login");
Route::post("/login", [LoginController::class, "loginSubmit"])
    ->name("login.submit");
Route::get("/logout", [LoginController::class, "logout"])
    ->name("logout");
