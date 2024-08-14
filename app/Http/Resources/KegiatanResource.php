<?php

namespace App\Http\Resources;

use App\Models\KegiatanWbp;
use App\Models\WbpProfile;
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
            'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil ?? null,
            'jenis_ruangan_otmil' => $this->ruanganOtmil->jenis_ruangan_otmil ?? null,
            'lokasi_otmil_id' => $this->ruanganOtmil->lokasi_otmil_id ?? null,
            'nama_lokasi_otmil' => $this->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil ?? null,
            'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil ?? null,
            'jenis_ruangan_lemasmil' => $this->ruanganLemasmil->jenis_ruangan_lemasmil ?? null,
            'lokasi_lemasmil_id' => $this->ruanganLemasmil->lokasi_lemasmil_id ?? null,
            'nama_lokasi_lemasmil' => $this->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil ?? null,
            'status_zona_otmil' => $this->ruanganOtmil->zona->nama_zona ?? null,
            'status_zona_lemasmil' => $this->ruanganLemasmil->zona->nama_zona ?? null,
            'peserta' => $this->kegiatanWbpPivot->map(function($wbp) {
                return [
                    'wbp_profile_id' => $wbp->id,
                    'nama_wbp' => $wbp->nama,
                ];
            })->toArray()
        ];
    }
}

// 'peserta' => $this->wbpProfile->map(function($kegiatanWbp) {
            //     return [
            //         'wbp_profile_id' => (string) $kegiatanWbp->wbp_profile_id,
            //     ];
            // })
