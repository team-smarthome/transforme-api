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
      'lantai_otmil_id' => $this->id ?? null,
      'nama_lantai' => $this->nama_lantai ?? null,
      'panjang' => $this->panjang ?? null,
      'lebar' => $this->lebar ?? null,
      'posisi_X' => $this->posisi_X ?? null,
      'posisi_Y' => $this->posisi_Y ?? null,
      'lokasi_otmil' => [
        'lokasi_otmil_id' => $this->lokasiOtmil->id ?? null,
        'nama_lokasi_otmil' => $this->lokasiOtmil->nama_lokasi_otmil ?? null,
        'created_at' => $this->lokasiOtmil->created_at ?? null,
        'updated_at' => $this->lokasiOtmil->updated_at ?? null,
      ] ?? null,
      'gedung_otmil' => [
        'gedung_otmil_id' => $this->gedungOtmil->id ?? null,
        'nama_gedung_otmil' => $this->gedungOtmil->nama_gedung_otmil ?? null,
        'created_at' => $this->gedungOtmil->created_at ?? null,
        'updated_at' => $this->gedungOtmil->updated_at ?? null,
      ] ?? null,
      'ruangan' => RuanganOtmilResource::collection($this->whenLoaded('ruanganOtmil')) ?? null,
      'created_at' => $this->created_at ?? null,
      'updated_at' => $this->updated_at ?? null,
      'deleted_at' => $this->deleted_at ?? null,
    ];
  }
}
