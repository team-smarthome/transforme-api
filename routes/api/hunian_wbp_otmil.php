<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HunianWbpOtmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('hunian_wbp_otmil', [HunianWbpOtmilController::class, 'index']);
    // Route::get('hunian_wbp_otmil/{id}', [HunianWbpOtmilController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('hunian_wbp_otmil', [HunianWbpOtmilController::class, 'store']);
    Route::put('hunian_wbp_otmil', [HunianWbpOtmilController::class, 'update']);
    Route::delete('hunian_wbp_otmil', [HunianWbpOtmilController::class, 'destroy']);
});