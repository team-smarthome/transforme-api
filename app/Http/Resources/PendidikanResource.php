<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendidikanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pendidikan_id' => $this->id,
            'nama_pendidikan' => $this->nama_pendidikan,
            'tahun_lulus' => $this->tahun_lulus,
            'is_deleted' => $this->deleted_at,
        ];
    }
}
