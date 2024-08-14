<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoriPenyidikanController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('histori_penyidikan', [HistoriPenyidikanController::class, 'index']);
    Route::post('histori_penyidikan', [HistoriPenyidikanController::class, 'store']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('histori_penyidikan', [HistoriPenyidikanController::class, 'store']);
    Route::put('histori_penyidikan', [HistoriPenyidikanController::class, 'update']);
    Route::delete('histori_penyidikan', [HistoriPenyidikanController::class, 'destroy']);

});