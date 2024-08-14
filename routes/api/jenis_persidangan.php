<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisPersidanganController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('jenis_persidangan', [JenisPersidanganController::class, 'index']);
    // Route::get('jenis-persidangan/{id}', [JenisPersidanganController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('jenis_persidangan', [JenisPersidanganController::class, 'store']);
    Route::put('jenis_persidangan', [JenisPersidanganController::class, 'update']);
    Route::delete('jenis_persidangan', [JenisPersidanganController::class, 'destroy']);
});