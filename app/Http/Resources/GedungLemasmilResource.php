<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GedungLemasmilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_gedung_lemasmil' => $this->nama_gedung_lemasmil,
            'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id,
            'nama_lokasi_lemasmil' => $this->lokasilemasmil->nama_lokasi_lemasmil,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'posisi_X' => $this->posisi_X,
            'posisi_Y' => $this->posisi_Y,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
