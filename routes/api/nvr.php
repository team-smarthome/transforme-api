<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NVRController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('nvr', [NVRController::class, 'index']);

// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('nvr', [NVRController::class, 'store']);
    Route::put('nvr', [NVRController::class, 'update']);
    Route::delete('nvr', [NVRController::class, 'destroy']);
// });
