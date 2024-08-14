<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PenyidikanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'penyidikan_id' => $this->id ?? null,
            'nomor_penyidikan' => $this->nomor_penyidikan ?? null,
            'kasus_id' => $this->kasus_id ?? null,
            'nama_kasus' =>$this->kasus->nama_kasus ?? null,
            'nomor_kasus' =>$this->kasus->nomor_kasus ?? null,
            'agenda_penyidikan' => $this->agenda_penyidikan ?? null,
            'wbp_profile_id' => $this->wbp_profile_id ?? null,
            'nrp_wbp' => $this->wbpProfile->nrp ?? null,
            'nama_wbp' => $this->wbpProfile->nama ?? null,
            'saksi_id' => $this->saksi_id ?? null,
            'zona_waktu' => $this->zona_waktu ?? null,
            'nama_saksi' => $this->saksi->nama_saksi ?? null,
            'oditur_penyidikan_id' => $this->oditur_penyidikan_id ?? null,
            'nip_oditur' => $this->oditurPenyidik ->nip ?? null,
            'nama_oditur' => $this->oditurPenyidik ->nama_oditur ?? null,
            'waktu_dimulai_penyidikan' => $this->waktu_dimulai_penyidikan ?? null,
            'waktu_selesai_penyidikan' => $this->waktu_selesai_penyidikan ?? null,
            'jenis_perkara_id' => $this->kasus->jenis_perkara_id ?? null,
            'nama_jenis_perkara' => $this->kasus->jenisPerkara->nama_jenis_perkara ?? null,
            'kategori_perkara_id' => $this->kasus->kategori_perkara_id ?? null,
            'nama_kategori_perkara' => $this->kasus->kategoriPerkara->nama_kategori_perkara ?? null,
            'agenda_penyidikan' => $this->agenda_penyidikan ?? null,
            'dokumen_bap_id' => $this->dokumen_bap_id ?? null,
            // 'nama_dokumen_bap' => $this->bap->nama_dokumen_bap,
            // 'hasil_penyidikan' => $this->historiPenyidikan->hasil_penyidikan,
            // 'nama_oditur_penyidik' => $this->oditurPenyidik ->nama_oditur,
            'created_at' => $this->created_at ?? null,
            'updated_at' => $this->updated_at ?? null,
        ];
    }
}
