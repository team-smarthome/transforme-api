<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AktivitasPengunjungController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('aktivitas_pengunjung', [AktivitasPengunjungController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('aktivitas_pengunjung', [AktivitasPengunjungController::class, 'store']);
    Route::put('aktivitas_pengunjung', [AktivitasPengunjungController::class, 'update']);
    Route::delete('aktivitas_pengunjung', [AktivitasPengunjungController::class, 'destroy']);

});