<?php

use App\Http\Controllers\Admin\Users\UserInvitationController;
use Illuminate\Support\Facades\Route;

Route::post("/users/invitations/send/batch", [
    UserInvitationController::class,
    "batchSend"
])
    ->name("admin.users.invitations.send.batch");
Route::post("/users/invitations/send/{invitation}", [
    UserInvitationController::class,
    "send"
])
    ->name("admin.users.invitations.send");

Route::get("/users/invitations/delete/batch", [
    UserInvitationController::class,
    "batchDelete"
])
    ->name("admin.users.invitations.batchDelete");
Route::delete("/users/invitations/delete/batch", [
    UserInvitationController::class,
    "batchDestroy"
])
    ->name("admin.users.invitations.batchDestroy");
Route::get("/users/invitations/delete/{invitation}", [
    UserInvitationController::class,
    "delete"
])
    ->name("admin.users.invitations.delete");
Route::resource(
    "invitations",
    UserInvitationController::class,
    ["as" => "admin.users"]
)
    ->only("index", "create", "store", "destroy");
