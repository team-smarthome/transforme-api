<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LantaiLemasmilController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('lantai_lemasmil', [LantaiLemasmilController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('lantai_lemasmil', [LantaiLemasmilController::class, 'store']);
    Route::put('lantai_lemasmil', [LantaiLemasmilController::class, 'update']);
    Route::delete('lantai_lemasmil', [LantaiLemasmilController::class, 'destroy']);

});