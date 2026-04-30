<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\RegisterController;

Route::post('/register', RegisterController::class);