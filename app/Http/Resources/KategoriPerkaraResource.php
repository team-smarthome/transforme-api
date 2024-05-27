<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategoriPerkaraResource extends JsonResource
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
            'nama_kategori_perkara' => $this->nama_kategori_perkara,
            'jenis_pidana_id' => $this->jenis_pidana_id,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at,
        ];
    }
}
