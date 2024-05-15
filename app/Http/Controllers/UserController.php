<?php

namespace App\Http\Controllers;

use ErrorException;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Svg\Tag\Rect;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
  private const
    CREATE_SUCCESS = "Data user berhasil dibuat",
    UPDATE_SUCCESS = "Data user berhasil diubah",
    DELETE_SUCCESS = "Data user berhasil dihapus",
    RESET_PASSWORD_SUCCESS = "Password berhasil direset",
    SUCCESS = "Success",
    FAILED = "Failed to get service, please try again.";

  public static $DEFAULT_PASSWORD = "password";

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $user_management = User::query();




    if ($request->query("not-paginate"))
      $user_management = $user_management->get();
    else
      $user_management = $user_management
        ->paginate($request->recordsPerPage)
        ->appends(request()->query());

    $result = UserResource::collection($user_management)
      ->response()
      ->getData(true);

    return $this->wrapResponse(Response::HTTP_OK, self::SUCCESS, $result);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreUserRequest $request): JsonResponse
  {
    try {
      $data = $request->validated();
      $roles = Arr::pull($data, 'roles');
      $nip = Arr::pull($data, 'nip');

      if (!$user_management = User::create($data)) $this->throwError();

      $user_management->roles()
        ->attach($roles);
      $name = $user_management->employee->name;

      $user_management = (new UserResource($user_management->load(['roles', 'employee' => ['instansi', 'jobTitles' => ['deputy', 'workUnit', 'workUnitEselon3', 'workUnitEselon4']]])))
        ->response()
        ->getData(true);


      return $this->wrapResponse(Response::HTTP_CREATED, self::CREATE_SUCCESS, $user_management);
    } catch (ErrorException $e) {
      throw $e;
    }

    // Remove the line below to fix the issue of unreachable code
    // $this->throwError();
  }


  /**
   * Display the specified resource.
   */
  // public function show(User $user_management)
  public function show(User $user_management): JsonResponse
  {
    // return $user_management;
    $user_management = (new UserResource($user_management->load(['roles', 'employee' => ['instansi', 'jobTitles']])))
      ->response()
      ->getData(true);

    return $this->wrapResponse(Response::HTTP_OK, self::SUCCESS, $user_management);
  }

  /**
   * Get Keycloak Users
   */
  
  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateUserRequest $request, User $user_management): JsonResponse
  {
    try {
      $data = $request->validated();
      $roles = Arr::pull($data, 'roles');

      $user_management->roles()
        ->sync($roles);

      $user_management = (new UserResource($user_management->load(['roles', 'employee' => ['instansi', 'jobTitles']])))
        ->response()
        ->getData(true);

      return $this->wrapResponse(Response::HTTP_OK, self::UPDATE_SUCCESS, $user_management);
    } catch (ErrorException $e) {
      throw $e;
    }
  }



  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user_management)
  {
    if ($user_management->delete()) {
      $user_management->update(['deleted_by' => auth()->user()->id]);
      return $this->wrapResponse(Response::HTTP_OK, self::DELETE_SUCCESS);
    }

    $this->throwError();
  }



  /**
   * query get a user by nip.
   */
  public function getUserByNip(string $nip): ?User
  {
    return User::whereHas('employee', fn ($query) => $query->where('nip', $nip))
      ->first();
  }

  public function updateSuspend(Request $request)
  {
    $user = User::findOrFail($request->input('id'));

    $user->update([
    //   'is_suspend' => false,
      'counter_suspend' => 0
    ]);

    return response()->json([
      'code' => 200,
      'message' => 'Status suspend berhasil diperbarui'
    ]);
  }

  /**
   * wrap a result into json response.
   */
  private function wrapResponse(int $code, string $message, ?array $resource = []): JsonResponse
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
  private function throwError(): void
  {
    throw new ErrorException(self::FAILED, Response::HTTP_INTERNAL_SERVER_ERROR);
  }
}
