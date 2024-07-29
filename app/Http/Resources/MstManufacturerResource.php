<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MstManufacturerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'manufacture_id' => $this->id,
            'manufacture' => $this->manufacture,
            'platform_id' => $this->platform_id,
            'nama_platform' => $this->platform->platform
        ];
    }
}
