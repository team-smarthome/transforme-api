<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AhliResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ahli_id' => $this->id,
            'nama_ahli' => $this->nama_ahli,
            'bidang_ahli' => $this->bidang_ahli,
            'bukti_keahlian' => $this->bukti_keahlian 
        ];
    }
}
