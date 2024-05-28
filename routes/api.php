<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\BidangKeahlianController;
use App\Http\Controllers\GedungLemasmilController;
use App\Http\Controllers\GedungOtmilController;
use App\Http\Controllers\JenisPidanaController;
use App\Http\Controllers\kesatuanController;
use App\Http\Controllers\LokasiKesatuanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\StatusKawinController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthSanctumMiddleware;
use App\Http\Controllers\TipeAsetController;
use App\Http\Controllers\LokasiOtmilController;
use App\Http\Controllers\StatusWbpKasusController;


// Load all routes in the 'api' folder dynamically
$routeFiles = glob(__DIR__ . '/api/*.php');


Route::post('login', [UserController::class, 'login']);
Route::get('tipe_aset', [TipeAsetController::class, 'index']);
Route::post('tipe_aset', [TipeAsetController::class, 'store']);
Route::get('tipe_aset/{id}', [TipeAsetController::class, 'show']);
Route::put('tipe_aset/{id}', [TipeAsetController::class, 'update']);
Route::delete('tipe_aset/{id}', [TipeAsetController::class, 'destroy']);
Route::get('lokasi_otmil', [LokasiOtmilController::class, 'index']);
Route::post('lokasi_otmil', [LokasiOtmilController::class, 'store']);
Route::get('lokasi_otmil/{id}', [LokasiOtmilController::class, 'show']);
Route::put('lokasi_otmil/{id}', [LokasiOtmilController::class, 'update']);
Route::delete('lokasi_otmil/{id}', [LokasiOtmilController::class, 'destroy']);

Route::apiResource('lokasi_otmil', LokasiOtmilController::class);
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/pangkat', [PangkatController::class, 'index']);
Route::post('/pangkat', [PangkatController::class, 'store']);

Route::get('/lokasi_kesatuan', [LokasiKesatuanController::class, 'index']);
Route::post('/lokasi_kesatuan', [LokasiKesatuanController::class, 'store']);

Route::get('/kesatuan', [kesatuanController::class, 'index']);
Route::post('/kesatuan', [kesatuanController::class, 'store']);

Route::get('/status_kawin', [StatusKawinController::class, 'index']);
Route::post('/status_kawin', [StatusKawinController::class, 'store']);

Route::get('/pendidikan', [PendidikanController::class, 'index']);
Route::post('/pendidikan', [PendidikanController::class, 'store']);

Route::get('/bidang_keahlian', [BidangKeahlianController::class, 'index']);
Route::post('/bidang_keahlian', [BidangKeahlianController::class, 'store']);

Route::get('/status-wbp-kasus', [StatusWbpKasusController::class, 'index']);
Route::post('/status-wbp-kasus', [StatusWbpKasusController::class, 'store']);

Route::get('/jenis_pidana', [JenisPidanaController::class, 'index']);
Route::post('/jenis_pidana', [JenisPidanaController::class, 'store']);

// Route::get('/gedung-otmil', [GedungOtmilController::class, 'index']);
// Route::post('/gedung-otmil', [GedungOtmilController::class, 'store']);
// Route::get('/gedung-otmil', [GedungOtmilController::class, 'show']);
// Route::put('/gedung-otmil', [GedungOtmilController::class, 'update']);
// Route::delete('/gedung-otmil', [GedungOtmilController::class, 'destroy']);

Route::get('/gedung_lemasmil', [GedungLemasmilController::class, 'index']);
Route::post('/gedung_lemasmil', [GedungLemasmilController::class, 'store']);
Route::get('/gedung_lemasmil', [GedungLemasmilController::class, 'show']);
Route::put('/gedung_lemasmil', [GedungLemasmilController::class, 'update']);
Route::delete('/gedung_lemasmil', [GedungLemasmilController::class, 'destroy']);
foreach ($routeFiles as $routeFile) {
    require $routeFile;
}
