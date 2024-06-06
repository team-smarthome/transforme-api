<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GatewayLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'gateway_log_id' => $this->id,
            'image' => $this->image,
            'nama_gateway' => $this->gateway->nama_gateway,
            'status_gateway' => $this->gateway->status_gateway,
            'gmac' => $this->gateway->gmac,
            'timestamp' => $this->created_at,
            'ruangan_otmil_id' => $this->gateway->ruangan_otmil_id,
            'ruangan_lemasmil_id' => $this->gateway->ruangan_lemasmil_id,
            'nama_ruangan_otmil' => $this->gateway->ruanganOtmil->nama_ruangan_otmil,
            'nama_ruangan_lemasmil' => $this->gateway->ruanganLemasmil->nama_ruangan_lemasmil,
            'jenis_ruangan_otmil' => $this->gateway->ruanganOtmil->jenis_ruangan_otmil,
            'jenis_ruangan_lemasmil' => $this->gateway->ruanganLemasmil->jenis_ruangan_lemasmil,
            'zona_id_otmil' => $this->gateway->ruanganOtmil->zona_id,
            'zona_id_lemasmil' => $this->gateway->ruanganLemasmil->zona_id,
            'status_zona_ruangan_otmil' => $this->gateway->ruanganOtmil->zona->nama_zona,
            'status_zona_ruangan_lemasmil' => $this->gateway->ruanganLemasmil->zona->nama_zona,
            'lokasi_otmil_id' => $this->gateway->ruanganOtmil->lokasi_otmil_id,
            'lokasi_lemasmil_id' => $this->gateway->ruanganLemasmil->lokasi_lemasmil_id,
            'nama_lokasi_otmil' => $this->gateway->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil,
            'nama_lokasi_lemasmil' => $this->gateway->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil,
            'wbp_profile_id' => $this->wbp_profile_id,
            'nama_wbp' => $this->wbpProfile->nama
        ];
    }
}
