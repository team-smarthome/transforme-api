<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KameraLogResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */

  public function toArray(Request $request): array
  {
    $tipeLokasi = null;
    $namaLokasi = null;
    if ($this->kamera->ruanganOtmil) {
      $tipeLokasi = 'otmil';
      $namaLokasi = $this->kamera->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil;
    } else if ($this->kamera->ruanganLemasmil) {
      $tipeLokasi = 'lemasmil';
      $namaLokasi = $this->kamera->ruanganLemasmil->lokasiLemasMil->nama_lokasi_lemasmil;
    }
    return [
      'kamera_log_id' => $this->id,
      'image' => $this->image,
      'timestamp' => $this->created_at->format('Y-m-d H:i:s'),
      'datenow' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
      'kamera_id' => $this->kamera_id,
      'nama_kamera' => $this->kamera->nama_kamera ?? null,
      'lokasi_id' => $this->kamera->ruanganOtmil->lokasi_otmil_id ?? $this->kamera->ruanganLemasmil->lokasi_lemasmil_id ?? null,
      'tipe_lokasi' => $tipeLokasi,
      'nama_lokasi' => $namaLokasi,
      'keterangan' => $this->foto_wajah_fr ? 'Dikenal' : 'Tidak Dikenal',
    ];
  }
}
