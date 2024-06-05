<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WbpRegisterLogResource extends JsonResource
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
            'wbp_profile_id' => $this->wbp_profile_id,
            'nama' => $this->wbpProfile->nama,
            'hunian_wbp_otmil_id' => $this->wbpProfile->hunian_wbp_otmil_id,
            'nama_hunian_wbp_otmil' => $this->wbpProfile->hunianWbpOtmil->nama_hunian_wbp_otmil,
            'lokasi_otmil_id' => $this->wbpProfile->hunianWbpOtmil->lokasi_otmil_id,
            'nama_lokasi_otmil' => $this->wbpProfile->hunianWbpOtmil->lokasiOtmil->nama_lokasi_otmil,
            'hunian_wbp_lemasmil_id' => $this->wbpProfile->hunian_wbp_lemasmil_id,
            'nama_hunian_wbp_lemasmil' => optional($this->wbpProfile->hunianWbpLemasmil)->nama_hunian_wbp_lemasmil,
            'lokasi_lemasmil_id' => optional($this->wbpProfile->hunianWbpLemasmil)->lokasi_lemasmil_id,
            'nama_lokasi_lemasmil' => optional(optional($this->wbpProfile->hunianWbpLemasmil)->lokasiLemasmil)->nama_lokasi_lemasmil,
            'keterangan' => $this->keterangan,
            'timestamp' => $this->timestamp
        ];
    }
}
