<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KotaResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'kota_id' => $this->id,
      'nama_kota' => $this->nama_kota,
      'provinsi_id' => $this->provinsi_id,
      'updated_at' => $this->updated_at,
      'created_at' => $this->created_at,
    ];
  }
}
