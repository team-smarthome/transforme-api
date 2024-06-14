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
            'jenis_perkara_id' => $this->id,
            'kategori_perkara_id' => $this->kategori_perkara_id,
            'nama_jenis_perkara' => $this->nama_jenis_perkara,
            'nama_kategori_perkara' => $this->kategoriPerkara->nama_kategori_perkara,
            'jenis_pidana_id' => $this->kategoriPerkara->jenis_pidana_id,
            'pasal' => $this->pasal,
            'vonis_tahun_perkara' => (string)$this->vonis_tahun_perkara,
            'vonis_bulan_perkra' => (string)$this->vonis_bulan_perkara,
            'vonis_hari_perkara' => (string)$this->vonis_hari_perkara,
            'nama_jenis_pidana' => $this->kategoriPerkara->jenisPidana->nama_jenis_pidana,
        ];
    }
}
