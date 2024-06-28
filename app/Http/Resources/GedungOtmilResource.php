<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GedungOtmilResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'gedung_otmil_id' => $this->id,
      'nama_gedung_otmil' => $this->nama_gedung_otmil,
      'panjang' => number_format($this->panjang, 2, '.', ''),
      'lebar' => number_format($this->lebar, 2, '.', ''),
      'posisi_X' => number_format($this->posisi_X, 2, '.', ''),
      'posisi_Y' => number_format($this->posisi_Y, 2, '.', ''),
      'lokasi_otmil' => [
        'lokasi_otmil_id' => $this->lokasi_otmil_id,
        'nama_lokasi_otmil' => $this->lokasiOtmil->nama_lokasi_otmil
      ],
      'lantai' => LantaiOtmilResource::collection($this->whenLoaded('lantaiOtmil')),
    ];
  }
}
