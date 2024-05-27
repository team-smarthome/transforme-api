<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengadilanMiliterController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('pengadilan_militer', [PengadilanMiliterController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('pengadilan_militer', [PengadilanMiliterController::class, 'store']);
    Route::put('pengadilan_militer', [PengadilanMiliterController::class, 'update']);
    Route::delete('pengadilan_militer', [PengadilanMiliterController::class, 'destroy']);

});