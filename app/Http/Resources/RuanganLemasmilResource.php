<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RuanganLemasmilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ruangan_lemasmil_id' => $this->id,
            'nama_ruangan_lemasmil' => $this->nama_ruangan_lemasmil,
            'jenis_ruangan_lemasmil' => $this->jenis_ruangan_lemasmil,
            'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id,
            'nama_lokasi_lemasmil' => $this->lokasilemasmil->nama_lokasi_lemasmil,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'posisi_X' => $this->posisi_X,
            'posisi_Y' => $this->posisi_Y,
            'zona_id' => $this->zona_id,
            'nama_zona' => $this->zona->nama_zona,
            'lantai_lemasmil_id' => $this->lantai_lemasmil_id,
            'nama_lantai' => $this->lantailemasmil->nama_lantai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at        
        ];
    }
}
