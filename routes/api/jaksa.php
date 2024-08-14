<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JaksaController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('jaksa', [JaksaController::class, 'index']);
    // Route::get('jaksa/{id}', [JaksaController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('jaksa', [JaksaController::class, 'store']);
    Route::put('jaksa', [JaksaController::class, 'update']);
    Route::delete('jaksa', [JaksaController::class, 'destroy']);
});