<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatfromController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('platform', [PlatfromController::class, 'index']);
    Route::get('platform/{id}', [PlatfromController::class, 'show']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('platform', [PlatfromController::class, 'store']);
    Route::put('platform/{id}', [PlatfromController::class, 'update']);
    Route::delete('platform/{id}', [PlatfromController::class, 'destroy']);
// });