<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiOtmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('lokasi_otmil', [LokasiOtmilController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('lokasi_otmil', [LokasiOtmilController::class, 'store']);
    Route::put('lokasi_otmil', [LokasiOtmilController::class, 'update']);
    Route::delete('lokasi_otmil', [LokasiOtmilController::class, 'destroy']);
});
