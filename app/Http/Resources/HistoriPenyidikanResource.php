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
            'nama_wbp' => $this->penyidikan->wbpProfile->nama,
            'nama_jenis_perkara' => $this->penyidikan->kasus->jenisPerkara->nama_jenis_perkara,
            'hasil_penyidikan' => $this->hasil_penyidikan,
            'lama_masa_tahanan' => $this->lama_masa_tahanan
        ];
    }
}
