<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PetugasShift;

class PetugasShiftResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      "petugas_shift_id" => $this->id,
      "shift_id" => PetugasShift::find($this->id)->shift_id ?? null,
      "nama_shift" => $this->shift->nama_shift ?? null,
      "waktu_mulai" => $this->shift->waktu_mulai ?? null,
      "waktu_selesai" => $this->shift->waktu_selesai ?? null,
      "petugas_id" => $this->petugas_id,
      "schedule_id" => $this->schedule_id,
      "nama" => $this->petugas->nama ?? null,
      "nama_pangkat" => $this->petugas->pangkat->nama_pangkat ?? null,
      "nama_kesatuan" => $this->petugas->kesatuan->nama_kesatuan ?? null,
      "nama_lokasi_kesatuan" => $this->petugas->lokasi_kesatuan->nama_lokasi_kesatuan ?? null,
      "jabatan" => $this->petugas->jabatan ?? null,
      "divisi" => $this->petugas->divisi ?? null,
      "nomor_petugas" => $this->petugas->nomor_petugas ?? null,
      "nama_lokasi_otmil" => $this->petugas->lokasi_otmil->nama_lokasi_otmil ?? null,
      "nama_lokasi_lemasmil" => $this->petugas->lokasi_lemasmil->nama_lokasi_lemasmil ?? null,
      "sc" => $this->schedule ?? null,
      "tanggal" => $this->schedule->tanggal ?? null,
      "bulan" => $this->schedule->bulan ?? null,
      "tahun" => $this->schedule->tahun ?? null,
      "status_kehadiran" => $this->status_kehadiran,
      "jam_kehadiran" => $this->jam_kehadiran,
      "status_izin" => $this->status_izin,
      "penugasan_id" => $this->penugasan_id,
      "nama_penugasan" => $this->penugasan->nama_penugasan ?? null,
      "ruangan_otmil_id" => $this->ruangan_otmil_id,
      "jenis_ruangan_otmil" => $this->ruangan_otmil->jenis_ruangan_otmil ?? null,
      "ruangan_lemasmil_id" => $this->ruangan_lemasmil_id,
      "nama_ruangan_lemasmil" => $this->ruangan_lemasmil->nama_ruangan_lemasmil ?? null,
      "jenis_ruangan_lemasmil" => $this->ruangan_lemasmil->jenis_ruangan_lemasmil ?? null,
      "status_pengganti" => $this->status_pengganti,
      "status_zona_otmil" => $this->ruangan_otmil->zona->nama_zona ?? null,
      "status_zona_lemasmil" => $this->ruangan_lemasmil->zona->nama_zona ?? null,
      "grup_petugas_id" => $this->petugas->grup_petugas_id,
      "nama_grup_petugas" => $this->petugas->grup_petugas->nama_grup_petugas ?? null,
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at
    ];
  }
}
