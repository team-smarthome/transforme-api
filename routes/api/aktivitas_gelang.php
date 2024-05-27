<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AktivitasGelangController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('aktivitas-gelang', [AktivitasGelangController::class, 'index']);
    Route::get('aktivitas-gelang/{id}', [AktivitasGelangController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('aktivitas-gelang', [AktivitasGelangController::class, 'store']);
    Route::put('aktivitas-gelang/{id}', [AktivitasGelangController::class, 'update']);
    Route::delete('aktivitas-gelang/{id}', [AktivitasGelangController::class, 'destroy']);
});