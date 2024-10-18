<?php

use App\Http\Controllers\UserInvitationController;
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

Route::get("/invitation", [
    UserInvitationController::class,
    "create"
])
    ->name("invitation.create");
Route::post("/invitation", [
    UserInvitationController::class,
    "store"
])
    ->name("invitation.store");

require __DIR__ . "/web/auth.php";
require __DIR__ . "/web/user.php";
require __DIR__ . "/web/admin.php";
require __DIR__ . "/web/account.php";
