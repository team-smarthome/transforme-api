<?php
use App\Http\Controllers\IndoorMapController2;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('indoor_mapV3', [IndoorMapController2::class, 'index']);
    Route::post('indoor_map', [IndoorMapController2::class, 'store']);
    Route::put('indoor_map', [IndoorMapController2::class, 'update']);
    Route::delete('indoor_map', [IndoorMapController2::class, 'destroy']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
// });
