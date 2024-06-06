<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JaksaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'jaksa_id' => $this->id,
            'nrp_jaksa' => $this->nrp_jaksa,
            'nama_jaksa' => $this->nama_jaksa,
            'alamat' => $this->alamat,
            'nomor_telepon' => $this->nomor_telepon,
            'email' => $this->email,
            'jabatan' => $this->jabatan,
            'spesialisasi_hukum' => $this->spesialisasi_hukum,
            'divisi' => $this->divisi,
            'tanggal_pensiun' => $this->tanggal_pensiun
        ];
    }
}
