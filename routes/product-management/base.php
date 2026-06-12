<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductManagement\Http\Controllers\CategoryController;

Route::middleware('organization.context')->group(function () {
    Route::prefix('category')->name('category.')->group(function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{category}', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{category}', 'update')->name('update');
            Route::delete('/delete/{category}', 'destroy')->name('destroy');
        });
    });
});
