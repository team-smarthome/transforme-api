<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResouceDokumenPersidangan extends JsonResource
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
            'nama_dokumen_persidangan' => $this->nama_dokumen_persidangan,
            'link_dokumen_persidangan' => $this->link_dokumen_persidangan,
            // Informasi lain dari model DokumenPersidangan
        ];
    }
}
