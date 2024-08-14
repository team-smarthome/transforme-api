<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LokasiLemasmilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'lokasi_lemasmil_id' => $this->id,
            'nama_lokasi_lemasmil' => $this->nama_lokasi_lemasmil,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
