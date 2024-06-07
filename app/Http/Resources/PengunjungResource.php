<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengunjungResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pengunjung_id' => $this->id,
            'nama' => $this->nama,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nama_provinsi' => $this->provinsi->nama_provinsi,
            'nama_kota' => $this->kota->nama_kota,
            'provinsi_id' => $this->provinsi_id,
            'kota_id' => $this->kota_id,
            'alamat' => $this->alamat,
            'foto_wajah' => $this->foto_wajah,
            'nama_wbp' => $this->wbpProfile->nama,
            'wbp_profile_id' => $this->wbp_profile_id,
            'hubungan_wbp' => $this->hubungan_wbp,
            'nik' => $this->nik,
        ];
    }
}
