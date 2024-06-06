<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KameraResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'kamera_id' => $this->id,
      'nama_kamera' => $this->nama_kamera,
      'url_rtsp' => $this->url_rtsp,
      'ip_address' => $this->ip_address,
      'ruangan_otmil_id' => $this->ruangan_otmil_id,
      'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id,
      'merk' => $this->merk,
      'model' => $this->model,
      'status_kamera' => $this->status_kamera,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
