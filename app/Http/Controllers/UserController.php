<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\LokasiOtmil;
use App\Models\LokasiLemasmil;
use App\Models\Petugas;
use App\Models\UserLog;
use App\Models\UserRole;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Dokumentasi API",
 *      description="Lorem Ipsum",
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * 
 * )
 *
 * @OA\Server(
 *      url="http://localhost:8000",
 *      description="Demo API Server"
 * )
 */
class UserController extends Controller
{
  /**
   * @OA\Post(
   *     path="/api/login",
   *     tags={"Login"},
   *     operationId="login",
   *     summary="Login",
   *     description="User login",
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"nrp", "password"},
   *             @OA\Property(property="nrp", type="string", example="1234567890"),
   *             @OA\Property(property="password", type="string", example="test1234")
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="User authenticated successfully",
   *         @OA\JsonContent(
   *             example={
   *                 "status": "success",
   *                 "message": "User authenticated successfully",
   *                 "user": {
   *                     "user_id": "f9c91240-d833-4f17-928d-c73c3edcc30b",
   *                     "role_name": "superadmin",
   *                     "petugas_id": "873313dd-863a-48f1-a09a-d113e26632b1",
   *                     "nama_petugas": "Udin",
   *                     "email": "udin@gmail.com",
   *                     "phone": "08123123123",
   *                     "image": "http",
   *                     "last_login": "2024-06-07 17:38:05",
   *                     "nama_lokasi_lemasmil": "Jakarta Lemasmil",
   *                     "nama_lokasi_otmil": "Jakarta Otmil",
   *                     "lokasi_lemasmil_id": "48633be0-b005-4029-8bbb-293db9564ba0",
   *                     "lokasi_otmil_id": "890cc9b1-b01f-4d1f-9075-a6a96e851b25",
   *                     "expiry_date": "2024-06-07"
   *                 },
   *                 "auth": {
   *                     "token": "2|scnpQnj8PgId9HqYC0GqjccF25OiqAzABYrIP5ni979f0656",
   *                     "token_expiry": "2024-06-11T04:27:57.919289Z",
   *                     "token_type": "Bearer"
   *                 }
   *             }
   *         )
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="Invalid credentials",
   *         @OA\JsonContent(
   *             example={
   *                 "status": "error",
   *                 "message": "Invalid credentials"
   *             }
   *         )
   *     )
   * )
   */
  public function login(UserLoginRequest $request): JsonResponse
  {
    $data = $request->validated();

    $data = $request->validated();
    $user = User::with(['role', 'petugas', 'lokasiLemasmil', 'lokasiOtmil'])
      ->whereNull('users.deleted_at')
      ->where('users.is_suspended', false)
      ->whereHas('petugas', function ($query) use ($data) {
        $query->where('nrp', $data['nrp']);
      })
      ->first();

    // $user = User::select(
    //   'users.id',
    //   'users.username',
    //   'users.email',
    //   'users.phone',
    //   'users.petugas_id',
    //   'users.last_login',
    //   'users.expiry_date',
    //   'users.lokasi_lemasmil_id',
    //   'users.lokasi_otmil_id',
    //   'lokasi_lemasmil.nama_lokasi_lemasmil AS nama_lokasi_lemasmil',
    //   'lokasi_otmil.nama_lokasi_otmil AS nama_lokasi_otmil',
    //   'user_role.role_name',
    //   'petugas.nama',
    //   'petugas.nrp',
    //   'petugas.foto_wajah',
    //   'users.password'
    // )
    //   ->leftJoin('user_role', 'users.user_role_id', '=', 'user_role.id')
    //   ->leftJoin('lokasi_lemasmil', 'users.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
    //   ->leftJoin('lokasi_otmil', 'users.lokasi_otmil_id', '=', 'lokasi_otmil.id')
    //   ->leftJoin('petugas', 'users.petugas_id', '=', 'petugas.id')
    //   ->where('users.deleted_at', null)
    //   ->where('users.is_suspended', '0')
    //   ->where('petugas.nrp', $data['nrp'])
    //   ->first();

    if (!$user) {
      $userLog = new UserLog();
      $userLog->nama_user_log = 'gagal nrp';
      $userLog->timestamp = now();
      $userLog->user_id = $user ? $user->id : null;
      // echo "e" . $userLog;
      $userLog->save();
      throw new HttpResponseException(response([
        'status' => 'error',
        'message' => 'Nrp not found',
        'data' => 'Invalid credentials'
      ], JsonResponse::HTTP_UNAUTHORIZED));
    } else if (!Hash::check($data['password'], $user->password)) {

      $userLog = new UserLog();
      $userLog->nama_user_log = 'gagal password';
      $userLog->timestamp = now();
      $userLog->user_id = $user->id;
      $userLog->save();
      // echo "e2" . $userLog;
      throw new HttpResponseException(response([
        'status' => 'error',
        'message' => 'Password not match',
        'data' => 'Invalid credentials'
      ], JsonResponse::HTTP_UNAUTHORIZED));
    }
    //  $token = $user->createToken('auth_token')->plainTextToken;
    $token = $user->createToken(
      'auth_token',
      ['*'],
      Carbon::now()->addDays(1)
    )->plainTextToken;
    $expiryToken = Carbon::now()->addDays(1);
    // $expiryToken =  expires_at itu di sanchtum laravel ditambah 1 hari
    // $expiryToken = $user->tokens()->first()->expires_at->addDay()


    // Menyimpan data login ke dalam tabel user_log
    $userLog = new UserLog(); // Buat instance dari model UserLog
    $userLog->nama_user_log = 'success'; // Ambil dari username pengguna
    $userLog->timestamp = $user->last_login; // Ambil dari waktu terakhir login pengguna
    $userLog->user_id = $user->id; // Ambil ID pengguna
    $userLog->save();
    return response()->json([
      'status' => 'success',
      'message' => 'User authenticated successfully',
      'user' => new LoginResource($user),
      'auth' => [
        'token' => $token,
        'token_expiry' => $expiryToken,
        'token_type' => 'Bearer',
      ]
    ], JsonResponse::HTTP_OK);

    // if($user->is)
  }

