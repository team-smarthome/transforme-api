<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OditurPenyidikController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('oditur_penyidik', [OditurPenyidikController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('oditur_penyidik', [OditurPenyidikController::class, 'store']);
    Route::put('oditur_penyidik', [OditurPenyidikController::class, 'update']);
    Route::delete('oditur_penyidik', [OditurPenyidikController::class, 'destroy']);

});