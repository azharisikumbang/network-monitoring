<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\DownloadSiteContractDocumentController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'role:administrator'
])->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('sites', SiteController::class);
    Route::resource('nodes', NodeController::class);

    Route::get('/sites/{site}/contract/download', DownloadSiteContractDocumentController::class)->name('sites.contract_document.download');
});