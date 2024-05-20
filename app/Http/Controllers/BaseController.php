<?php

namespace App\Http\Controllers;

use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BaseController extends Controller
{
  /**
   * get auth users id from table employees .
   */
  public function authUser()
  {
    $user = auth()->user()->employee;
    return $user;
  }

  /**
   * wrap a result into json response.
   */
  public function wrapResponse(int $code, string $message, ?array $resource = []): JsonResponse
  {
    $result = [
      'code' => $code,
      'message' => $message
    ];

    if (count($resource)) {
      $result = array_merge($result, ['records' => $resource['data']]);

      if (count($resource) > 1)
        $result = array_merge($result, ['pages' => ['links' => $resource['links'], 'meta' => $resource['meta']]]);
    }

    return response()->json($result, $code);
  }

  /**
   * Throw the error if proccess is failed.
   */
  public function throwError($code, $message = ''): void
  {
    throw new ErrorException($message, $code);
  }

  /**
   * Throw the error if proccess is forbidden.
   */
  public function forbiddenAccess(): void
  {
    throw new ErrorException(__('message.forbidden_access'), Response::HTTP_FORBIDDEN);
  }
}