<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoriPenyidikanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'histori_penyidikan_id' => $this->id,
            'penyidikan_id' => $this->penyidikan_id,
            'hasil_penyidikan' => $this->hasil_penyidikan,
            'lama_masa_tahanan' => $this->lama_masa_tahanan
        ];
    }
}
