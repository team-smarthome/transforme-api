<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BidangKeahlianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bidang_keahlian_id' => $this->id,
            'nama_bidang_keahlian' => $this->nama_bidang_keahlian,
        ];
    }
}
