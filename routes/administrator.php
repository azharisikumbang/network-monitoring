<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([
    'auth'
])->group(function () {
    Route::resource('users', UserController::class);
});