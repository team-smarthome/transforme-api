<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JenisPerkaraResource extends JsonResource
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
            'kategori_perkara_id' => $this->kategori_perkara_id,
            'nama_jenis_perkara' => $this->nama_jenis_perkara,
            'pasal' => $this->pasal,
            'vonis_tahun_perkara' => $this->vonis_tahun_perkara,
            'vonis_bulan_perkra' => $this->vonis_bulan_perkara,
            'vonis_hari_perkara' => $this->vonis_hari_perkara,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
