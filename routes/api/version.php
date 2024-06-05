<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VersionController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('version', [VersionController::class, 'index']);
});