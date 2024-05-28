<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HunianWbpOtmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('hunian-wbp-otmil', [HunianWbpOtmilController::class, 'index']);
    // Route::get('hunian-wbp-otmil/{id}', [HunianWbpOtmilController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('hunian-wbp-otmil', [HunianWbpOtmilController::class, 'store']);
    Route::put('hunian-wbp-otmil', [HunianWbpOtmilController::class, 'update']);
    Route::delete('hunian-wbp-otmil', [HunianWbpOtmilController::class, 'destroy']);
});