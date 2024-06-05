<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AsetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'aset_id' => $this->id,
            'nama_aset' => $this->nama_aset,
            'tipe_aset_id' => $this->tipe_aset_id,
            'nama_tipe' => $this->tipeAset->nama_tipe_aset,
            'ruangan_otmil_id' => $this->ruangan_otmil_id,
            'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan,
            'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id,
            'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan,
            'kondisi' => $this->kondisi,
            'tanggal_masuk' => $this->tanggal_masuk,
            'foto_barang' => $this->image,
            'keterangan' => $this->keterangan,
            'status_zona_otmil' => $this->ruanganOtmil->zona->nama_zona,
            'status_zona_lemasmil' => $this->ruanganLemasmil->zona->nama_zona,
            'serial_number' => $this->serial_number,
            'model' => $this->model,
            'merek' => $this->merek,
            'garansi' => $this->garansi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
