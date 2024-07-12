
<?php

use App\Http\Controllers\DummyCameraIndoormap;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_camera_dummy', [DummyCameraIndoormap::class, 'getDummyData']);
// });
?>
