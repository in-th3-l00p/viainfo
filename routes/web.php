<?php

use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get("/", IndexController::class)
    ->name("index");
Route::post("/contact", [
    ContactSubmissionController::class,
    "store"
])
    ->name("contact.store");

require __DIR__ . "/web/auth.php";
require __DIR__ . "/web/user.php";
require __DIR__ . "/web/admin.php";
require __DIR__ . "/web/account.php";
