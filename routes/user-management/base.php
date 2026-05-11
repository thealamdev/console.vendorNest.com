<?php

use App\Http\Middleware\OrganizationContext;
use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\OrganizationController;
use Modules\UserManagement\Http\Controllers\OrganizationMemberController;
use Modules\UserManagement\Http\Controllers\PermissionController;
use Modules\UserManagement\Http\Controllers\RoleController;

Route::prefix('organizer')->name('organizer.')->group(function () {
    Route::controller(OrganizationController::class)->group(function () {
        Route::get('/get', 'get')->name('get');
        Route::post('/store', 'store')->name('store');
    });
});

Route::middleware('organization.context')->group(function () {
    Route::prefix('role')->name('role.')->group(function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/getAll', 'getAll')->name('getAll');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{role}', 'update')->name('update');
        });
    });

    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::controller(PermissionController::class)->group(function () {
            Route::get('/get/{role_id}', 'get')->name('get');
        });
    });

    Route::prefix('member')->name('member.')->group(function () {
        Route::controller(OrganizationMemberController::class)->group(function () {
            Route::get('/getAll', 'getAll')->name('getAll')->withoutMiddleware(OrganizationContext::class);
            Route::post('/store', 'store')->name('store');
        });
    });
});
