<?php

use App\Http\Controllers\KameraTersimpanController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('kamera_tersimpan', [KameraTersimpanController::class, 'index']);
    Route::post('kamera_tersimpan', [KameraTersimpanController::class, 'store']);
    Route::put('kamera_tersimpan', [KameraTersimpanController::class, 'update']);
    Route::delete('kamera_tersimpan', [KameraTersimpanController::class, 'destroy']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
// });
