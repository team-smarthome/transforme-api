<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SmartwatchLogResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'imei' => $this->imei,
      'wearer_name' => $this->wearer_name,
      'health_data_periodic' => $this->health_data_periodic,
      'status' => $this->status,
      'is_used' => $this->is_used,
      'location' => [
        'last_update' => $this->d_location_update,
        'latitude' => $this->n_lat,
        'longitude' => $this->n_lng,
        'power_level' => $this->last_power_level,
      ],
      'health' => [
        'last_update' => $this->d_health_update,
        'heart_rate' => $this->n_heart_rate,
        'temperature' => $this->n_temperature,
        'high_blood_pressure' => $this->n_high_blood_pressure,
        'low_blood_pressure' => $this->n_low_blood_pressure,
        'oxygen' => $this->n_oxygen,
      ],
      // 'health_logs' => [
      //   'inserted_at' => $this->health_log_inserted_at,
      //   'heart_rate' => $this->logged_heart_rate,
      //   'temperature' => $this->logged_temperature,
      //   'high_blood_pressure' => $this->logged_high_blood_pressure,
      //   'low_blood_pressure' => $this->logged_low_blood_pressure,
      //   'oxygen' => $this->logged_oxygen,
      // ],
      'location_logs' => [
        'inserted_at' => $this->location_log_inserted_at,
        'latitude' => $this->logged_lat,
        'longitude' => $this->logged_lng,
        'speed' => $this->n_speed,
        'direction' => $this->n_direction,
        'altitude' => $this->n_altitude,
        'signal_strength' => $this->n_signal_strength,
      ]
    ];
  }
}
