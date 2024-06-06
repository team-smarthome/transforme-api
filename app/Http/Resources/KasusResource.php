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
            'kasus_id' => $this->id, //
            'nomor_kasus' => $this->nomor_kasus, //
            'wbp_profile_id' => $this->wbp_profile_id, //
            'nama_kasus' => $this->nama_kasus, //
            'lokasi_kasus' => $this->lokasi_kasus,//
            'waktu_kejadian' => $this->waktu_kejadian, //
            // 'tanggal_pelaporan_kasus' => $this->tanggal_pelaporan_kasus, //
            'tanggal_pelimpahan_kasus' => $this->tanggal_pelimpahan_kasus, //
            'jenis_perkara_id' => $this->jenis_perkara_id, //
            'waktu_pelaporan_kasus' => $this->tanggal_pelaporan_kasus, //
            'zona_waktu' => $this->zona_waktu, //
            'nama_jenis_perkara' => $this->jenisPerkara->nama_jenis_perkara, // JP
            'kategori_perkara_id' => $this->kategori_perkara_id, //
            'nama_kategori_perkara' => $this->kategoriPerkara->nama_kategori_perkara, // KP
            'jenis_pidana_id' => $this->kategoriPerkara->jenis_pidana_id, //KP
            'nama_jenis_pidana' => $this->kategoriPerkara->jenisPidana->nama_jenis_pidana, //KP JPidana
            'tanggal_mulai_penyidikan' => $this->tanggal_mulai_penyidikan,//
            'tanggal_mulai_sidang' => $this->tanggal_mulai_sidang, //
            'wbp_profile' => $this->whenLoaded('wbpProfilePivot', function() {
                return $this->wbpProfilePivot->map(function ($item) {
                    return [
                        'wbp_profile_id' => $item->pivot->wbp_profile_id,
                        'nrp' => $item->nrp,
                        'nama' => $item->nama,
                        'nama_status_wbp_kasus' => $item->statusWbpKasus->nama_status_wbp_kasus,
                        'keterangan' => $item->pivot->keterangan
                    ];
                });
            }),
            'oditur_penyidik' => $this->whenLoaded('oditurPenyidik', function() {
                return $this->oditurPenyidik->map(function ($item) {
                    return [
                        'oditur_penyidik_id' => $item->pivot->oditur_penyidikan_id,
                        'nip' => $item->nip,
                        'nama_oditur' => $item->nama_oditur,
                        'role_ketua' => $item->pivot->role_ketua,
                        'alamat' => $item->alamat
                    ];
                });
            }),
            'saksi' => $this->whenLoaded('saksiPivot', function() {
                return $this->saksiPivot->map(function ($item) {
                    return [
                        'saksi_id' => $item->pivot->saksi_id,
                        'nama_saksi' => $item->nama_saksi,
                        'no_kontak' => $item->no_kontak,
                        'alamat' => $item->alamat,
                        'keterangan' => $item->pivot->keterangan,
                    ];
                });
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
