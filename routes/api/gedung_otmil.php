<?php

use App\Http\Controllers\GedungOtmilController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
    Route::post('gedung_otmil', [GedungOtmilController::class, 'store']);
    Route::put('gedung_otmil', [GedungOtmilController::class, 'update']);
    Route::delete('gedung_otmil', [GedungOtmilController::class, 'destroy']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
// });
