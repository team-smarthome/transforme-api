<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'nama' => $this->petugas->nama,
            'expiry_date' => $this->expiry_date,
            'username' => $this->username,
            'image' => $this->image,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_suspended' => $this->is_suspended,
            'petugas_id' => $this->petugas_id,
            'user_role_id' => $this->user_role_id,
            'role_name' => $this->role->role_name,
            'deskripsi_role' => $this->role->deskripsi_role,
            'nama_lokasi_otmil' => $this->lokasiOtmil->nama_lokasi_otmil ?? null,
            'nama_lokasi_lemasmil' => $this->lokasiLemasmil->nama_lokasi_lemasmil ?? null,
            'lokasi_otmil_id' => $this->lokasi_otmil_id,
            'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id,
            'last_login' => $this->last_login,
            'jabatan' => $this->petugas->jabatan,
            'divisi' => $this->petugas->divisi,
            'nama_matra' => $this->petugas->matra->nama_matra,
            'nrp' => $this->petugas->nrp
            
        ];
    }
}
