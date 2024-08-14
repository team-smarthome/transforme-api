<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZonaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "zona_id" => $this->id,
            "nama_zona" => $this->nama_zona,
            "is_deleted" => $this->deleted_at
        ];
    }
}
