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
            'penyidikan_id' => $this->id,
            'nomor_penyidikan' => $this->nomor_penyidikan,
            'kasus_id' => $this->kasus_id,
            'nama_kasus' =>$this->kasus->nama_kasus,
            'nomor_kasus' =>$this->kasus->nomor_kasus,
            'agenda_penyidikan' => $this->agenda_penyidikan,
            'wbp_profile_id' => $this->wbp_profile_id,
            'nrp_wbp' => $this->wbpProfile->nrp,
            'nama_wbp' => $this->wbpProfile->nama,
            'saksi_id' => $this->saksi_id,
            'zona_waktu' => $this->zona_waktu,
            'nama_saksi' => $this->saksi->nama_saksi,
            'oditur_penyidikan_id' => $this->oditur_penyidikan_id,
            'nip_oditur' => $this->oditurPenyidik ->nip,
            'nama_oditur' => $this->oditurPenyidik ->nama_oditur,
            'waktu_dimulai_penyidikan' => $this->waktu_dimulai_penyidikan,
            'waktu_selesai_penyidikan' => $this->waktu_selesai_penyidikan,
            'jenis_perkara_id' => $this->kasus->jenis_perkara_id,
            'nama_jenis_perkara' => $this->kasus->jenisPerkara->nama_jenis_perkara,
            'kategori_perkara_id' => $this->kasus->kategori_perkara_id,
            'nama_kategori_perkara' => $this->kasus->kategoriPerkara->nama_kategori_perkara,
            'agenda_penyidikan' => $this->agenda_penyidikan,
            'dokumen_bap_id' => $this->dokumen_bap_id,
            // 'nama_dokumen_bap' => $this->bap->nama_dokumen_bap,
            // 'hasil_penyidikan' => $this->historiPenyidikan->hasil_penyidikan,
            // 'nama_oditur_penyidik' => $this->oditurPenyidik ->nama_oditur,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
