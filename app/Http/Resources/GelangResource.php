<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GelangResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'gelang_id' => $this->id,
      'dmac' => $this->dmac,
      'nama_gelang' => $this->nama_gelang,
      'tanggal_pasang' => $this->tanggal_pasang,
      'tanggal_aktivasi' => $this->tanggal_aktivasi,
      'ruangan_otmil_id' => $this->ruangan_otmil_id,
      'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil,
      'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id,
      'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil ?? null,
      'baterai' => $this->baterai,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at
    ];
  }
}
