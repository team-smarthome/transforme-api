<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'role_name' => $this->role->role_name,
            'petugas_id' => $this->petugas_id,
            'nama_petugas' => $this->petugas->nama,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->petugas->foto_wajah,
            'last_login' => $this->last_login,
            'nama_lokasi_lemasmil' => $this->lokasiLemasmil->nama_lokasi_lemasmil,
            'nama_lokasi_otmil' => $this->lokasiOtmil->nama_lokasi_otmil,
            'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id,
            'lokasi_otmil_id' => $this->lokasi_otmil_id,
            'expiry_date' => $this->expiry_date
        ];
    }
}
