<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'role:administrator'
])->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('branches', BranchController::class);
});