<?php
use App\Http\Controllers\IndoorMapController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('indoor_map', [IndoorMapController::class, 'index']);
    Route::post('indoor_map', [IndoorMapController::class, 'store']);
    Route::put('indoor_map', [IndoorMapController::class, 'update']);
    Route::delete('indoor_map', [IndoorMapController::class, 'destroy']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
// });
