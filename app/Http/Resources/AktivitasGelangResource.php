<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AktivitasGelangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "aktivitas_gelang_id"=> $this->id,
            "gmac"=> $this->gmac,
            "dmac"=> $this->dmac,
            "baterai"=> $this->baterai,
            "step"=> $this->step,
            "heartrate" => $this->heartrate,
            "temp"=> $this->temp,
            "spo"=> $this->spo,
            "systolic" => $this->systolic,
            "diastolic"=> $this->diastolic,
            "cutoff_flag"=> $this->cutoff_flag,
            "type" => $this->type,
            "x0" => $this->x0,
            "y0"=> $this->y0,
            "z0"=> $this->z0,
            "timestamp"=> $this->timestamp,
            "wbp_profile_id"=> $this->wbp_profile_id,
            "nama_wbp" => $this->wbpProfile->nama,
            'gelang_id' => $this->wbpProfile->gelang_id,
            'nama_gelang' => $this->wbpProfile->gelang->nama_gelang,
            'ruangan_otmil_id' => $this->wbpProfile->gelang->ruangan_otmil_id,
            'nama_ruangan_otmil' => $this->wbpProfile->gelang->ruanganOtmil->nama_ruangan_otmil,
            'lokasi_otmil_id' => $this->wbpProfile->gelang->ruanganOtmil->lokasi_otmil_id,
            'nama_lokasi_otmil' => $this->wbpProfile->gelang->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil,
            'ruangan_lemasmil_id' => $this->wbpProfile->gelang->ruangan_lemasmil_id,
            'nama_ruangan_lemasmil' => $this->wbpProfile->gelang->ruanganLemasmil->nama_ruangan_lemasmil,
            'lokasi_lemasmil_id' => $this->wbpProfile->gelang->ruanganLemasmil->lokasi_lemasmil_id,
            'nama_lokasi_lemasmil' => $this->wbpProfile->gelang->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil
        ];
    }
}
