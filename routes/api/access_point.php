<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessPointController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('access_point', [AccessPointController::class, 'index']);
    // Route::get('gateway', [AccessPointController::class, 'index']);

// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('access_point', [AccessPointController::class, 'store']);
    Route::put('access_point', [AccessPointController::class, 'update']);
    Route::delete('access_point', [AccessPointController::class, 'destroy']);
// });
