<?php
use App\Http\Controllers\KameraReadByLocationControoler;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dashboard', [KameraReadByLocationControoler::class, 'index']);
    Route::post('dashboard', [KameraReadByLocationControoler::class, 'store']);
    Route::put('dashboard', [KameraReadByLocationControoler::class, 'update']);
    Route::delete('dashboard', [KameraReadByLocationControoler::class, 'destroy']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
// });
