<?php

use App\Http\Controllers\AksesRuanganController;
use Illuminate\Support\Facades\Route;

Route::get('akses-ruangan', [AksesRuanganController::class, 'index']);

