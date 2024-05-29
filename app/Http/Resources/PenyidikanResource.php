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
            'id' => $this->id,
            'nomor_penyidikan' => $this->nomor_penyidikan,
            'agenda_penyidikan' => $this->agenda_penyidikan,
            'kasus_id' => $this->kasus_id,
            'nama_kasus' =>$this->kasus->nama_kasus,
            'nomor_kasus' =>$this->kasus->nomor_kasus,
            'nama_jenis_perkara' => $this->kasus->jenisPerkara->nama_jenis_perkara,
            'nama_kategori_perkara' => $this->kasus->kategoriPerkara->nama_kategori_perkara,
            // 'hasil_penyidikan' => $this->historiPenyidikan->hasil_penyidikan,
            'waktu_dimulai_penyidikan' => $this->waktu_dimulai_penyidikan,
            'agenda_penyidikan' => $this->agenda_penyidikan,
            'waktu_selesai_penyidikan' => $this->waktu_selesai_penyidikan,
            'dokumen_bap_id' => $this->dokumen_bap_id,
            'nama_dokumen_bap' => $this->bap->nama_dokumen_bap,
            'wbp_profile_id' => $this->wbp_profile_id,
            'nama_wbp' => $this->wbp->nama,
            'nrp' => $this->wbp->nrp,
            'saksi_id' => $this->saksi_id,
            'nama_saksi' => $this->saksi->nama_saksi,
            'oditur_penyidikan_id' => $this->oditur_penyidikan_id,
            'nip' => $this->oditurPenyidik ->nip,
            'nama_oditur_penyidik' => $this->oditurPenyidik ->nama_oditur,
            'zona_waktu' => $this->zona_waktu,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
