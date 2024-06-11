<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GatewayController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('dashboard_gateway', [GatewayController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('gateway', [GatewayController::class, 'store']);
    Route::put('gateway', [GatewayController::class, 'update']);
    Route::delete('gateway', [GatewayController::class, 'destroy']);

});
