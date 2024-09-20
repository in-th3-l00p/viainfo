<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/dashboard", [
    UserController::class,
    "dashboard"
])
    ->name("user.dashboard");
