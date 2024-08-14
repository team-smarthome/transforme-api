<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesktopMapController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('desktop', [DesktopMapController::class, 'index']);
    // Route::get('gateway', [DesktopMapController::class, 'index']);

// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('desktop', [DesktopMapController::class, 'store']);
    Route::put('desktop', [DesktopMapController::class, 'update']);
    Route::delete('desktop', [DesktopMapController::class, 'destroy']);
// });
