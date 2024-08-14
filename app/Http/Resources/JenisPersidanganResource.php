<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JenisPersidanganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "jenis_persidangan_id"=> $this->id,
            "nama_jenis_persidangan"=> $this->nama_jenis_persidangan
        ];
    }
}
