<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinsiResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      "provinsi_id" => $this->id,
      "nama_provinsi" => $this->nama_provinsi,
      "updated_at" => $this->updated_at,
      "created_at" => $this->created_at
    ];
  }
}