  /**
   * @OA\Get(
   *     path="/api/users",
   *     tags={"User"},
   *     operationId="User Read Data",
   *     summary="User Read Data",
   *     description="Read users Data",
   *     security={
   *        {"token": {}}
   *     },
   *     @OA\RequestBody(
   *         required=false,
   *         @OA\JsonContent(
   *             required={"user_id", "nama", "page", "pageSize", "filter"},
   *             @OA\Property(property="user_id", type="string", example="f9c91240-d833-4f17-928d-c73c3edcc30b"),
   *             @OA\Property(property="nama", type="string", example="Udin"),
   *             @OA\Property(property="page", type="integer", example=1),
   *             @OA\Property(property="pageSize", type="integer", example=10),
   *             @OA\Property(property="filter", type="object", example={"user_id": "f9c91240-d833-4f17-928d-c73c3edcc30b", "nama": "Udin"})
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="User created successfully",
   *         @OA\JsonContent(
   *             example={
   *                 "status": "success",
   *                 "message": "User created successfully",
   *                 "records": {
   *                     "user_id": "f9c91240-d833-4f17-928d-c73c3edcc30b",
   *                     "nama": "Udin",
   *                     "expiry_date": "2024-06-07",
   *                     "username": "udin",
   *                     "image": "udin.jpg",
   *                     "phone": "08123123123",
   *                     "email": "udin@gmail.com",
   *                     "is_suspended": 0,
   *                     "petugas_id": "873313dd-863a-48f1-a09a-d113e26632b1",
   *                     "user_role_id": "f1943be9-e062-4815-9a1c-613b1b2260e2",
   *                     "role_name": "superadmin",
   *                     "deskripsi_role": "Insert, Read, Update, Delete, and User Modification Access Rights",
   *                     "nama_lokasi_otmil": "Jakarta Otmil",
   *                     "nama_lokasi_lemasmil": "Jakarta Lemasmil",
   *                     "lokasi_otmil_id": "890cc9b1-b01f-4d1f-9075-a6a96e851b25",
   *                     "lokasi_lemasmil_id": "48633be0-b005-4029-8bbb-293db9564ba0",
   *                     "last_login": "2024-06-07 17:38:05",
   *                     "jabatan": "Jendral",
   *                     "divisi": "Military",
   *                     "nama_matra": "Navy",
   *                     "nrp": "1234567890"
   *                 }
   *             }
   *         )
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="Unauthorized",
   *         @OA\JsonContent(
   *             example={
   *                 "status": "error",
   *                 "message": "Unauthorized"
   *             }
   *         )
   *     )
   * )
   */

  public function index(Request $request)
  {
    try {

      $query = User::with(['role', 'petugas', 'lokasiLemasmil', 'lokasiOtmil']);
      $filterableColumns = [
        'user_id' => 'id',
        'user_role_id' => 'user_role_id',
        'username' => 'username',
        'lokasi_otmil_id' => 'lokasi_otmil_id',
      ];
      foreach ($filterableColumns as $requestKey => $column) {
        if ($request->has($requestKey)) {
          $query->where($column, 'ilike', '%' . $request->input($requestKey) . '%');
        }
      }

      if ($request->has('nama')) {
        $query->whereHas('petugas', function ($q) use ($request) {
          $q->where('nama', 'ilike', '%' . $request->input('nama') . '%');
        });
      };

      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

      $resourceCollection = UserResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection);
      // if ($request->has('id')) {
      //   $user = User::findOrFail($request->id);
      //   return response()->json($user, 200);
      // }
      // if ($request->has('nama')) {
      //   $query = User::where('nama', 'ilike', '%' . $request->nama . '%')->latest();
      // } else {
      //   $query = User::latest();
      // }
      // return ApiResponse::paginate($query);
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }

  public function store(UserRequest $request)
  {
    try {
      $data = $request->validated();
      if ($request->hasFile('image')) {
        $path = Storage::putFile('user_image', $request->file('image'));

        $data['image'] = 'storage/' . str_replace('public/', '', $path);
      }
      if (isset($data['password'])) {
        $data['password'] = Hash::make($data['password']);
      }
      $user = User::create($data);
      return ApiResponse::created($user);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }

  public function edit(UserRequest $request)
  {
    try {
      $id = $request->input('user_id');
      $user = User::findOrFail($id);
      $data = $request->validated();

      if ($request->hasFile('image')) {
        if ($user->image) {
          Storage::delete(str_replace('storage/', 'public/', $user->image));
        }

        $path = Storage::putFile('user_image', $request->file('image'));
        // Simpan path dengan format yang diinginkan
        $data['image'] = 'storage/' . str_replace('public/', '', $path);
      }
      if (isset($data['password'])) {
        $data['password'] = Hash::make($data['password']);
      }
      $user->update($data);
      return ApiResponse::updated($user);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
  public function destroy(Request $request)
  {
    try {
      $id = $request->input('user_id');
      $user = User::findOrFail($id);
      $user->delete();

      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
