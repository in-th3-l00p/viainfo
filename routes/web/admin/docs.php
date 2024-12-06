<?php

use Illuminate\Support\Facades\Route;

Route::prefix("/docs")->group(function() {
    Route::view("/", "admin.docs.index")
        ->name("admin.docs.index");
    Route::view("/invites", "admin.docs.invites")
        ->name("admin.docs.invites");
    Route::view("/attendance", "admin.docs.attendance")
        ->name("admin.docs.attendance");
});
