<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GatewayLogController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('gateway_log', [GatewayLogController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('gateway_log', [GatewayLogController::class, 'store']);
    Route::put('gateway_log', [GatewayLogController::class, 'update']);
    Route::delete('gateway_log', [GatewayLogController::class, 'destroy']);

});