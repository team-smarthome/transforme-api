<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetugasResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'xAxis' => rand(1, 100),
      'yAxis' => rand(1, 100),
      "petugas_id" => $this->id,
      "nrp" => $this->nrp,
      "nama" => $this->nama,
      "pangkat_id" => $this->pangkat_id,
      "nama_pangkat" => $this->pangkat->nama_pangkat,
      "kesatuan_id" => $this->kesatuan_id,
      "nama_kesatuan" => $this->kesatuan->nama_kesatuan ?? null,
      "lokasi_kesatuan_id" => $this->lokasi_kesatuan_id,
      "nama_lokasi_kesatuan" => $this->lokasi_kesatuan->nama_lokasi_kesatuan ?? null,
      "tempat_lahir" => $this->tempat_lahir,
      "tanggal_lahir" => $this->tanggal_lahir,
      "jenis_kelamin" => $this->jenis_kelamin,
      "provinsi_id" => $this->provinsi_id,
      "nama_provinsi" => $this->provinsi->nama_provinsi,
      "kota_id" => $this->kota_id,
      "nama_kota" => $this->kota->nama_kota,
      "alamat" => $this->alamat,
      "agama_id" => $this->agama_id,
      "nama_agama" => $this->agama->nama_agama,
      "status_kawin_id" => $this->status_kawin_id,
      "nama_status_kawin" => $this->status_kawin->nama_status_kawin,
      "pendidikan_id" => $this->pendidikan_id,
      "nama_pendidikan" => $this->pendidikan->nama_pendidikan,
      "bidang_keahlian_id" => $this->bidang_keahlian_id,
      "nama_bidang_keahlian" => $this->bidang_keahlian->nama_bidang_keahlian ?? null,
      "jabatan" => $this->jabatan,
      "divisi" => $this->divisi,
      "nomor_petugas" => $this->nomor_petugas,
      "lokasi_otmil_id" => $this->lokasi_otmil_id,
      "lokasi_lemasmil_id" => $this->lokasi_lemasmil_id,
      "lokasi_tugas" => $this->lokasi_tugas,
      "foto_wajah" => $this->foto_wajah,
      "grup_petugas_id" => $this->grup_petugas_id,
      "nama_grup_petugas" => $this->grup_petugas->nama_grup_petugas ?? null,
      "matra_id" => $this->matra_id,
      "nama_matra" => $this->matra->nama_matra,
    ];
  }
}
