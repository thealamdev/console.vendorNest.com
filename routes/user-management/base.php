<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\OrganizerController;

Route::prefix('organizer')->name('organizer.')->group(function () {
    Route::controller(OrganizerController::class)->group(function () {
        Route::get('/get', 'get')->name('get');
        Route::post('/store', 'store')->name('store');
    });
});
