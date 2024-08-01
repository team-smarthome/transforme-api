<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TVController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('tv', [TVController::class, 'index']);
    // Route::get('gateway', [TVController::class, 'index']);

// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('tv', [TVController::class, 'store']);
    Route::put('tv', [TVController::class, 'update']);
    Route::delete('tv', [TVController::class, 'destroy']);
// });
