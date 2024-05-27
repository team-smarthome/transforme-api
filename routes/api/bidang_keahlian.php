<?php

use App\Http\Controllers\BidangKeahlianController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AuthSanctumMiddleware::class . ':admin,superadmin')->group(function() {
    Route::get('bidang_keahlian', [BidangKeahlianController::class, 'index']);
    Route::post('bidang_keahlian', [BidangKeahlianController::class, 'store']);
});

Route::middleware(AuthSanctumMiddleware::class . ':operator')->group(function() {
    Route::get('bidang_keahlian', [BidangKeahlianController::class, 'index']);
});
?>
