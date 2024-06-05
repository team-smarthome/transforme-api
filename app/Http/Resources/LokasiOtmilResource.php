<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LokasiOtmilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'lokasi_otmil_id' => $this->id,
            'nama_lokasi_otmil' => $this->nama_lokasi_otmil,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
