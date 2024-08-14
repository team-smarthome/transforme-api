<?php
use App\Http\Controllers\DashboardSummaryController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;


// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dashboard', [DashboardSummaryController::class, 'index']);
    Route::post('dashboard', [DashboardSummaryController::class, 'store']);
    Route::put('dashboard', [DashboardSummaryController::class, 'update']);
    Route::delete('dashboard', [DashboardSummaryController::class, 'destroy']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('gedung_otmil', [GedungOtmilController::class, 'index']);
// });
