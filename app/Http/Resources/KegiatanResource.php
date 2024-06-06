<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KegiatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'kegiatan_id' => $this->id,
            'nama_kegiatan' => $this->nama_kegiatan,
            'ruangan_otmil_id' => $this->ruangan_otmil_id,
            'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id,
            'status_kegiatan' => $this->status_kegiatan,
            'waktu_mulai_kegiatan' => $this->waktu_mulai_kegiatan,
            'waktu_selesai_kegiatan' => $this->waktu_selesai_kegiatan,
            'zona_waktu' => $this->zona_waktu,
            'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil,
            'jenis_ruangan_otmil' => $this->ruanganOtmil->jenis_ruangan_otmil,
            'lokasi_otmil_id' => $this->ruanganOtmil->lokasi_otmil_id,
            'nama_lokasi_otmil' => $this->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil,
            'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil,
            'jenis_ruangan_lemasmil' => $this->ruanganLemasmil->jenis_ruangan_lemasmil,
            'lokasi_lemasmil_id' => $this->ruanganLemasmil->lokasi_lemasmil_id,
            'nama_lokasi_lemasmil' => $this->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil,
            'status_zona_otmil' => $this->ruanganOtmil->zona->nama_zona,
            'status_zona_lemasmil' => $this->ruanganLemasmil->zona->nama_zona,
            'peserta' => $this->wbpProfile->map(function($kegiatanWbp) {
                return [
                    'wbp_profile_id' => (string) $kegiatanWbp->wbp_profile_id,
                ];
            })
        ];
    }
}
