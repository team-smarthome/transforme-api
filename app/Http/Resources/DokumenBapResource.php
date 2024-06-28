<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DokumenBapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'dokumen_bap_id' => $this->id,
            'nama_dokumen_bap' => $this->nama_dokumen_bap,
            'link_dokumen_bap' => $this->link_dokumen_bap,
            'penyidikan_id' => $this->penyidikan_id,
            'nomor_penyidikan' => $this->penyidikan->nomor_penyidikan,
            'agenda_penyidikan' => $this->penyidikan->agenda_penyidikan,
            'kasus_id' => $this->penyidikan->kasus_id,
            'nomor_kasus' => $this->penyidikan->kasus->nomor_kasus,
            'nama_kasus' => $this->penyidikan->kasus->nama_kasus,
            'nrp_wbp' => $this->wbpProfile->nrp,
            'lokasi_otmil' => $this->wbpProfile->hunianWbpOtmil->lokasiOtmil->nama_lokasi_otmil,
            'lokasi_lemasmil' => $this->wbpProfile->hunianWbpLemasmil->lokasiLemasmil->nama_lokasi_lemasmil,
            'wbp_profile_id' => $this->wbp_profile_id,
            'nama' => $this->wbpProfile->nama,
            'saksi_id' => $this->saksi_id,
            'nama_saksi' => $this->saksi->nama_saksi,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}
