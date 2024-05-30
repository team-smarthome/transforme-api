<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganLemasmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('ruangan_lemasmil', [RuanganLemasmilController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('ruangan_lemasmil', [RuanganLemasmilController::class, 'store']);
    Route::put('ruangan_lemasmil', [RuanganLemasmilController::class, 'update']);
    Route::delete('ruangan_lemasmil', [RuanganLemasmilController::class, 'destroy']);

});