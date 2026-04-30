<?php

use Illuminate\Support\Facades\Route;


/**
 * Auth routes
 */
require __DIR__ . '/auth/auth.php';

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::prefix('user-management')->name('user-management.')->group(function () {
        require __DIR__ . '/user-management/base.php';
    });
});
