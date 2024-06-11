<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SidangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "sidang_id" => $this->id,
            "nama_sidang" => $this->nama_sidang,
            "juru_sita" => $this->juru_sita,
            "pengawas_peradilan_militer" => $this->pengawas_peradilan_militer,
            "jadwal_sidang" => $this->jadwal_sidang,
            "perubahan_jadwal_sidang" => $this->perubahan_jadwal_sidang,
            "kasus_id" => $this->kasus_id,
            "nomor_kasus" => $this->kasus->nomor_kasus,
            "nama_kasus" => $this->kasus->nama_kasus,
            "waktu_mulai_sidang" => $this->waktu_mulai_sidang,
            "waktu_selesai_sidang" => $this->waktu_selesai_sidang,
            "agenda_sidang" => $this->agenda_sidang,
            "pengadilan_militer_id" => $this->pengadilan_militer_id,
            "hasil_keputusan_sidang" => $this->hasil_keputusan_sidang,
            "jenis_persidangan_id" => $this->jenis_persidangan_id,
            "zona_waktu" => $this->zona_waktu,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "wbp_profile_id_kasus" => $this->wbp_profile_id_kasus,
            "wbp_profile_id" => $this->wbp_profile_id,
            "jenis_perkara_id" => $this->jenis_perkara_id,
            "lokasi_kasus" => $this->lokasi_kasus,
            "waktu_kejadian" => $this->waktu_kejadian,
            "tanggal_pelimpahan_kasus" => $this->tanggal_pelimpahan_kasus,
            "waktu_pelaporan_kasus" => $this->waktu_pelaporan_kasus,
            "created_at_kasus" => $this->created_at_kasus,
            "updated_at_kasus" => $this->updated_at_kasus,
            "nama_wbp" => $this->wbpProfile->nama,
            "nrp_wbp" => $this->wbpProfile->nrp,
            "nomor_tahanan_wbp" => $this->wbpProfile->nomor_tahanan,
            "kategori_perkara_id" => $this->kategori_perkara_id,
            "nama_jenis_perkara" => $this->nama_jenis_perkara,
            "pasal" => $this->pasal,
            "vonis_tahun_perkara" => $this->vonis_tahun_perkara,
            "vonis_bulan_perkara" => $this->vonis_bulan_perkara,
            "vonis_hari_perkara" => $this->vonis_hari_perkara,
            "nama_kategori_perkara" => $this->nama_kategori_perkara,
            "nama_pengadilan_militer" => $this->nama_pengadilan_militer,
            "provinsi_id" => $this->provinsi_id,
            "nama_provinsi" => $this->nama_provinsi,
            "nama_jenis_persidangan" => $this->nama_jenis_persidangan,
            "sidang_hakim" => [],
            "sidang_oditur" => [
                // {
                //     "pivot_sidang_oditur_id" => $this->pivot_sidang_oditur_id
                // }
            ]
        ];
    }
}
