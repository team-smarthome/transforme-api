<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KasusResource extends JsonResource
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
            'nama_kasus' => $this->nama_kasus,
            'nomor_kasus' => $this->nomor_kasus,
            'wbp_profile_id' => $this->wbp_profile_id,
            'kategori_perkara_id' => $this->kategori_perkara_id,
            'jenis_perkara_id' => $this->jenis_perkara_id,
            'nama_jenis_perkara' => $this->jenisPerkara->nama_jenis_perkara,
            'pasal' => $this->jenisPerkara->pasal,
            'vonis_tahun_perkara' => $this->jenisPerkara->vonis_tahun_perkara,
            'vonis_bulan_perkara' => $this->jenisPerkara->vonis_bulan_perkara,
            'vonis_hari_perkara' => $this->jenisPerkara->vonis_hari_perkara,
            'nama_kategori_perkara' => $this->kategoriPerkara->nama_kategori_perkara,
            'lokasi_kasus' => $this->lokasi_kasus,
            'waktu_kejadian' => $this->waktu_kejadian,
            'tanggal_pelimpahan_kasus' => $this->tanggal_pelimpahan_kasus,
            'waktu_pelaporan_kasus' => $this->waktu_pelaporan_kasus,
            'zona_waktu' => $this->zona_waktu,
            'tanggal_mulai_penyidikan' => $this->tanggal_mulai_penyidikan,
            'tanggal_mulai_sidang' => $this->tanggal_mulai_sidang,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
