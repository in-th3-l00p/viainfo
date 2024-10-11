<?php

use App\Http\Controllers\Admin\Contact\ContactNotificationReceiversController;
use App\Http\Controllers\Admin\Contact\ContactSubmissionController;
use Illuminate\Support\Facades\Route;

// everything related to notification receivers
Route::get("/contact/receivers/{receiver}/delete", [
    ContactNotificationReceiversController::class,
    "delete"
])
    ->name("admin.contact.receivers.delete");
Route::get("/contact/receivers/trash", [
    ContactNotificationReceiversController::class,
    "trash"
])
    ->name("admin.contact.receivers.trash");
Route::post("/contact-notification-receivers/{receiver}/restore", [
    ContactNotificationReceiversController::class,
    "restore"
])
    ->name("admin.contact.receivers.restore");
Route::resource(
    "receivers",
    ContactNotificationReceiversController::class,
    [ "as" => "admin.contact" ]
)
    ->only(["create", "store", "edit", "update", "destroy"])
    ->middleware("can:admin");

// everything related to submissions
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
