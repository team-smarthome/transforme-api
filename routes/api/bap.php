<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BapController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('bap', [BapController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('bap', [BapController::class, 'store']);
    Route::put('bap', [BapController::class, 'update']);
    Route::delete('bap', [BapController::class, 'destroy']);

});