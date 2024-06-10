<?php

namespace App\Http\Resources;

use App\Models\Gelang;
use App\Models\WbpProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardGelangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $wbpProfiles = WbpProfile::select('id', 'nama')
            ->where('gelang_id', $this->id)
            ->get();

        return [
            'gelang_id' => $this->id,
            'dmac' => $this->dmac,
            'nama_gelang' => $this->nama_gelang,
            'tanggal_pasang' => $this->tanggal_pasang,
            'tanggal_aktivasi' => $this->tanggal_aktivasi,
            'baterai' => $this->baterai,
            'lokasi_otmil_id' => $this->ruanganOtmil->lokasi_otmil_id,
            'nama_lokasi_otmil' => $this->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil,
            'ruangan_otmil_id' => $this->ruangan_otmil_id,
            'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil,
            'jenis_ruangan_otmil' => $this->ruanganOtmil->jenis_ruangan_otmil,
            'zona_otmil_id' => $this->ruanganOtmil->zona_id,
            'status_zona_ruangan_otmil' => $this->ruanganOtmil->zona->nama_zona,
            'lokasi_lemasmil_id' => $this->ruanganLemasmil->lokasi_lemasmil_id ?? null,
            'nama_lokasi_lemasmil' => $this->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil ?? null,
            'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id ?? null,
            'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil ?? null,
            'jenis_ruangan_lemasmil' => $this->ruanganLemasmil->jenis_ruangan_lemasmil ?? null,
            'zona_lemasmil_id' => $this->ruanganLemasmil->zona_id ?? null,
            'status_zona_ruangan_lemasmil' => $this->ruanganLemasmil->zona->nama_zona ?? null,
            'wbp' => $wbpProfiles->map(function ($wbp) {
                return [
                    'wbp_profile_id' => $wbp->id,
                    'nama_wbp' => $wbp->nama
                ];
            }),
        ];
    }
}
