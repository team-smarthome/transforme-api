<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiLemasmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('lokasi_lemasmil', [LokasiLemasmilController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('lokasi_lemasmil', [LokasiLemasmilController::class, 'store']);
    Route::put('lokasi_lemasmil', [LokasiLemasmilController::class, 'update']);
    Route::delete('lokasi_lemasmil', [LokasiLemasmilController::class, 'destroy']);
});