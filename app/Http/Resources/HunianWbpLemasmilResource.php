<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HunianWbpLemasmilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'hunian_wbp_lemasmil_id' => $this->id,
            'nama_hunian_wbp_lemasmil' => $this->nama_hunian_wbp_lemasmil,
            'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id,
            'nama_lokasi_lemasmil' => $this->lokasiLemasmil->nama_lokasi_lemasmil,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
