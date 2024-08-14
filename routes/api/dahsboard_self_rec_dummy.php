
<?php

use App\Http\Controllers\SelfRegDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_self_rec_dummy', [SelfRegDashboardController::class, 'getDummyData']);
// });
?>
