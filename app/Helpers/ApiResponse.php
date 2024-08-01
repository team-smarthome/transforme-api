<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResponse
{
  public static $defaultPagination = 30;

  public static function success($data = [], $message = 'Successfully get Data')
  {
    return response()->json([
      'status' => 'OK',
      'message' => $message,
      'records' => $data
    ], 200);
  }

  public static function error($message = 'Failed to get Data.', $error = null, $statusCode = 500)
  {
    return response()->json([
      'status' => 'NO',
      'message' => $message,
      'error' => $error
    ], $statusCode);
  }

  public static function pagination($collection, $message = 'Successfully get Data')
  {
    // Check if the collection is empty
    if ($collection->isEmpty()) {
      return self::success([], 'Data not found.');
    }

    // Prepare pagination data
    $paginationData = [
      'currentPage' => $collection->currentPage(),
      'pageSize' => $collection->perPage(),
      'from' => $collection->firstItem(),
      'to' => $collection->lastItem(),
      'totalRecords' => $collection->total(),
      'totalPages' => $collection->lastPage(),
    ];

    return response()->json([
      'status' => 'OK',
      'message' => $message,
      'records' => $collection->items(),
      'pagination' => $paginationData,
    ], 200);
  }

  public static function paginate($query, $max_data = null, $message = 'Successfully get Data')
  {
    $max_data = request()->input('pageSize', $max_data ?? self::$defaultPagination);
    $collection = $query->paginate($max_data);
    return self::pagination($collection, $message);
  }

  public static function created($data = [], $message = 'Successfully created Data')
  {
    return response()->json([
      'status' => 'OK',
      'message' => $message,
      'data' => $data
    ], 201);
  }

  public static function updated($data = [], $message = 'Successfully updated Data')
  {
    return response()->json([
      'status' => 'OK',
      'message' => $message,
      'data' => $data
    ], 200);
  }

  public static function deleted($message = 'Successfully deleted Data')
  {
    return response()->json([
      'status' => 'OK',
      'message' => $message
    ], 200);
  }

  public static function notFound($message = 'Data not found')
  {
    return response()->json([
      'status' => 'NO',
      'message' => $message
    ], 404);
  }

  public static function unauthorized($message = 'Unauthorized')
  {
    return response()->json([
      'status' => 'NO',
      'message' => $message
    ], 401);
  }

  public static function forbidden($message = 'Forbidden')
  {
    return response()->json([
      'status' => 'NO',
      'message' => $message
    ], 403);
  }
}
