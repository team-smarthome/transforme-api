<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LantaiOtmilResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'lantai_otmil_id' => $this->id,
      'nama_lantai' => $this->nama_lantai,
      'panjang' => $this->panjang,
      'lebar' => $this->lebar,
      'posisi_X' => $this->posisi_X,
      'posisi_Y' => $this->posisi_Y,
      'lokasi_otmil' => [
        'lokasi_otmil_id' => $this->lokasiOtmil->id,
        'nama_lokasi_otmil' => $this->lokasiOtmil->nama_lokasi_otmil,
        'created_at' => $this->lokasiOtmil->created_at,
        'updated_at' => $this->lokasiOtmil->updated_at,
      ],
      'gedung_otmil' => [
        'gedung_otmil_id' => $this->gedungOtmil->id,
        'nama_gedung_otmil' => $this->gedungOtmil->nama_gedung_otmil,
        'created_at' => $this->gedungOtmil->created_at,
        'updated_at' => $this->gedungOtmil->updated_at,
      ],
      'ruangan' => RuanganOtmilResource::collection($this->whenLoaded('ruanganOtmil')),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at
    ];
  }
}
