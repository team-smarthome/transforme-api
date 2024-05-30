<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_saksi' => $this->nama_saksi,
            'no_kontak' => $this->no_kontak,
            'alamat' => $this->alamat,
            'jenis_kelamin' => $this->jenis_kelamin,
            'kasus_id' => $this->kasus_id,
            // 'nama_kasus' => $this->kasus->nama_kasus,
            'keterangan' => $this->keterangan
        ];
    }
}
