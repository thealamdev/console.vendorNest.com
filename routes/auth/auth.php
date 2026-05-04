<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthManagement\Http\Controllers\LoginController;
use Modules\AuthManagement\Http\Controllers\RegisterController;

Route::middleware('throttle:5,1')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('/register', RegisterController::class);
        Route::post('/login', LoginController::class);
    });
});
