<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AhliController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('ahli', [AhliController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('ahli', [AhliController::class, 'store']);
    Route::put('ahli', [AhliController::class, 'update']);
    Route::delete('ahli', [AhliController::class, 'destroy']);
});