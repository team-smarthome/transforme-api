<?php

use App\Http\Controllers\GedungOtmilController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('gedung-otmil', [GedungOtmilController::class, 'index']);
    Route::post('gedung-otmil', [GedungOtmilController::class, 'store']);
    Route::put('gedung-otmil', [GedungOtmilController::class, 'update']);
    Route::delete('gedung-otmil', [GedungOtmilController::class, 'destroy']);
});

Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
    Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
});
