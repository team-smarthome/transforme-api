<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\DB;
use Exception;

class UserRoleController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = DB::select('SELECT * FROM user_role');
            //custom response
            return response()->json([
                'status' => 'OK',
                'message' => 'Successfully get data',
                'records' => $query
            ]);
        } catch(error) {
            return ApiResponse::error('Failed get data.', $e->getMessage());
        }
    }
}
