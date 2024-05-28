<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('shift', [ShiftController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('shift', [ShiftController::class, 'store']);
    Route::put('shift', [ShiftController::class, 'update']);
    Route::delete('shift', [ShiftController::class, 'destroy']);

});