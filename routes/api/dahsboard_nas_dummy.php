
<?php

use App\Http\Controllers\NasDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_nas_dummy', [NasDashboardController::class, 'getDummyData']);
// });
?>
