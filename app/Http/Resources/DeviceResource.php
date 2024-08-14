<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'device_id' => $this->id,
      'imei' => $this->imei,
      'wearer_name' => $this->wearer_name,
      'health_data_periodic' => $this->health_data_periodic,
      'status' => $this->status,
      'is_used' => $this->is_used,
      'device_type_id' => $this->device_type_id,
      'device_model_id' => $this->device_model_id,
      'manufacturer_id' => $this->manufacturer_id,
      'firmware_version_id' => $this->firmware_version_id,
      'platform_id' => $this->platform_id,
      'device_type' => $this->whenLoaded('deviceType', function () {
        return [
          'device_type_id' => $this->deviceType->id,
          'device_type_name' => $this->deviceType->type,
        ];
      }),
      'device_model' => $this->whenLoaded('deviceModel', function () {
        return [
          'device_model_id' => $this->deviceModel->id,
          'device_model_name' => $this->deviceModel->model,
        ];
      }),
      'manufacturer' => $this->whenLoaded('manufacturer', function () {
        return [
          'manufacturer_id' => $this->manufacturer->id,
          'manufacturer_name' => $this->manufacturer->manufacture,
        ];
      }),
      'firmware_version' => $this->whenLoaded('firmwareVersion', function () {
        return [
          'firmware_version_id' => $this->firmwareVersion->id,
          'firmware_version_name' => $this->firmwareVersion->version,
        ];
      }),
      'platform' => $this->whenLoaded('platform', function () {
        return [
          'platform_id' => $this->platform->id,
          'nama_platform' => $this->platform->platform,
        ];
      }),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
