<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\OrganizationMemberController;
use Modules\UserManagement\Http\Controllers\OrganizerController;
use Modules\UserManagement\Http\Controllers\RoleController;

Route::prefix('organizer')->name('organizer.')->group(function () {
    Route::controller(OrganizerController::class)->group(function () {
        Route::get('/get', 'get')->name('get');
        Route::post('/store', 'store')->name('store');
    });
});

Route::middleware('organization.context')->group(function () {
    Route::prefix('role')->name('role.')->group(function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/getAll', 'getAll')->name('getAll');
            Route::post('/store', 'store')->name('store');
        });
    });

    Route::prefix('member')->name('member.')->group(function () {
        Route::controller(OrganizationMemberController::class)->group(function () {
            Route::post('/store', 'store')->name('store');
        });
    });
});
