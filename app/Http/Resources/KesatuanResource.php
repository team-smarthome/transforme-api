<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KesatuanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'kesatuan_id' => $this->id,
            'nama_kesatuan' => $this->nama_kesatuan,
            'lokasi_kesatuan_id' => $this->lokasi_kesatuan_id,
            'nama_lokasi_kesatuan' => $this->lokasiKesatuan->nama_lokasi_kesatuan,
            'is_deleted' => $this->deleted_at
        ];
    }
}
