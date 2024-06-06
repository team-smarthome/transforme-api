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
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class UserController extends Controller
{
  public function login(UserLoginRequest $request): JsonResponse
  {
    $data = $request->validated();
    
    $data = $request->validated();
            $user = User::with(['role', 'petugas', 'lokasiLemasmil', 'lokasiOtmil'])
            ->whereNull('users.deleted_at')
            ->where('users.is_suspended', '0')
            ->whereHas('petugas', function($query) use ($data) {
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
      echo "e" . $userLog;
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
      echo "e2" . $userLog;
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

  public function index(Request $request)
  {
    try {
      if ($request->has('id')) {
        $user = User::findOrFail($request->id);
        return response()->json($user, 200);
      }
      if ($request->has('nama')) {
        $query = User::where('nama', 'like', '%' . $request->nama . '%')->latest();
      } else {
        $query = User::latest();
      }
      return ApiResponse::paginate($query);
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
      $id = $request->input('id');
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
      $id = $request->input('id');
      $user = User::findOrFail($id);
      $user->delete();

      return ApiResponse::deleted($user);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
