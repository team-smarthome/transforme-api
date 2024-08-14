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
            'gedung_lemasmil_id' => $this->id,
            'nama_gedung_lemasmil' => $this->nama_gedung_lemasmil,
            'panjang' => number_format($this->panjang, 2, '.', ''),
            'lebar' => number_format($this->lebar, 2, '.', ''),
            'posisi_X' => number_format($this->posisi_X, 2, '.', ''),
            'posisi_Y' => number_format($this->posisi_Y, 2, '.', ''),
            'lokasi_lemasmil' => [
                'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id,
                'nama_lokasi_lemasmil' => $this->lokasiLemasmil->nama_lokasi_lemasmil
            ]
        ];
    }
}
