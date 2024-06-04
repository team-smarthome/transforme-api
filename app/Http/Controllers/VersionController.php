<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Version;
use App\Helpers\ApiResponse;
use Exception;

class VersionController extends Controller
{
    public function index()
    {
        try {
            $query = Version::latest();
            return ApiResponse::paginate($query);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }
}
