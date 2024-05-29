<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyidikanController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('penyidikan', [PenyidikanController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('penyidikan', [PenyidikanController::class, 'store']);
    Route::put('penyidikan', [PenyidikanController::class, 'update']);
    Route::delete('penyidikan', [PenyidikanController::class, 'destroy']);

});