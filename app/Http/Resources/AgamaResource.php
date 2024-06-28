<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgamaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'agama_id' => $this->id,
            'nama_agama' => $this->nama_agama,
            'is_deleted' => $this->deleted_at
        ];
    }
}
