<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HunianWbpLemasmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('hunian-wbp-lemasmil', [HunianWbpLemasmilController::class, 'index']);
    // Route::get('hunian-wbp-lemasmil/{id}', [HunianWbpLemasmilController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('hunian-wbp-lemasmil', [HunianWbpLemasmilController::class, 'store']);
    Route::put('hunian-wbp-lemasmil', [HunianWbpLemasmilController::class, 'update']);
    Route::delete('hunian-wbp-lemasmil', [HunianWbpLemasmilController::class, 'destroy']);
});