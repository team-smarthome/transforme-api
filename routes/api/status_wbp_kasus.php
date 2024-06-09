<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;
use App\Http\Controllers\StatusWbpKasusController;

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('status_wbp_kasus', [StatusWbpKasusController::class, 'index']);
    Route::post('status_wbp_kasus', [StatusWbpKasusController::class, 'store']);
});

Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
    Route::get('status_wbp_kasus', [StatusWbpKasusController::class, 'index']);
});
?>