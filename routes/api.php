<?php

use Illuminate\Support\Facades\Route;

Route::domain('{account}.127.0.0.1.nip.io')->group(function () {

    Route::get('/user', function ($account) {
        return response()->json([
            'message' => 'Tenant API Working Successfully',
            'account' => $account,
        ]);
    });
    
});
