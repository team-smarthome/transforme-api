<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidangKeahlianController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('bidang-keahlian', [BidangKeahlianController::class, 'index']);
    // Route::get('bidang-keahlian/{id}', [BidangKeahlianController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('bidang-keahlian', [BidangKeahlianController::class, 'store']);
    Route::put('bidang-keahlian', [BidangKeahlianController::class, 'update']);
    Route::delete('bidang-keahlian', [BidangKeahlianController::class, 'destroy']);
});