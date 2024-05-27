<?php

use App\Http\Controllers\JenisPidanaController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('jenis-pidana', [JenisPidanaController::class, 'index']);
    Route::post('jenis-pidana', [JenisPidanaController::class, 'store']);
});

Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
    Route::get('jenis-pidana', [JenisPidanaController::class, 'index']);
});
