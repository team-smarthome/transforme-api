<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisPidanaController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('jenis-pidana', [JenisPidanaController::class, 'index']);
    Route::get('jenis-pidana/{id}', [JenisPidanaController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('jenis-pidana', [JenisPidanaController::class, 'store']);
    Route::put('jenis-pidana/{id}', [JenisPidanaController::class, 'update']);
    Route::delete('jenis-pidana/{id}', [JenisPidanaController::class, 'destroy']);
});
