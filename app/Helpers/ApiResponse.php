<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class ApiResponse
{
    protected static $defaultPagination = 10;

    public static function success($data = [], $message = 'Successfully get Data')
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public static function error($message = 'Failed to get Data.', $error = null, $statusCode = 500)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'error' => $error
        ], $statusCode);
    }

    public static function pagination(LengthAwarePaginator $collection, $message = 'Successfully get Data')
    {
        if ($collection->isEmpty()) {
            return self::success([], 'Data not found.');
        }

        $responseData = [
            'data' => $collection->items(),
            'current_page' => $collection->currentPage(),
            'per_page' => $collection->perPage(),
            'to' => $collection->lastItem(),
            'total' => $collection->total(),
        ];

        return self::success($responseData, $message);
    }

    public static function paginate($query, $max_data = null, $message = 'Successfully get Data')
    {
        $max_data = $max_data ?? self::$defaultPagination;
        $collection = $query->paginate($max_data);
        return self::pagination($collection, $message);
    }
    public static function created($data = [], $message = 'Successfully created Data')
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 201);
    }

    public static function updated($data = [], $message = 'Successfully updated Data')
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public static function deleted($message = 'Successfully deleted Data')
    {
        return response()->json([
            'status' => 'success',
            'message' => $message
        ], 200);
    }
}
