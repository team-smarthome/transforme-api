<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoriVonisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'histori_vonis_id' => $this->id,
            'hasil_vonis' => $this->hasil_vonis,
            'masa_tahanan_tahun' => $this->masa_tahanan_tahun,
            'masa_tahanan_bulan' => $this->masa_tahanan_bulan,
            'masa_tahanan_hari' => $this->masa_tahanan_hari,
        ];
    }
}
