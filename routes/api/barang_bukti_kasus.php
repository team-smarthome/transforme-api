<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangBuktiKasusController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('barang_bukti_kasus', [BarangBuktiKasusController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('barang_bukti_kasus', [BarangBuktiKasusController::class, 'store']);
    Route::put('barang_bukti_kasus', [BarangBuktiKasusController::class, 'update']);
    Route::delete('barang_bukti_kasus', [BarangBuktiKasusController::class, 'destroy']);

});