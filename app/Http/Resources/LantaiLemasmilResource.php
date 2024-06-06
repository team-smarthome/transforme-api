<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LantaiLemasmilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'lantai_lemasmil_id' => $this->id,
            'nama_lantai' => $this->nama_lantai,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'posisi_X' => $this->posisi_X,
            'posisi_Y' => $this->posisi_Y,
            'lokasi_lemasmil' => [
                'lokasi_lemasmil_id' => $this->lokasiLemasmil->id,
                'nama_lokasi_lemasmil' => $this->lokasiLemasmil->nama_lokasi_lemasmil,
                'created_at' => $this->lokasiLemasmil->created_at,
                'updated_at' => $this->lokasiLemasmil->updated_at,
            ],
            'gedung_lemasmil' => [
                'gedung_lemasmil_id' => $this->gedungLemasmil->id,
                'nama_gedung_lemasmil' => $this->gedungLemasmil->nama_gedung_lemasmil,
                'created_at' => $this->gedungLemasmil->created_at,
                'updated_at' => $this->gedungLemasmil->updated_at,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
