
<?php

use App\Http\Controllers\DesktopController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_desktop_dummy', [DesktopController::class, 'getDummyData']);
// });
?>
