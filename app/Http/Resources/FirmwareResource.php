<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FirmwareResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firmware_version_id' => $this->id,
            'version' => $this->version,
            'platform_id' => $this->platform_id,
            'nama_platform' => $this->platform->platform
        ];
    }
}
