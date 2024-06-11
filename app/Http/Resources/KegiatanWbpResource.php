<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KegiatanWbpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "kegiatan_wbp_id" => $this->id,
            "wbp_profile_id" => $this->wbpProfile->wbp_profile_id,
            "kegiatan_id" => $this->kegiatan->kegiatan_id
        ];
    }
}
