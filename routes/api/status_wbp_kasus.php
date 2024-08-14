<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusWbpKasusController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('status_wbp_kasus', [StatusWbpKasusController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('status_wbp_kasus', [StatusWbpKasusController::class, 'store']);
    Route::put('status_wbp_kasus', [StatusWbpKasusController::class, 'update']);
    Route::delete('status_wbp_kasus', [StatusWbpKasusController::class, 'destroy']);

});