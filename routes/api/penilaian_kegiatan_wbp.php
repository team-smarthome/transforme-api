<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenilaianKegiatanWbpController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('rekap_absen_kegiatan', [PenilaianKegiatanWbpController::class, 'index']);
});