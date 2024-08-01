<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlatformResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'platform_id' => $this->id,
      'nama_platform' => $this->platform,
      // 'created_at' => $this->created_at,
      // 'updated_at' => $this->updated_at,
      // 'deleted_at' => $this->deleted_at
    ];
  }
}
