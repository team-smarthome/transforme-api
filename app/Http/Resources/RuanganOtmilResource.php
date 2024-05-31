<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RuanganOtmilResource extends JsonResource
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
            'nama_ruangan_otmil' => $this->nama_ruangan_otmil,
            'jenis_ruangan_otmil' => $this->jenis_ruangan_otmil,
            'lokasi_otmil_id' => $this->lokasi_otmil_id,
            'zona_id' => $this->zona_id,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'posisi_X' => $this->posisi_X,
            'posisi_Y' => $this->posisi_Y,
            'lantai_otmil_id' => $this->lantai_otmil_id,
        ];
    }
}
