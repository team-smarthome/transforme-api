<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OditurPenuntutController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('oditur_penuntut', [OditurPenuntutController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('oditur_penuntut', [OditurPenuntutController::class, 'store']);
    Route::put('oditur_penuntut', [OditurPenuntutController::class, 'update']);
    Route::delete('oditur_penuntut', [OditurPenuntutController::class, 'destroy']);

});