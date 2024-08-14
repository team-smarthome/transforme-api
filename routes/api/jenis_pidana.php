<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisPidanaController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
    Route::get('jenis_pidana', [JenisPidanaController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('jenis_pidana', [JenisPidanaController::class, 'index']);
    Route::post('jenis_pidana', [JenisPidanaController::class, 'store']);
    Route::put('jenis_pidana', [JenisPidanaController::class, 'update']);
    Route::delete('jenis_pidana', [JenisPidanaController::class, 'destroy']);
});
