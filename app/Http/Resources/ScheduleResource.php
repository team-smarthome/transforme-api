<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      "schedule_id" => $this->id,
      "tanggal" => $this->tanggal,
      "bulan" => $this->bulan,
      "tahun" => $this->tahun,
      "shift_id" => $this->shift_id,
    ];
  }
}
