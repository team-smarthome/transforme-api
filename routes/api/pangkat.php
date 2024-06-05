<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PangkatController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
    Route::get('pangkat', [PangkatController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':operator,superadmin'])->group(function () {
    Route::get('pangkat', [PangkatController::class, 'index']);
    Route::post('pangkat', [PangkatController::class, 'store']);
});
