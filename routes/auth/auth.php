<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\RegisterController;

Route::middleware('throttle:5,1')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('/register', RegisterController::class);
    });
});
