<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OditurPenuntutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'oditur_penuntut_id' => $this->id,
            'nip' => $this->nip,
            'nama_oditur' => $this->nama_oditur,
            'alamat' => $this->alamat
        ];
    }
}
