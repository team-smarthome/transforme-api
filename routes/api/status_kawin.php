<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusKawinController;

Route::get('status-kawin', [StatusKawinController::class, 'index']);
Route::post('status-kawin', [StatusKawinController::class, 'store']);
