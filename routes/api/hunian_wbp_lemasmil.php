<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HunianWbpLemasmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('hunian_wbp_lemasmil', [HunianWbpLemasmilController::class, 'index']);
    // Route::get('hunian_wbp_lemasmil/{id}', [HunianWbpLemasmilController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('hunian_wbp_lemasmil', [HunianWbpLemasmilController::class, 'store']);
    Route::put('hunian_wbp_lemasmil', [HunianWbpLemasmilController::class, 'update']);
    Route::delete('hunian_wbp_lemasmil', [HunianWbpLemasmilController::class, 'destroy']);
});