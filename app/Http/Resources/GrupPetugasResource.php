<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrupPetugasResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      "grup_petugas_id" => $this->id,
      "nama_grup_petugas" => $this->nama_grup_petugas,
      "ketua_grup" => $this->ketua_grup,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at
    ];
  }
}
