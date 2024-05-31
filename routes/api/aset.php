<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('aset', [AsetController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('aset', [AsetController::class, 'store']);
    Route::put('aset', [AsetController::class, 'update']);
    Route::delete('aset', [AsetController::class, 'destroy']);

});