<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangBuktiKasusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'barang_bukti_kasus_id' => $this->id,
            'kasus_id' => $this->kasus_id,
            'nama_kasus' => $this->kasus->nama_kasus,
            'nomor_kasus' => $this->kasus->nomor_kasus,
            'nama_bukti_kasus' => $this->nama_bukti_kasus,
            'nomor_barang_bukti' => $this->nomor_barang_bukti,
            'dokumen_barang_bukti' => $this->dokumen_barang_bukti,
            'gambar_barang_bukti' => $this->gambar_barang_bukti,
            'keterangan' => $this->keterangan,
            'tanggal_diambil' => $this->tanggal_diambil,
            'jenis_perkara_id' => $this->jenis_perkara_id,
            'nama_jenis_perkara' => $this->jenisPerkara->nama_jenis_perkara
        ];
    }
}
