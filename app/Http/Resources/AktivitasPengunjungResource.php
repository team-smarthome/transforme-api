<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class   AktivitasPengunjungResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'aktivitas_pengunjung_id' => $this->id,
            'nama_aktivitas_pengunjung' => $this->nama_aktivitas_pengunjung,
            'waktu_mulai_kunjungan' => $this->waktu_mulai_kunjungan,
            'waktu_selesai_kunjungan' => $this->waktu_selesai_kunjungan,
            'tujuan_kunjungan' => $this->tujuan_kunjungan,
            'zona_waktu' => $this->zona_waktu,
            'lokasi_otmil_id' => $this->ruanganOtmil->lokasi_otmil_id,
            'nama_lokasi_otmil' => $this->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil,
            'ruangan_otmil_id' => $this->ruangan_otmil_id,
            'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil,
            'jenis_ruangan_otmil' => $this->ruanganOtmil->jenis_ruangan_otmil,
            'zona_id_otmil' => $this->ruanganOtmil->zona_id,
            'status_zona_ruangan_otmil' => $this->ruanganOtmil->zona->nama_zona,
            'lokasi_lemasmil_id' => $this->ruanganLemasmil->lokasi_lemasmil_id ?? null,
            'nama_lokasi_lemasmil' => $this->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil ?? null,
            'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id ?? null,
            'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil ?? null,
            'jenis_ruangan_lemasmil' => $this->ruanganLemasmil->jenis_ruangan_lemasmil ?? null,
            'zona_id_lemasmil' => $this->ruanganLemasmil->zona_id ?? null,
            'status_zona_ruangan_lemasmil' => $this->ruanganLemasmil->zona->nama_zona ?? null,
            'petugas_id' => $this->petugas_id,
            'nama_petugas' => $this->petugas->nama,
            'nrp_petugas' => $this->petugas->nrp,
            'pengunjung_id' => $this->pengunjung_id,
            'nama_pengunjung' => $this->pengunjung->nama,
            'wbp_profile_id' => $this->wbp_profile_id,
            'nama_wbp' => $this->wbpProfile->nama,
            'd_createdAt' => $this->created_at,
        ];
    }
}
