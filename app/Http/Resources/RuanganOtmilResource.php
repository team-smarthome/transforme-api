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
            'ruangan_otmil_id' => $this->id,
            'nama_ruangan_otmil' => $this->nama_ruangan_otmil,
            'jenis_ruangan_otmil' => $this->jenis_ruangan_otmil,
            'lokasi_otmil_id' => $this->lokasi_otmil_id,
            'nama_lokasi_otmil' => $this->lokasiOtmil->nama_lokasi_otmil,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'posisi_X' => $this->posisi_X,
            'posisi_Y' => $this->posisi_Y,
            'zona_id' => $this->zona_id,
            'nama_zona' => $this->zona->nama_zona,
            'lantai_otmil_id' => $this->lantai_otmil_id,
            'nama_lantai' => $this->lantaiOtmil->nama_lantai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
