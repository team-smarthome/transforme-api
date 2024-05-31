<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AksesRuanganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return [
    //         // 'id' => $this->id,
    //         // 'dmac' => $this->dmac,
    //         // 'nama_gateway' => $this->nama_gateway,
    //         'nama_ruangan_otmil' => $this->ruanganOtmilAkses->nama_ruangan_otmil,
    //         'ruangan_otmil_id' => $this->ruangan_otmil_id,
    //         'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id,
    //         'wbp_profile_id' => $this->wbp_profile_id,
    //         'is_permitted' => $this->is_permitted,
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at
    //     ];
    // }

    public function toArray(Request $request): array
    {
        $response = [
            'wbp_profile_id' => $this->wbp_profile_id,
            'is_permitted' => $this->is_permitted,
        ];

        if (!is_null($this->ruangan_otmil_id) && $this->ruangan_otmil_id !== '') {
            $response['ruangan_otmil_id'] = $this->ruangan_otmil_id;
            $response['nama_ruangan_otmil'] = optional($this->ruanganOtmilAkses)->nama_ruangan_otmil;
            $response['lokasi_otmil_id'] = optional($this->ruanganOtmilAkses)->lokasi_otmil_id;
            $response['nama_lokasi_otmil'] = optional($this->ruanganOtmilAkses->lokasiOtmil)->nama_lokasi_otmil;
        }

        if (!is_null($this->ruangan_lemasmil_id) && $this->ruangan_lemasmil_id !== '') {
            $response['ruangan_lemasmil_id'] = $this->ruangan_lemasmil_id;
            $response['nama_ruangan_lemasmil'] = optional($this->ruanganLemasmilAkses)->nama_ruangan_lemasmil;
            $response['lokasi_lemasmil_id'] = optional($this->ruanganLemasmilAkses)->lokasi_lemasmil_id;
            $response['nama_lokasi_lemasmil'] = optional($this->ruanganLemasmilAkses->lokasiLemasmil)->nama_lokasi_lemasmil;
        }

        return $response;
    }
}
