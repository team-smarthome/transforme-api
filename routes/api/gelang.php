<?php

use App\Http\Controllers\GelangController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('gelang', [GelangController::class, 'index']);
    Route::get('dashboard_gelang', [GelangController::class, 'dashboardGelang']);
    Route::post('gelang', [GelangController::class, 'store']);
    Route::put('gelang', [GelangController::class, 'update']);
    Route::delete('gelang', [GelangController::class, 'destroy']);
});

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('gelang', [GelangController::class, 'index']);
// });
?>
