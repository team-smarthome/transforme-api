<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengadilanMiliterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pengadilan_militer_id' => $this->id,
            'nama_pengadilan_militer' => $this->nama_pengadilan_militer,
            'provinsi_id' => $this->provinsi_id,
            'nama_provinsi' => $this->provinsi->nama_provinsi,
            'nama_kota' => $this->kota->nama_kota,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
