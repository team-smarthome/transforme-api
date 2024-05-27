<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('agama', [AgamaController::class, 'index']);
    Route::get('agama/{id}', [AgamaController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('agama', [AgamaController::class, 'store']);
    Route::put('agama/{id}', [AgamaController::class, 'update']);
    Route::delete('agama/{id}', [AgamaController::class, 'destroy']);
});