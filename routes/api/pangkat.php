<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PangkatController;

Route::get('pangkat', [PangkatController::class, 'index']);
Route::post('pangkat', [PangkatController::class, 'store']);