<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'device_type_id' => $this->id,
            'type' => $this->type,
            'platform_id' => $this->platform_id,
            'platform' => $this->platform->platform
        ];
    }
}
