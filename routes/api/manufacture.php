<?php
use App\Http\Controllers\MstManufacturerController;
use Illuminate\Support\Facades\Route;

Route::get('manufacture', [MstManufacturerController::class, 'index']);
Route::post('manufacture', [MstManufacturerController::class, 'store']);
Route::put('manufacture', [MstManufacturerController::class, 'update']);
Route::delete('manufacture', [MstManufacturerController::class, 'destroy']);
?>
