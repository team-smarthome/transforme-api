<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusKawinController;

Route::get('status_kawin', [StatusKawinController::class, 'index']);
Route::post('status_kawin', [StatusKawinController::class, 'store']);

