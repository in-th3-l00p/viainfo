<?php

use App\Http\Controllers\ContactSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get("/contact/delete", [
    ContactSubmissionController::class,
    "delete"
])
    ->name("admin.contact.delete");
Route::get("/contact/trash", [
    ContactSubmissionController::class,
    "trash"
])
    ->name("admin.contact.trash");
Route::post("/contact/{contactSubmission}/restore", [
    ContactSubmissionController::class,
    "restore"
])
    ->name("admin.contact.restore");
Route::resource(
    "contact",
    ContactSubmissionController::class,
    [ "as" => "admin" ]
)
    ->only(["index", "show", "destroy"])
    ->middleware("can:admin");
