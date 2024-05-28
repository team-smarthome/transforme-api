<?php

use App\Http\Controllers\GedungLemasmilController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('gedung-lemasmil', [GedungLemasmilController::class, 'index']);
    Route::post('gedung-lemasmil', [GedungLemasmilController::class, 'store']);
    Route::get('gedung-lemasmil', [GedungLemasmilController::class, 'show']);
    Route::put('gedung-lemasmil', [GedungLemasmilController::class, 'update']);
    Route::delete('gedung-lemasmil', [GedungLemasmilController::class, 'destroy']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
//     Route::get('gedung_otmil', [GedungOtmilController::class, 'show']);
// });
