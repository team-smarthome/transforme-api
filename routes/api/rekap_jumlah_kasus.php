<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapJumlahKasusController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('rekap_jumlah_kasus', [RekapJumlahKasusController::class, 'index']);
});