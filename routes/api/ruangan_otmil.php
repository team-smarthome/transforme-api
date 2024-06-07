<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganOtmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('ruangan_otmil', [RuanganOtmilController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('ruangan_otmil', [RuanganOtmilController::class, 'store']);
    Route::put('ruangan_otmil', [RuanganOtmilController::class, 'update']);
    Route::delete('ruangan_otmil', [RuanganOtmilController::class, 'destroy']);

});