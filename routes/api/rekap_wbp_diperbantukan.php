<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapWbpDiperbantukan;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('rekap_wbp_diperbantukan', [RekapWbpDiperbantukan::class, 'index']);
});