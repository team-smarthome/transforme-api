
<?php

use App\Http\Controllers\FaceRecController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_face_rec_dummy', [FaceRecController::class, 'getDummyData']);
// });
?>
