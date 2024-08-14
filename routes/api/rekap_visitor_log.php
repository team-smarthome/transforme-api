<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapVisitorLogController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('rekap_visitor_log', [RekapVisitorLogController::class, 'index']);
});