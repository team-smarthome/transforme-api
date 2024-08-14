<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasusController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('kasus', [KasusController::class, 'index']);
    // Route::get('kasus/{id}', [KasusController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('kasus', [KasusController::class, 'store']);
    Route::put('kasus', [KasusController::class, 'update']);
    Route::delete('kasus', [KasusController::class, 'destroy']);
});