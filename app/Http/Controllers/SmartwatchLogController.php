<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\SmartwatchLogResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmartwatchLogController extends Controller
{
  public function index(Request $request)
  {

    $pageSize = $request->input('pageSize', ApiResponse::$defaultPagination);
    $logs = DB::table('tr_device_last_data as DL')
      ->join('mst_device as MD', 'DL.v_imei', '=', 'MD.imei')
      ->join('tr_health_log as HL', 'DL.v_imei', '=', 'HL.v_imei')
      ->join('tr_location_log as LL', 'DL.v_imei', '=', 'LL.v_imei')
      ->select(
        'DL.v_imei as imei',
        'MD.wearer_name',
        'MD.health_data_periodic',
        'MD.status',
        'MD.is_used',
        'DL.d_location_update',
        'DL.n_lat',
        'DL.n_lng',
        'DL.n_power as last_power_level',
        'DL.d_health_update',
        'DL.n_heart_rate',
        'DL.n_temperature',
        'DL.n_high_blood_pressure',
        'DL.n_low_blood_pressure',
        'DL.n_oxygen',
        'HL.d_insert as health_log_inserted_at',
        'HL.n_heart_rate as logged_heart_rate',
        'HL.n_temperature as logged_temperature',
        'HL.n_high_blood_pressure as logged_high_blood_pressure',
        'HL.n_low_blood_pressure as logged_low_blood_pressure',
        'HL.n_oxygen as logged_oxygen',
        'LL.d_insert as location_log_inserted_at',
        'LL.n_lat as logged_lat',
        'LL.n_lng as logged_lng',
        'LL.n_speed',
        'LL.n_direction',
        'LL.n_altitude',
        'LL.n_signal_strength'
      )
      ->latest()->paginate($pageSize);


    $resourceCollection = SmartwatchLogResource::collection($logs);
    return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
  }
}
