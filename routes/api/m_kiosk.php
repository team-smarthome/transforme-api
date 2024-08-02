<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MkioskController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('m_kiosk', [MkioskController::class, 'index']);

// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('m_kiosk', [MkioskController::class, 'store']);
    Route::put('m_kiosk', [MkioskController::class, 'update']);
    Route::delete('m_kiosk', [MkioskController::class, 'destroy']);
// });
