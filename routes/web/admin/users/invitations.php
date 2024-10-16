<?php

use App\Http\Controllers\Admin\Users\UserInvitationController;
use Illuminate\Support\Facades\Route;

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
