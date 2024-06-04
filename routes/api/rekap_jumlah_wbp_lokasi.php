<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapJumlahWbpLokasi;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('rekap_jumlah_wbp_lokasi', [RekapJumlahWbpLokasi::class, 'index']);
});