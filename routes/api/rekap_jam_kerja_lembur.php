<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapJamKerjaLemburController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('rekap_jam_kerja_lembur', [RekapJamKerjaLemburController::class, 'index']);
// });