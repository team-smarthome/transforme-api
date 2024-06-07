<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HunianWbpOtmilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'hunian_wbp_otmil_id' => $this->id,
            'nama_hunian_wbp_otmil' => $this->nama_hunian_wbp_otmil,
            'lokasi_otmil_id' => $this->lokasi_otmil_id,
            'nama_lokasi_otmil' => $this->lokasiOtmil->nama_lokasi_otmil,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
