<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NASController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('nas', [NASController::class, 'index']);

// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('nas', [NASController::class, 'store']);
    Route::put('nas', [NASController::class, 'update']);
    Route::delete('nas', [NASController::class, 'destroy']);
// });
