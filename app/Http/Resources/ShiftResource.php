<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'shift_id' => $this->id,
      'nama_shift' => $this->nama_shift,
      'waktu_mulai' => $this->waktu_mulai,
      'waktu_selesai' => $this->waktu_selesai
    ];
  }
}
