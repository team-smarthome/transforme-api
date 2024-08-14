<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VersionController;
use App\Http\Middleware\AuthSanctumMiddleware;

    Route::get('version', [VersionController::class, 'index']);
