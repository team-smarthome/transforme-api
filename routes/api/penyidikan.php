<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakimController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('hakim', [HakimController::class, 'index']);
    Route::post('hakim', [HakimController::class, 'store']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('hakim', [HakimController::class, 'store']);
    Route::put('hakim', [HakimController::class, 'update']);
    Route::delete('hakim', [HakimController::class, 'destroy']);

});