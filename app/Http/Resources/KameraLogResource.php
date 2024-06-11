<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KameraLogResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'kamera_log_id' => $this->id,
      'image' => $this->image,
      'kamera_id' => $this->kamera_id,
      'nama_kamera' => $this->kamera->nama_kamera ?? null,
      'foto_wajah_fr' => $this->foto_wajah_fr,
      'created_at' => $this->created_at
    ];
  }
}
